<?php

namespace App\Core;

interface ErrorInterface
{
    /*
     * Initialize the error.
     * @param $exception information error
     * */
    function init(\Exception $exception);

    /*
     * Redirect error to a view file.
     * @param $file_error a file for view error
     * */
    function redirect($file_error);

    /*
     * Get the code error.
     * */
    static function code();

    /*
     * Get the message error.
     * */
    static function message();
}

class Error implements  ErrorInterface
{
    private static $code;

    private static $message;

    /*
     * Initialize the error.
     * */
    public function init(\Exception $exception)
    {
        header($_SERVER["SERVER_PROTOCOL"] . " {$exception->getCode()}");

        self::$code = $exception->getCode();
        self::$message = $exception->getMessage();
    }

    /*
     * Redirect error to a view file.
     * @param $file_error a file for view error
     * */
    public function redirect($file_error)
    {
        require_once $file_error;
    }

    /*
     * Get the code error.
     * */
    public static function code()
    {
        echo self::$code;
    }

    /*
     * Get the message error.
     * */
    public static function message()
    {
        echo self::$message;
    }
}