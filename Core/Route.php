<?php

namespace App\Core;

use Exception;
use ReflectionMethod;

interface RouteInterface
{
    /*
    * Route initialization.
    * */
    function init();

    /*
     * Create request method: GET.
     * @param $path path route
     * @param $map map route
     * */
    static function Get($path, $map);

    /*
     * Create request method: POST.
     * @param $path path route
     * @param $map map route
     * */
    static function Post($path, $map);

    /*
     * Create request method: PUT.
     * @param $path path route
     * @param $map map route
     * */
    static function Put($path, $map);

    /*
     * Create request method: DELETE.
     * @param $path path route
     * @param $map map route
     * */
    static function Delete($path, $map);
}

class Route implements RouteInterface
{
    private static $paths = [];

    private $isFoundRoute = false;

    private $foundRoute = null;

    private $paramsRoute = [];

    /*
     * Route initialization.
     * */
    public function init()
    {
        $this->ValidateCountPath();
        $this->ValidateContentPath();

        $map = $this->foundRoute["map"];

        if ($this->isFoundRoute && is_object($map))
            call_user_func_array(($map), $this->paramsRoute);
        else if ($this->isFoundRoute && !is_object($map))
            $this->callController($map["controller"], $map["action"], $this->paramsRoute);
        else
            throw new Exception("Invalid format route.This router no exist in config route file.", 404);
    }

    /*
     * Create request method: GET.
     * @param $path path route
     * @param $map map route
     * */
    public static function Get($path, $map)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            array_push(self::$paths, [
                "path" => $path,
                "map" => $map
            ]);
        }
    }

    /*
     * Create request method: POST.
     * @param $path path route
     * @param $map map route
     * */
    public static function Post($path, $map)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            array_push(self::$paths, [
                "path" => $path,
                "map" => $map
            ]);
        }
    }

    /*
     * Create request method: PUT.
     * @param $path path route
     * @param $map map route
     * */
    public static function Put($path, $map)
    {
        if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            array_push(self::$paths, [
                "path" => $path,
                "map" => $map
            ]);
        }
    }

    /*
     * Create request method: DELETE.
     * @param $path path route
     * @param $map map route
     * */
    public static function Delete($path, $map)
    {
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            array_push(self::$paths, [
                "path" => $path,
                "map" => $map
            ]);
        }
    }

    /*
    * Request url.
    * @return an explode array with all values from url
    * */
    private function url()
    {
        if (isset($_REQUEST["url"]) && !empty($_REQUEST["url"])) {
            return explode("/", filter_var(rtrim($_REQUEST["url"], "/"), FILTER_SANITIZE_URL));
        }

        return [];
    }

    /*
     * Validate count path.
     * */
    private function ValidateCountPath()
    {
        $url = $this->url();

        foreach (self::$paths as $key => $value) {
            if (isset($value["path"]) && !empty($value["path"])) {
                if ($value["path"] != "/" && count($url) > 0) {
                    $path = explode("/", filter_var(trim($value["path"], "/"), FILTER_SANITIZE_STRING));
                    if (count($url) != count($path))
                        unset(self::$paths[$key]);
                } else if ($value["path"] == "/" && count($url) != 0) {
                    unset(self::$paths[$key]);
                }
            }
        }
    }

    /*
     * Validate content path route, get the parameters from request url and and found the route.
     * */
    private function ValidateContentPath()
    {
        foreach (self::$paths as $key => $value) {
            if ($value["path"] == "/") {
                $this->isFoundRoute = true;
                $this->foundRoute = $value;
                break;
            }

            $url = $this->url();
            $path = explode("/", filter_var(trim($value["path"], "/"), FILTER_SANITIZE_STRING));
            $count_path = count($path);

            for ($i = 0; $i <= $count_path; $i++) {
                if (array_key_exists($i, $url) && array_key_exists($i, $path) && strtolower($url[$i]) == strtolower($path[$i])) {
                    unset($path[$i]);
                    unset($url[$i]);
                }
            }

            if (count($url) == count($path)) {
                $validate_params = [];

                foreach ($path as $value_path)
                    array_push($validate_params, preg_match('/[\'\\{\}\|\\\]/', $value_path));

                if (array_sum($validate_params) != count($validate_params))
                    unset(self::$paths[$key]);
                else {
                    $this->isFoundRoute = true;
                    $this->foundRoute = $value;
                    $this->paramsRoute = array_combine($path, $url);
                    break;
                }
            }
        }
    }

    /*
     * Call a controller from an file.
     * @param controller name
     * @param action name
     * @param parameters route
     * */
    private function callController($controller, $action, $params = [])
    {
        if (file_exists("Controllers/" . $controller . "Controller.php")) {
            require_once "Controllers/" . $controller . "Controller.php";

            if (class_exists($controller . "Controller") === false)
                throw new Exception("No exist an controller named '{$controller}'.", 404);

            $reflection = new ReflectionMethod($controller . "Controller", $action);
            $params_count = $reflection->getNumberOfRequiredParameters();

            if ($params_count != count($params))
                throw new Exception("Error format router.This route must to contains '{$params_count}' params.", 404);

            call_user_func_array([$controller . "Controller", $action], $params);
        } else
            throw new Exception("No exist an controller file named '{$controller}'.", 404);
    }
}