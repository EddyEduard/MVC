<?php

namespace App\Core;

class RequestCore
{
    /*
     * Get content after request methods POST, PUT and DELETE.
     * */
    public function body()
    {
        parse_str(file_get_contents("php://input"), $body);
        return $body;
    }

    /*
     * Validate content from request server.
     * @return 'true' if all methods of validate are correctly
     * */
    public function validate($schema)
    {
        $this->required($schema);
        $this->typeOf($schema);
        $this->maxLength($schema);
        $this->minLength($schema);

        return true;
    }

    /*
     * Validate if properties from content are required.
     * */
    private function required($schema)
    {
        foreach ($schema as $key => $value) {
            if (strpos($value, "required") !== false && array_key_exists($key, $this->body()) === false) {
                header($_SERVER["SERVER_PROTOCOL"] . " 500 The property named '{$key}' is required.");
                break;
            }
        }
    }

    /*
     * Validate if properties from content are type of 'string', 'int', 'bool', 'date', etc...
     * */
    private function typeOf($schema)
    {
        foreach ($schema as $key => $value) {
            if (strpos($value, "type") !== false) {
                $typeOf = gettype($this->body()[$key]);
                if (array_key_exists($key, $this->body()) !== false && strpos($value, $typeOf) === false) {
                    foreach (["string", "int", "bool", "date"] as $type) {
                        if (strpos($value, $type) !== false) {
                            header($_SERVER["SERVER_PROTOCOL"] . " 500 The property named '{$key}' shall be type of '{$type}'.");
                            break;
                        }
                    }
                }
            }
        }
    }

    /*
     * Validate max length from each properties.
     * */
    public function maxLength($schema)
    {
        foreach ($schema as $key => $value) {
            $max_found = strpos($value, "max");
            $max_value = strpos($value, "|", $max_found);

            if ($max_value !== false) {
                $substring = substr($value, $max_found, $max_value - $max_found);
                $length = explode(":", $substring)[1];
                if (strlen($this->body()[$key]) > $length) {
                    header($_SERVER["SERVER_PROTOCOL"] . " 500 The property named '{$key}' must to have max length of '{$length}'.");
                    break;
                }
            } else {
                $substring = substr($value, $max_found, $max_found);
                $length = explode(":", $substring)[1];
                if (strlen($this->body()[$key]) > $length) {
                    header($_SERVER["SERVER_PROTOCOL"] . " 500 The property named '{$key}' must to have max length of '{$length}'.");
                    break;
                }
            }
        }
    }

    /*
     * Validate min length from each properties.
     * */
    public function minLength($schema)
    {
        foreach ($schema as $key => $value) {
            $min_found = strpos($value, "min");
            $min_value = strpos($value, "|", $min_found);

            if ($min_value !== false) {
                $substring = substr($value, $min_found, $min_value - $min_found);
                $length = explode(":", $substring)[1];
                if (strlen($this->body()[$key]) < $length) {
                    header($_SERVER["SERVER_PROTOCOL"] . " 500 The property named '{$key}' must to have min length of '{$length}'.");
                    break;
                }
            } else {
                $substring = substr($value, $min_found, $min_found);
                $length = explode(":", $substring)[1];
                if (strlen($this->body()[$key]) < $length) {
                    header($_SERVER["SERVER_PROTOCOL"] . " 500 The property named '{$key}' must to have min length of '{$length}'.");
                    break;
                }
            }
        }
    }
}