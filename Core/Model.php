<?php

namespace App\Core;

use App\Lib\Database\MySQLDatabase as MySQLDatabase;

interface ModelInterface
{
    /*
    * Select all rows from a table.
    * @return $rows with all rows from table
    * */
    static function all();

    /*
     * Find in table a row where name column is equal with @column and value from column is equal with $value.
     * @param $column name column
     * @param $value value from row
     * @return found row from table
     * */
    static function find($column, $value);

    /*
     * Select all rows from table where name column is equal with @column and value from column is equal with $value.
     * @param $column name column
     * @param $value value from row
     * @return selected rows from table
     * */
    static function where($column, $value);

    /*
     * Insert data in a table.
     * @param $value value row
     * @return 'true' if values was added in table
     * */
    static function insert($value);

    /*
     * Update data in a table.
     * @param $id is id row
     * @param $value new value for row
     * @return 'true' if values was updated in table
     * */
    static function update($id, $value);

    /*
     * Delete data from table.
     * @param $id is id row
     * @return 'true' if values was deleted from table
     * */
    static function delete($id);
}

class Model implements ModelInterface
{
    private static $database;

    public function __construct($database, $table)
    {
        $GLOBALS["database"] = $database;
        $GLOBALS["table"] = $table;

        self::$database = new MySQLDatabase($GLOBALS["database"]);
    }

    /*
    * Select all rows from a table.
    * @return $rows with all rows from table
    * */
    public static function all()
    {
        $data = self::$database->select($GLOBALS["table"]);

        $properties = array_keys(get_class_vars(get_called_class()));
        $rows = [];

        foreach ($data as $key => $value) {
            $columns = array_diff(array_keys($value), array_values($properties));

            foreach ($value as $column) {
                if (in_array($column, $columns)) {
                    unset($value[$column]);
                }
            }

            array_push($rows, $value);
        }

        return $rows;
    }

    /*
     * Find in table a row where name column is equal with @column and value from column is equal with $value.
     * @param $column name column
     * @param $value value from row
     * @return found row from table
     * */
    public static function find($column, $value)
    {
        $data = self::all();
        $row = null;

        foreach ($data as $key) {
            if (array_key_exists($column, $key)) {
                if ($key[$column] == $value) {
                    $row = $key;
                    break;
                }
            }
        }

        return $row;
    }

    /*
     * Select all rows from table where name column is equal with @column and value from column is equal with $value.
     * @param $column name column
     * @param $value value from row
     * @return selected rows from table
     * */
    public static function where($column, $value)
    {
        $data = self::all();
        $rows = [];

        foreach ($data as $key) {
            if (array_key_exists($column, $key)) {
                if ($key[$column] == $value) {
                    array_push($rows, $key);
                }
            }
        }

        return $rows;
    }

    /*
     * Insert data in a table.
     * @param $value value row
     * @return 'true' if values was added in table
     * */
    public static function insert($value)
    {
        return self::$database->insert($GLOBALS["table"], $value);
    }

    /*
     * Update data in a table.
     * @param $id is id row
     * @param $value new value for row
     * @return 'true' if values was updated in table
     * */
    public static function update($id, $value)
    {
        return self::$database->update($GLOBALS["table"], $id, $value);
    }

    /*
     * Delete data from table.
     * @param $id is id row
     * @return 'true' if values was deleted from table
     * */
    public static function delete($id)
    {
        return self::$database->delete($GLOBALS["table"], $id);
    }
}