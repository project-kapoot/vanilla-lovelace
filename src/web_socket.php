<?php

require_once __DIR__ . '/Request.php';

set_exception_handler(function(Throwable $exception) {
    warningLog($exception->getMessage());
});

const HTTP_SWITCHING_PROTOCOLS = 101;

set_time_limit(0);

function warningLog(string $data) {
    $file = __DIR__ . '/../logs.txt';

    file_put_contents($file, $data);
}

function println(string $value) {
    fwrite(STDOUT, $value . PHP_EOL);
}

// Socket creation, configuration and listening
$errorFmt = 'Cannot create a new WebSocket : %s';

$ipAddress = '0.0.0.0';
$port = 8080;

if(!extension_loaded('sockets')) {
    throw new Exception(sprintf($errorFmt, 'sockets extension has not been loaded.'));
}

if(($socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'))) === false) {
    throw new Exception(sprintf($errorFmt, 'error while creating socket (' . socket_strerror(socket_last_error()). ')'));
}

println('Socket créé avec succès');

if(socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1) === false) {
    throw new Exception(sprintf($errorFmt, 'error while setting option on the socket (' . socket_strerror(socket_last_error()) . ')'));
}

if(socket_bind($socket, $ipAddress, $port) === false) {
    throw new Exception(sprintf($errorFmt, 'error while binding socket (' . socket_strerror(socket_last_error($socket)) . ')'));
}

println('Binding réussi');

if(socket_listen($socket) === false) {
    throw new Exception(sprintf($errorFmt, 'error while listening to socket (' . socket_strerror(socket_last_error($socket)) . ')'));
}

println('Socket en écoute');

if(($client = socket_accept($socket)) === false) {
    throw new Exception(sprintf('error while accpeting a connecting on the socket (' . socket_strerror(socket_last_error($socket)) . ')'));
}

$request = '';
$data = socket_recv($client, $request, 1024, 0);

if($data === false) {
    throw new Exception(sprintf($errorFmt, 'error while receiving data from the socket (' . socket_strerror(socket_last_error($client)) . ')'));
}

$request = Request::parseFromString($request);
$key = $request->getHeader('Sec-WebSocket-Key');

if(strcasecmp($request->getMethod(), 'GET') !== 0) {
    warningLog('bad method');
    http_response_code(400);
    exit;
}

if($key === null) {
    warningLog('websocket key not correct');
    http_response_code(400);
    exit;
}

if(($upgrade = $request->getHeader('Upgrade')) === null || $upgrade !== 'websocket') {
    warningLog('upgrade header incorrect : ' . $upgrade);
    http_response_code(400);
    exit;
}

if(($connection = $request->getHeader('Connection')) === null || str_contains($connection, 'Upgrade') === false) {
    warningLog('connection header incorrect : ' . $connection);
    http_response_code(400);
    exit;
}

$hash = base64_encode(pack('H*', sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
$response  = "HTTP/1.1 101 Switching Protocols\r\n";
$response .= "Upgrade: websocket\r\n";
$response .= "Connection: Upgrade\r\n";
$response .= "Sec-WebSocket-Accept: $hash\r\n";
$response .= "\r\n";

if(($write = socket_write($client, $response, strlen($response))) === false) {
    throw new Exception(sprintf($errorFmt, 'handshake failed (' . socket_strerror(socket_last_error()) . ')'));
}

if(socket_recv($client, $data, 2, 0) === false) {
    throw new Exception(sprintf($errorFmt, 'error while receving data from the socket (' . socket_strerror(socket_last_error())) . ')');
}

$payloadLength = websocket_decode_payload_length($data, $client);

println($payloadLength);

$message = websocket_unmask_payload($client, $payloadLength);

println($message);

$message = str_repeat('x', 80000);

$result = websocket_send_message($client, $message);

function websocket_decode_payload_length(string $mesage, Socket &$client) : int
{
    $byte = ord($mesage[0]);

    $isLastMessage = boolval($byte & 0b00000001);
    
    $byte = ord($mesage[1]);
    $isEncoded = boolval($byte & 0b00000001);

    $payloadLength = $byte - 0b10000000;

    if($payloadLength === 126) {
        println('125 < length < 65536');

        if(socket_recv($client, $test, 2, 0) === false) {
            throw new Exception('error while receving data from the socket (' . socket_strerror(socket_last_error()) . ')');
        }

        $payloadLength = (ord($test[0]) << 8) + ord($test[1]);
    }

    if($payloadLength === 127) {
        println('length > 65536');

        if(socket_recv($client, $test, 8, 0) === false) {
            throw new Exception('error while receving data from the socket (' . socket_strerror(socket_last_error()) . ')');
        }

        $payloadLength = 0;
        $bytes = str_split($test);
        foreach($bytes as $index => $byte) {
            $payloadLength += ord($byte) << ((8 - $index - 1) * 8);
        }
    }

    return $payloadLength;
}

function websocket_unmask_payload(Socket &$client, int $length) : string
{
    if(socket_recv($client, $mask, 4, 0) === false) {
        throw new Exception('error while receving data from the socket (' . socket_strerror(socket_last_error()) . ')');
    }

    if(socket_recv($client, $payload, $length, 0) === false) {
        throw new Exception('error while receving data from the socket (' . socket_strerror(socket_last_error()) . ')');
    }

    $bytes = str_split($payload);
    $message = '';
    foreach($bytes as $index => $byte) {
        $message .= $byte ^ $mask[$index % 4];
    }

    return $message;
} 

function uint_to_bytes(int $num) : array
{
    $intSize = match(true) {
        $num < 0xFF => 8,
        $num < 0xFFFF => 16,
        $num < 0xFFFFFFFF => 32,
        $num < 0xFFFFFFFFFFFFFFFF => 64,
        default => null,
    };

    if($intSize === null) {
        throw new Exception('Cannot convert number ' . $num . ' to bytes : number size is not recognizable');
    }

    $bytes = [];
    for($i = $intSize - 8; $i >= 0; $i -= 8) {
        $bytes[] = $num >> $i & 255;
    }

    return $bytes;
}

function websocket_send_message(Socket $client, string $message) : bool
{
    $frame = [];

    $isLastMessage = 0b10000000;
    $opcode = 0b00000001;
    $frame[0] = $isLastMessage | $opcode;

    $isMasked = 0;
    $payloadLength = strlen($message);

    if($payloadLength <= 125) {
        $frame[1] = $isMasked | $payloadLength;
    }

    if(126 < $payloadLength && $payloadLength < 65536) {
        $bytes = uint_to_bytes($payloadLength);
        $frame[1] = $isMasked | 126;
        foreach($bytes as $byte) {
            $frame[] = $byte;
        }
    }

    if($payloadLength >= 65336) {
        $bytes = uint_to_bytes($payloadLength);
        $frame[1] = $isMasked | 127;
        array_unshift($bytes, ...array_fill(0, 8 - count($bytes), 0));
        array_push($frame, ...$bytes);
    }
    $bytes = str_split($message);
    foreach($bytes as $byte) {
        $frame[] = ord($byte);
    }

    $data = implode('', array_map('chr', $frame));
    return socket_write($client, $data, strlen($data));
}
socket_close($client);
socket_close($socket);
