<?php

namespace App\Core;

class APIController
{
    /*
     * Result data with response code 200.
     * @param $data result data
     * */
    protected static function OK($data = null)
    {
        http_response_code(200);
        if($data != null)
            echo json_encode($data);
    }

    /*
     * Result data with response code 404.
     * @param $data result data
     * */
    protected static function NotFound($data = null)
    {
        http_response_code(404);
        if($data != null)
            echo json_encode($data);
    }

    /*
     * Result data with response code 200.
     * @param $data result data
     * */
    protected static function Fail($data = null)
    {
        http_response_code(500);
        if($data != null)
            echo json_encode($data);
    }
}