<?php

namespace App\WebSocket;

require_once __DIR__ . '/../../src/Request.php';
require_once __DIR__ . '/Decoder.php';

use Exception;
use Request;
use Socket;

class Connection
{
    private readonly Socket $socket;

    public function __construct(Socket $socket)
    {
        $this->socket = $socket; 
    }

    public function getSocket() : Socket 
    {
        return $this->socket;
    }

    public function performHandshake() : void
    {
        $errorFmt = 'Cannot perform HTTP Handshake : %s';
        $request = '';
        $data = socket_recv($this->socket, $request, 1024, 0);

        if($data === false) {
            throw new Exception(sprintf($errorFmt, 'error while receiving data from the socket (' . socket_strerror(socket_last_error($this->socket)) . ')'));
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

        if(($write = socket_write($this->socket, $response, strlen($response))) === false) {
            throw new Exception(sprintf($errorFmt, 'handshake failed (' . socket_strerror(socket_last_error()) . ')'));
        }
    }

    public function readMessage() : string
    {
        $errorFmt = 'Cannot read message from the client : %s';

        if(socket_recv($this->socket, $data, 2, 0) === false) {
            throw new Exception(sprintf($errorFmt, 'error while receving data from the socket (' . socket_strerror(socket_last_error())) . ')');
        }

        $payloadLength = Decoder::decodePayloadLength($this, $data);

        $message = Decoder::unmaskPayload($this, $payloadLength);

        return $message;
    }

    public function sendMessage(string $message) : bool
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

        return socket_write($this->socket, $data, strlen($data));
    }

    public function close() : void
    {
        socket_close($this->socket);
    }
}