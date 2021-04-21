<?php

namespace App\Core;

use Exception;

class Application
{
    private $config_files = [
        "Config", "Routes", "Bundles"
    ];

    private $core_files = [
        "Route", "Error", "APIController", "BaseController", "Model", "Request", "Bundle"
    ];

    private $libraries_files = [
        "Database" => [
            "MySQLConnection", "MySQLDatabase"
        ],
        "Storage" => [
            "Cookie", "Session"
        ]
    ];

    // Run application.
    public function Run()
    {
        try {
            $this->IncludeCore();
            $this->IncludeConfig();
            $this->IncludeLibraries();
            $this->IncludeModels();

            $route = new Route();
            $route->init();
        } catch (Exception $exception) {
            $error = new Error();
            $error->init($exception);
            $error->redirect("Views/Error.php");
        }
    }

    // Include core files in project.
    private function IncludeCore()
    {
        foreach ($this->core_files as $core_file) {
            $path = "Core/" . $core_file . ".php";
            if (file_exists($path))
                include $path;
            else
                throw new Exception("There is no a file named '{$path}'.", 404);
        }
    }

    // Include config files in project.
    private function IncludeConfig()
    {
        foreach ($this->config_files as $config_file) {
            $path = "Config/" . $config_file . ".php";
            if (file_exists($path))
                include $path;
            else
                throw new Exception("There is no a file named '{$path}'.", 404);
        }
    }

    // Include libraries files in project.
    private function IncludeLibraries()
    {
        foreach ($this->libraries_files as $library_folder => $library_files) {
            foreach ($library_files as $library_file) {
                $path = "Lib/" . $library_folder . "/" . $library_file . ".php";
                if (file_exists($path))
                    include $path;
                else
                    throw new Exception("There is no a file named '{$path}'.", 404);
            }
        }
    }

    // Include models files in project.
    private function IncludeModels()
    {
        $models_files = array_diff(scandir("Models"), array(".", ".."));
        foreach ($models_files as $model_file) {
            $path = "Models/" . $model_file;
            if (file_exists($path))
                include $path;
            else
                throw new Exception("There is no a file named '{$path}'.", 404);
        }
    }
}