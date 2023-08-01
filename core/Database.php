<?php

namespace app\core;

use PDO;


/**
 * Class Database
 * @author Ban Alexandru <alexbanut10@gmail.com>
 * @package app\core
 **/
class Database
{
    public PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dns'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        // connecti to the database by passing certain arguments
        $this->pdo = new PDO($dsn, $user, $password);

        // make PDO to throw an exception if it doesn't connect to DB
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
