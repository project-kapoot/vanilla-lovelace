<?php

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
    echo $value . PHP_EOL;
}

// Socket creation, configuration and listening
$errorFmt = 'Cannot create a new WebSocket : %s';

$ipAddress = '0.0.0.0';
$port = 443;

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

var_dump($request);

println('Connexion réussie !');

socket_close($client);

println('Closing socket');

socket_close($socket);
die;
// HTTP Handshake
if(($method = $_SERVER['REQUEST_METHOD'] ?? null) !== 'GET') {
    warningLog('bad method');
    http_response_code(400);
    exit;
}

if(($key = $_SERVER['HTTP_SEC_WEBSOCKET_KEY'] ?? null) === null) {
    warningLog('websocket key not correct');
    http_response_code(400);
    exit;
}

if(($upgrade = $_SERVER['HTTP_UPGRADE'] ?? null) === null || $upgrade !== 'websocket') {
    warningLog('upgrade header incorrect : ' . $upgrade);
    http_response_code(400);
    exit;
}

if(($connection = $_SERVER['HTTP_CONNECTION'] ?? null) === null || str_contains($connection, 'Upgrade') === false) {
    warningLog('connection header incorrect : ' . $connection);
    http_response_code(400);
    exit;
}

http_response_code(HTTP_SWITCHING_PROTOCOLS);
header('Upgrade: websocket');
header('Connection: Upgrade');
$hash = base64_encode(sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11'));
header('Sec-WebSocket-Accept: ' . $hash);
