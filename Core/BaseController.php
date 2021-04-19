<?php

namespace App\Core;

class BaseController
{
    private static $ViewData = [];

    private static $ContentPage = null;

    /*
     * View a file from folder named "Views"
     * $data result data
     * */
    protected static function View($data = [])
    {
        self::$ViewData = $data;

        $folder = str_replace("Controller", "", debug_backtrace()[1]["class"]);
        $file = debug_backtrace()[1]["function"];

        self::$ContentPage = file_get_contents("./Views/" . $folder . "/" . $file . ".php");
        require_once "Views/Layout.php";
    }

    /*
     * Include content from any page in layout page
     * */
    protected static function Content()
    {
        echo self::$ContentPage;
    }

    /*
     * Get view data by key.
     * @param $key for found view data
     * @return view data
     * */
    protected static function ViewData($key = null)
    {
        if ($key !== null) {
            echo self::$ViewData[$key];
        } else {
            return self::$ViewData;
        }
    }
}
