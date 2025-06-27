<?php

namespace App\Component\Database;

use PDO;

class Connection extends PDO
{
    public function __construct(string $dsn, string|null $username, string|null $password) 
    {
        parent::__construct($dsn, $username, $password, null);

        $this->setAttribute(self::ATTR_ERRMODE, self::ERRMODE_EXCEPTION);
    }
}