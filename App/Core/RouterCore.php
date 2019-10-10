<?php

namespace App\Core;

class RouterCore
{
    private static $paths = [];

    private static $isFoundRoute = false;

    private static $foundRoute = null;

    private static $paramsRoute = [];

    public function __construct()
    {
        if (self::$isFoundRoute == true) {
            self::$isFoundRoute = false;
            self::$foundRoute = null;
            self::$paramsRoute = [];
        }
    }

    /*
     * Create request method GET for MVC framework app.
     * @param string name
     * @param string url
     * */
    public static function Get($path, $map = [])
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            array_push(self::$paths, [
                "path" => $path,
                "map" => $map
            ]);
        }
    }

    /*
     * Create request method POST for MVC framework app.
     * @param string name
     * @param string url
     * */
    public static function Post($path, $map = [])
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            array_push(self::$paths, [
                "path" => $path,
                "map" => $map
            ]);
        }
    }

    /*
     * Create request method PUT for MVC framework app.
     * @param string name
     * @param string url
     * */
    public static function Put($path, $map = [])
    {
        if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            array_push(self::$paths, [
                "path" => $path,
                "map" => $map
            ]);
        }
    }

    /*
     * Create request method DELETE for MVC framework app.
     * @param string name
     * @param string url
     * */
    public static function Delete($path, $map = [])
    {
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            array_push(self::$paths, [
                "path" => $path,
                "map" => $map
            ]);
        }
    }

    /*
     * Validate count path and check if is found an route.
     * */
    private static function ValidateCountPath()
    {
        $url = self::url();

        foreach (self::$paths as $key => $value) {
            if (isset($value["path"]) && !empty($value["path"])) {
                $path = explode("/", filter_var(rtrim($value["path"], "/"), FILTER_SANITIZE_SPECIAL_CHARS));
                if (is_array($url) && is_array($path) && count($url) != count($path)) {
                    unset(self::$paths[$key]);
                }
            } else {
                if (count($url) == 0) {
                    self::$isFoundRoute = true;
                    self::$foundRoute = $value;
                    break;
                } else {
                    unset(self::$paths[$key]);
                }
            }
        }
    }

    /*
     * Validate content path router.
     * */
    private static function ValidateContentPath()
    {
        foreach (self::$paths as $key => $value) {
            $url = self::url();
            $path = explode("/", filter_var(rtrim($value["path"], "/"), FILTER_SANITIZE_SPECIAL_CHARS));
            $count_path = count($path);

            for ($i = 0; $i <= $count_path; $i++) {
                if (array_key_exists($i, $url) && array_key_exists($i, $path) && $url[$i] == $path[$i]) {
                    unset($path[$i]);
                    unset($url[$i]);
                }
            }

            if (count($url) == count($path)) {
                $params = array_combine($path, $url);
                $validate_params = [];

                foreach ($params as $key_param => $value_param) {
                    array_push($validate_params, preg_match('/[\'\\{\}\|\\\]/', $key_param));
                }

                if (array_sum($validate_params) == count($validate_params)) {
                    self::$paramsRoute = $params;
                    self::$isFoundRoute = true;
                    self::$foundRoute = $value;
                    break;
                }
            }
        }
    }

    /*
     * Create route for MVC framework app.
     * @param string name
     * @param string url
     * */
    private static function Map()
    {
        self::ValidateCountPath();

        if (self::$isFoundRoute) {
            self::callController(self::$foundRoute["map"]["controller"], self::$foundRoute["map"]["action"], self::$paramsRoute);
            exit;
        }

        self::ValidateContentPath();

        if (self::$isFoundRoute) {
            self::callController(self::$foundRoute["map"]["controller"], self::$foundRoute["map"]["action"], self::$paramsRoute);
            exit;
        }
    }

    /*
     * Request url MVC framework app.
     * @return an explode array with all values from url
     * */
    private static function url()
    {
        if (isset($_REQUEST["url"]) && !empty($_REQUEST["url"])) {
            return explode("/", filter_var(rtrim($_REQUEST["url"], "/"), FILTER_SANITIZE_URL));
        }

        return [];
    }

    /*
     * Call an controller from an file.
     * @param string controller
     * @param string action
     * @param array params
     * */
    private static function callController($controller, $action, $params = [])
    {
        if (file_exists("../app/controllers/" . $controller . "Controller.php")) {
            require_once "../app/controllers/" . $controller . "Controller.php";

            if (class_exists($controller . "Controller") === false) {
                Controller::Error( "No exist an controller named '{$controller}'.", 404);
            }

            try {
                $reflection = new \ReflectionMethod($controller . "Controller", $action);
                $params_count = $reflection->getNumberOfRequiredParameters();

                if ($params_count != count($params)) {
                    Controller::Error( "Error format router.This router must to contains '{$params_count}' params.", 404);
                }
                call_user_func_array([$controller . "Controller", $action], $params);
            } catch (\Exception $ex) {
                Controller::Error($ex->getMessage(), 404);
            }
        } else {
            Controller::Error("No exist an controller file named '{$controller}'.", 404);
        }
    }

    public function __destruct()
    {
        self::Map();

        Controller::Error("Invalid format router.This router no exist in config router file.", 404);
    }
}