<?php

namespace App\Lib\Database;

use App\Lib\Database\MySQLConnection as MySQLConnection;

interface MySQLDatabaseInterface
{
    /*
     * Select a table from a database.
     * @param name table
     * @return content table
     * */
    function select($table);

    /*
     * Insert data in table.
     * @param name table and insert data
     * @return 'true' if row was inserted
     * */
    function insert($table, $data);

    /*
     * Update a row from a table.
     * @param name table, id row and update data
     * @return 'true' if row was updated
     * */
    function update($table, $id, $data);

    /*
     * Delete a row from a table.
     * @param name table and id row
     * @return 'true' if row was deleted
     * */
    function delete($table, $id);
}

class MySQLDatabase extends MySQLConnection implements MySQLDatabaseInterface
{
    private $connection;

    /*
     * Connection to database.
     * @param name database
     * */
    public function __construct($database)
    {
        $database_defined = $database;
        $this->connection = parent::__construct(
            $database_defined["host"],
            $database_defined["username"],
            $database_defined["password"],
            $database_defined["name"]
        );
    }

    /*
     * Select a table from a database.
     * @param name table
     * @return content table
     * */
    public function select($table)
    {
        try {
            $result = $this->connection->prepare("SELECT * FROM " . $table);
            $result->execute();

            if ($result->setFetchMode(\PDO::FETCH_ASSOC)) {
                return $result->fetchAll();
            }
        } catch (\PDOException $ex) {
            die($ex->getMessage());
        }
    }

    /*
     * Insert data in table.
     * @param name table and insert data
     * @return 'true' if row was inserted
     * */
    public function insert($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = implode("', '", array_values($data));

        try {
            $sql = "INSERT INTO " . $table . " ($columns) VALUES ('" . $values . "')";
            $result = $this->connection->prepare($sql);
            $result->execute();

            return true;
        } catch (\PDOException $ex) {
            die($ex->getMessage());
        }
    }

    /*
     * Update a row from a table.
     * @param name table, id row and update data
     * @return 'true' if row was updated
     * */
    public function update($table, $id, $data)
    {
        $output = implode(', ', array_map(
            function ($v, $k) {
                return sprintf("%s='%s'", $k, $v);
            },
            $data,
            array_keys($data)
        ));

        try {
            $sql = "UPDATE " . $table . " SET " . $output . " WHERE id=" . $id;
            $result = $this->connection->prepare($sql);
            $result->execute();

            return true;
        } catch (\PDOException $ex) {
            die($ex->getMessage());
        }
    }

    /*
     * Delete a row from a table.
     * @param name table and id row
     * @return 'true' if row was deleted
     * */
    public function delete($table, $id)
    {
        try {
            $result = $this->connection->prepare("DELETE FROM " . $table . " WHERE id=" . $id);
            $result->execute();

            return true;
        } catch (\PDOException $ex) {
            die($ex->getMessage());
        }
    }
}