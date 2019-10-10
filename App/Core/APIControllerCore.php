<?php

namespace App\Core;

class APIController
{
    public static function OK($data = null)
    {
        echo json_encode($data);
    }

    public static function Fail()
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 500 Bad Request");
    }
}