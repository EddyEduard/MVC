<?php

namespace App\Core;

include "Core\BundleCore.php";
include "Config\Bundle.php";
include "Models\ErrorModel.php";

use App\Core\BundleCore as Bundle;
use App\Model\ErrorModel as Error;

class Controller extends Bundle
{
    private static $ViewData = [];

    private static $ContentPage = null;

    /*
     * View an file from folder named "Views"
     * @param array $data
     * */
    public static function View($data = [])
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
    public static  function Content()
    {
        echo self::$ContentPage;
    }

    /*
     * View data from array named "$ViewData"
     * @param string $key
     * @return $ViewData
     * */
    public static function ViewData($key = null)
    {
        if ($key !== null) {
            echo self::$ViewData[$key];
        } else {
            return self::$ViewData;
        }
    }

    /*
     * Get bundle styles
     * @params string $key
     * */
    public static function Styles($key)
    {
        echo Bundle::BundleStyles($key);
    }

    /*
     * Get bundle scripts
     * @params string $key
     * */
    public static function Scripts($key)
    {
        echo Bundle::BundleScripts($key);
    }

    /*
     * Create a error page view
     * @param array $data
     * */
    public static function Error($message, $status)
    {
        $error = new Error();
        $error->message = $message;
        $error->status = $status;

        self::$ViewData = $error;

        header($_SERVER["SERVER_PROTOCOL"] . " {$status} Not Found");
        require_once "error.php";
    }
}
