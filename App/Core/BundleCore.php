<?php

namespace App\Core;

class BundleCore
{
    private static $Styles = [];

    private static $Scripts = [];

    /*
     * Add files type of CSS
     * @param string $bundleKey
     * @param array $bundlePathFiles
     * */
    public static function AddBundleStyles($bundleKey, $bundlePathFiles)
    {
        if(isset($bundleKey) && !empty($bundleKey) && is_array($bundlePathFiles)){
            array_push(self::$Styles, [$bundleKey => $bundlePathFiles]);
        }
    }

    /*
     * Add files type of JS
     * @param string $bundleKey
     * @param array $bundlePathFiles
     * */
    public static function AddBundleScripts($bundleKey, $bundlePathFiles)
    {
        if(isset($bundleKey) && !empty($bundleKey) && is_array($bundlePathFiles)){
            array_push(self::$Scripts, [$bundleKey => $bundlePathFiles]);
        }
    }

    /*
     * Create tags bundle style for links to files type of css.
     * @params string $bundle
     * @return string $formatStyles
     * */
    public static function BundleStyles($bundle)
    {
        $bundlesStyle = [];
        $formatStyles = "";

        foreach (self::$Styles as $key => $value) {
            if(array_key_exists($bundle, $value)){
                $bundlesStyle = $value[$bundle];
                break;
            }
        }

        foreach ($bundlesStyle as $key => $value){
            $formatStyles .= "<link rel='stylesheet' type='text/css' href='" . BASE_ADDRESS . "/" . APP_NAME . $value . "'/>";
        }

        return $formatStyles;
    }

    /*
     * Create tags bundle script for links to files type of css.
     * @params string $bundle
     * @return string $formatScripts
     * */
    public static function BundleScripts($bundle)
    {
        $bundlesScript = [];
        $formatScripts = "";

        foreach (self::$Scripts as $key => $value) {
            if(array_key_exists($bundle, $value)){
                $bundlesScript = $value[$bundle];
                break;
            }
        }

        foreach ($bundlesScript as $key => $value){
            $formatScripts .= "<script type='text/javascript' src='" . BASE_ADDRESS . "/" . APP_NAME . $value . "'></script>";
        }

        return $formatScripts;
    }
}