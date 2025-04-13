<?php

namespace App\WebSocket;

use Exception;

class Decoder
{
    public static function decodePayloadLength(Connection $client, string $message) : int 
    {
        $byte = ord($message[0]);

        $isLastMessage = boolval($byte & 0b00000001);
    
        $byte = ord($message[1]);
        $isEncoded = boolval($byte & 0b00000001);

        $payloadLength = $byte - 0b10000000;

        if($payloadLength === 126) {
            println('125 < length < 65536');

            if(socket_recv($client->getSocket(), $test, 2, 0) === false) {
                throw new Exception('error while receving data from the socket (' . socket_strerror(socket_last_error()) . ')');
            }

            $payloadLength = (ord($test[0]) << 8) + ord($test[1]);
        }

        if($payloadLength === 127) {
            println('length > 65536');

            if(socket_recv($client->getSocket(), $test, 8, 0) === false) {
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

    public static function unmaskPayload(Connection $client, int $length) : string
    {
        if(socket_recv($client->getSocket(), $mask, 4, 0) === false) {
            throw new Exception('error while receving data from the socket (' . socket_strerror(socket_last_error()) . ')');
        }

        if(socket_recv($client->getSocket(), $payload, $length, 0) === false) {
            throw new Exception('error while receving data from the socket (' . socket_strerror(socket_last_error()) . ')');
        }

        $bytes = str_split($payload);
        $message = '';
        foreach($bytes as $index => $byte) {
            $message .= $byte ^ $mask[$index % 4];
        }

        return $message;
    }
}