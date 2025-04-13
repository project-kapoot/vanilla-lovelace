<?php

function warningLog(string $data) {
    $file = __DIR__ . '/../logs.txt';

    file_put_contents($file, $data);
}

function println(string $value) {
    fwrite(STDOUT, $value . PHP_EOL);
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