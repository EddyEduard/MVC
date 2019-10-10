<?php

namespace App\Lib\Database;

class ConnectionMySQL
{
    /*
     * Connection to MySQL server
     * @param host, username, password and database name
     * @return connection
     */
    public function __construct($host, $username, $password, $database)
    {
        try
        {
            $connection = new \PDO("mysql:host=" . $host . ";dbname=" . $database, $username, $password);
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

            return $connection;
        }
        catch (\PDOException $ex){
             die($ex->getMessage());
        }
    }
}