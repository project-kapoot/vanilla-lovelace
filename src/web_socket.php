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

while(true) {
    if(socket_recv($client, $data, 1024, 0) === false) {
        throw new Exception(sprintf($errorFmt, 'error while receving data from the socket (' . socket_strerror(socket_last_error())) . ')');
    }

    websocket_message_unmask($data);
}

function websocket_message_unmask(string $mesage)
{
    $byte = ord($mesage[0]);

    $isLastMessage = boolval($byte & 0b00000001);
    
    $byte = ord($mesage[1]);
    $isEncoded = boolval($byte & 0b00000001);

    $payloadLength = $byte - 0b00000001;
    $mask = substr($mesage, 2, 6);
    $data = substr($mesage, 6, 6 + $payloadLength);

    if($payloadLength === 126) {
        $payloadLength = (ord($mesage[2]) << 8) + ord($mesage[3]);
        $mask = substr($mesage, 4, 8);
        $data = substr($mesage, 8, 8 + $payloadLength);
    }

    if($payloadLength === 127) {
        $payloadLength = 0;
        $bytes = str_split(substr($mesage, 2, 10));
        $bitShift = 56;
        foreach($bytes as $byte) {
           $payloadLength += (ord($byte) << $bitShift);
           $bitShift -= 8;
        }

        $mask = substr($mesage, 10, 14);
        $data = substr($mesage, 14, 14 + $payloadLength);
    }

    println($payloadLength);
    println($mask);
    println($data);

    $bytes = str_split($data);
    $decoded = '';
    foreach($bytes as $index => $byte) {
        $decoded .= $byte ^ $mask[$index % 4];
    }

    println($decoded);
    
    return $decoded;
}

socket_close($client);
socket_close($socket);
