<?php

namespace App\WebSocket;

require_once __DIR__ . '/../../functions.php';

use Exception;
use Socket;

class WebSocket
{
    private Socket $socket;

    public function __construct()
    {
        $this->socket = $this->start();
    }

    private function start() : Socket
    {
        set_time_limit(0);

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

        return $socket;
    }

    public function acceptConnection() : Connection
    { 
        if(($client = socket_accept($this->socket)) === false) {
            throw new Exception(sprintf('error while accpeting a connecting on the socket (' . socket_strerror(socket_last_error($this->socket)) . ')'));
        }

        return new Connection($client);
    }

    public function close() : void
    {
        socket_close($this->socket);
    }
}