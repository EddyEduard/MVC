<?php

namespace App\Core;

interface RequestInterface
{
    /*
     * Get content after request methods: POST, PUT or DELETE.
     * */
    function body();

    /*
     * Validate content from request server.
     * @return 'true' if all validates methods are correctly
     * */
    function validate($schema);
}

class Request implements RequestInterface
{
    /*
     * Get content after request methods: POST, PUT or DELETE.
     * */
    public function body()
    {
        parse_str(file_get_contents("php://input"), $body);
        return json_decode($body["json"], true);
    }

    /*
     * Validate content from request server.
     * @return 'true' if all validates methods are correctly
     * */
    public function validate($schema)
    {
        $validatedRequired = $this->required($schema);
        $validatedTypeOf = $this->typeOf($schema);
        $validatedMaxLength = $this->maxLength($schema);
        $validatedMinLength = $this->minLength($schema);

        if (is_array($validatedRequired))
            return $validatedRequired;
        else if (is_array($validatedTypeOf))
            return $validatedTypeOf;
        else if (is_array($validatedMaxLength))
            return $validatedMaxLength;
        else if (is_array($validatedMinLength))
            return $validatedMinLength;

        return true;
    }

    /*
     * Validate if properties from content are required.
     * @param $schema for validate properties
     * */
    private function required($schema)
    {
        $errors = [];

        foreach ($schema as $key => $value)
            if (strpos($value, "required") !== false && array_key_exists($key, $this->body()) === false)
                array_push($errors, ["property" => $key, "status" => 500, "error_message" => "The property named '{$key}' is required."]);

        if(count($errors))
            return $errors;
        return true;
    }

    /*
     * Validate if properties from content are type of 'string', 'integer', 'bool', 'date', etc...
     * @param $schema for validate properties
     * */
    private function typeOf($schema)
    {
        $errors = [];

        foreach ($schema as $key => $value) {
            if (strpos($value, "type") !== false) {
                $typeOf = gettype($this->body()[$key]);
                if (array_key_exists($key, $this->body()) !== false && strpos($value, $typeOf) === false) {
                    foreach (["string", "integer", "bool", "date"] as $type)
                        if (strpos($value, $type) !== false)
                            array_push($errors, ["property" => $key, "current_type" => $typeOf, "status" => 500, "error_message" => "The property named '{$key}' shall be type of '{$type}'."]);
                }
            }
        }

        if(count($errors))
            return $errors;
        return true;
    }

    /*
     * Validate max length from each properties.
     * @param $schema for validate properties
     * */
    public function maxLength($schema)
    {
        $errors = [];

        foreach ($schema as $key => $value) {
            $max_found = strpos($value, "max");
            $max_value = strpos($value, "|", $max_found);
            $field_length = strlen($this->body()[$key]);

            if ($max_value !== false) {
                $substring = substr($value, $max_found, $max_value - $max_found);
                $length = explode(":", $substring)[1];
                if ($field_length > $length)
                    array_push($errors, ["property" => $key, "current_length" => $field_length, "status" => 500, "error_message" => "The property named '{$key}' must to have max length of '{$length}'."]);
            } else {
                $substring = substr($value, $max_found, $max_found);
                $length = explode(":", $substring)[1];
                if ($field_length > $length)
                    array_push($errors, ["property" => $key, "current_length" => $field_length, "status" => 500, "error_message" => "The property named '{$key}' must to have max length of '{$length}'."]);
            }
        }

        if(count($errors))
            return $errors;
        return true;
    }

    /*
     * Validate min length from each properties.
     * @param $schema for validate properties
     * */
    public function minLength($schema)
    {
        $errors = [];

        foreach ($schema as $key => $value) {
            $min_found = strpos($value, "min");
            $min_value = strpos($value, "|", $min_found);
            $field_length = strlen($this->body()[$key]);

            if ($min_value !== false) {
                $substring = substr($value, $min_found, $min_value - $min_found);
                $length = explode(":", $substring)[1];
                if (strlen($this->body()[$key]) < $length)
                    array_push($errors, ["property" => $key, "current_length" => $field_length, "status" => 500, "error_message" => "The property named '{$key}' must to have min length of '{$length}'."]);
            } else {
                $substring = substr($value, $min_found, $min_found);
                $length = explode(":", $substring)[1];
                if (strlen($this->body()[$key]) < $length)
                    array_push($errors, ["property" => $key, "current_length" => $field_length, "status" => 500, "error_message" => "The property named '{$key}' must to have min length of '{$length}'."]);
            }
        }

        if(count($errors))
            return $errors;
        return true;
    }
}