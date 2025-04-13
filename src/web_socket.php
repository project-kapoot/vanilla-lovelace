<?php

use App\WebSocket\WebSocket;

require_once __DIR__ . '/Request.php';
require_once __DIR__ . '/../functions.php';
require_once __DIR__ . '/../lib/websocket/WebSocket.php';
require_once __DIR__ . '/../lib/websocket/Connection.php';

$socket = new WebSocket();
$connections = [];
$connection = $socket->acceptConnection();
$connections[] = $connection;

$connection->performHandshake();

$message = $connection->readMessage();

println($message);

$connection->sendMessage(str_repeat('x', 300));

$connection->close();
$socket->close();
