<?php

namespace App\Core;

include "Lib\Database\Database.php";

use App\Lib\Database\DatabaseMySQL as Database;

class Model
{
    public function __construct($database, $table)
    {
        $GLOBALS["database"] = $database;
        $GLOBALS["table"] = $table;
    }

    /*
    * Select from table all rows
    * @return $rows with all rows from table
    * */
    public static function all()
    {
        $database = new Database($GLOBALS["database"]);
        $data = $database->select($GLOBALS["table"]);

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
     * Find in table an row where name column is equal with @column and value column is equal with $value.
     * @param $column
     * @param $value
     * @return $row with found row from table
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
     * Select all rows from table where name column is equal with @column and value column is equal with $value.
     * @param $column
     * @param $value
     * @return $rows with selected rows from table
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
     * Insert data in a table from database;
     * @param $value
     * @return 'true' if values has added in table
     * */
    public static function insert($value)
    {
        $database = new Database($GLOBALS["database"]);
        $data = $database->insert($GLOBALS["table"], $value);

        return $data;
    }

    /*
     * Update data in a table from database;
     * @param $id
     * @param $value
     * @return 'true' if values has updated in table
     * */
    public static function update($id, $value)
    {
        $database = new Database($GLOBALS["database"]);
        $data = $database->update($GLOBALS["table"], $id, $value);

        return $data;
    }

    /*
     * Delete data in a table from database;
     * @param $id
     * @return 'true' if values has deleted in table
     * */
    public static function delete($id)
    {
        $database = new Database($GLOBALS["database"]);
        $data = $database->delete($GLOBALS["table"], $id);

        return $data;
    }
}