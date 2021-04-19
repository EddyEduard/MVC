<?php

namespace App\Core;

interface BundleInterface
{
    /*
     * Add files type of CSS.
     * @param $bundleKey bundle key
     * @param $bundlePathFiles paths to files
     * */
    static function AddStyles($bundleKey, $bundlePathFiles);

    /*
     * Add files type of JavaScript.
     * @param $bundleKey bundle key
     * @param $bundlePathFiles path to files
     * */
    static function AddScripts($bundleKey, $bundlePathFiles);

    /*
     * Create links for files type of CSS.
     * @params $bundle bundle key
     * @return links tags
     * */
    static function Styles($bundle);

    /*
     * Create scripts for files type of JavaScript.
     * @params $bundle bundle key
     * @return scripts tags
     * */
    static function Scripts($bundle);
}

class Bundle implements BundleInterface
{
    private static $Styles = [];

    private static $Scripts = [];

    /*
     * Add files type of CSS.
     * @param $bundleKey bundle key
     * @param $bundlePathFiles paths to files
     * */
    public static function AddStyles($bundleKey, $bundlePathFiles)
    {
        if(isset($bundleKey) && !empty($bundleKey) && is_array($bundlePathFiles))
            array_push(self::$Styles, [$bundleKey => $bundlePathFiles]);
    }

    /*
     * Add files type of JavaScript.
     * @param $bundleKey bundle key
     * @param $bundlePathFiles path to files
     * */
    public static function AddScripts($bundleKey, $bundlePathFiles)
    {
        if(isset($bundleKey) && !empty($bundleKey) && is_array($bundlePathFiles))
            array_push(self::$Scripts, [$bundleKey => $bundlePathFiles]);
    }

    /*
     * Create links for files type of CSS.
     * @params $bundle bundle key
     * @return links tags
     * */
    public static function Styles($bundle)
    {
        $bundlesStyle = [];
        $formatStyles = "";

        foreach (self::$Styles as $key => $value) {
            if(array_key_exists($bundle, $value)){
                $bundlesStyle = $value[$bundle];
                break;
            }
        }

        foreach ($bundlesStyle as $key => $value)
            $formatStyles .= "<link rel='stylesheet' type='text/css' href='" . BASE_ADDRESS . $value . "'/>";

        echo $formatStyles;
    }

    /*
     * Create scripts for files type of JavaScript.
     * @params $bundle bundle key
     * @return scripts tags
     * */
    public static function Scripts($bundle)
    {
        $bundlesScript = [];
        $formatScripts = "";

        foreach (self::$Scripts as $key => $value) {
            if(array_key_exists($bundle, $value)){
                $bundlesScript = $value[$bundle];
                break;
            }
        }

        foreach ($bundlesScript as $key => $value)
            $formatScripts .= "<script type='text/javascript' src='" . BASE_ADDRESS . $value . "'></script>";

        echo $formatScripts;
    }
}