<?php

namespace App\Lib\Storage;

interface CookieInterface
{
    /*
    * Get a cookie by key.
    * @param $key cookie key value
    * @return cookie value
    */
    static function Get($key);

    /*
     * Get all cookies.
     * @return all cookies values
     */
    static function All();

    /*
     * Check if cookie exist.
     * @return 'true' or 'false'
     */
    static function Exist($key);

    /*
     * Add a new cookie.
     * @param $key cookie key value
     * @param $value cookie value
     * @param $time_life expire cookie date
     * @param $path cookie path value
     */
    static function Add($key, $value, $time_life = null, $path = null);

    /*
     * Remove a cookie.
     * @param $key cookie key value
     * @param $path cookie path value
     */
    static function Remove($key, $path = null);

    /*
     * Remove all cookies.
     * @param $path cookie path value
     */
    static function RemoveAll($path = null);
}

class Cookie implements CookieInterface
{
    /*
    * Get a cookie by key.
    * @param $key cookie key value
    * @return cookie value
    */
    public static function Get($key)
    {
        if (isset($_COOKIE[$key]))
            return $_COOKIE[$key];
        return null;
    }

    /*
     * Get all cookies.
     * @return all cookies values
     */
    public static function All()
    {
        if (isset($_COOKIE))
            return $_COOKIE;
        return null;
    }

    /*
     * Check if cookie exist.
     * @return 'true' or 'false'
     */
    public static function Exist($key)
    {
        if (isset($_COOKIE[$key]))
            return true;
        return false;
    }

    /*
     * Add a new cookie.
     * @param $key cookie key value
     * @param $value cookie value
     * @param $time_life expire cookie date
     * @param $path cookie path value
     */
    public static function Add($key, $value, $time_life = null, $path = null)
    {
        if ($time_life != null)
            $expire = time() + $time_life;
        else {
            $dtl = COOKIE_SETTING["DEFAULT_TIME_LIFE"];
            $expire = time() + ($dtl["day"] * $dtl["hours"] * $dtl["minutes"] * $dtl["seconds"]);
        }

        if (isset($key) && !empty($key) && !isset($_COOKIE[$key]))
            setcookie($key, $value, $expire, $path != null ? $path : COOKIE_SETTING["PATH"], COOKIE_SETTING["DOMAIN"], COOKIE_SETTING["SECURE"], COOKIE_SETTING["HTTPONLY"]);
    }

    /*
     * Remove a cookie.
     * @param $key cookie key value
     * @param $path cookie path value
     */
    public static function Remove($key, $path = null)
    {
        if (isset($_COOKIE[$key]))
            setcookie($key, null, -1, $path != null ? $path : COOKIE_SETTING["PATH"], COOKIE_SETTING["DOMAIN"], COOKIE_SETTING["SECURE"], COOKIE_SETTING["HTTPONLY"]);
    }

    /*
     * Remove all cookies.
     * @param $path cookie path value
     */
    public static function RemoveAll($path = null)
    {
        foreach ($_COOKIE as $key => $value)
            setcookie($key, null, -1, $path != null ? $path : COOKIE_SETTING["PATH"], COOKIE_SETTING["DOMAIN"], COOKIE_SETTING["SECURE"], COOKIE_SETTING["HTTPONLY"]);
    }
}