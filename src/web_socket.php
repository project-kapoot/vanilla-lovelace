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

}

socket_close($client);
socket_close($socket);