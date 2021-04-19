<?php

namespace App\Lib\Database;

class MySQLConnection
{
    /*
     * Connect to MySQL server.
     * @param $host
     * @param $username
     * @param $password
     * @param $database
     * @return connection
     */
    protected function __construct($host, $username, $password, $database)
    {
        $connection = new \PDO("mysql:host=" . $host . ";dbname=" . $database, $username, $password);
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        return $connection;
    }
}