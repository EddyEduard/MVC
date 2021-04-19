<?php

namespace App\Lib\Storage;

interface SessionInterface
{
    /*
     * Get a session by key.
     * @param $key session key value
     * @return session value
     */
    static function Get($key);

    /*
     * Get all sessions.
     * @return sessions values
     */
    static function All();

    /*
     * Check if session exist.
     * @param $key session key value
     * @return 'true' or 'false'
     */
    static function Exist($key);

    /*
     * Add a new session.
     * @param $key session key value
     * @param $value session value
     */
    static function Add($key, $value);

    /*
     * Edit a session.
     * @param $key session key value
     * @param $value session value
     */
    static function Edit($key, $value);

    /*
     * Remove a session.
     * @param $key session key value
     */
    static function Remove($key);

    /*
     * Remove all session.
     */
    static function RemoveAll();
}

class Session implements SessionInterface
{
    /*
     * Get a session by key.
     * @param $key session key value
     * @return session value
     */
    public static function Get($key)
    {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
    }

    /*
     * Get all sessions.
     * @return sessions values
     */
    public static function All()
    {
        if(isset($_SESSION))
            return $_SESSION;
    }

    /*
     * Check if session exist.
     * @param $key session key value
     * @return 'true' or 'false'
     */
    public static function Exist($key)
    {
        if (isset($_SESSION[$key]))
            return true;
        return false;
    }

    /*
     * Add a new session.
     * @param $key session key value
     * @param $value session value
     */
    public static function Add($key, $value)
    {
        if(isset($key) && !empty($key) && !isset($_SESSION[$key]))
            $_SESSION[$key] = $value;
    }

    /*
     * Edit a session.
     * @param $key session key value
     * @param $value session value
     */
    public static function Edit($key, $value)
    {
        if(isset($key) && !empty($key) && isset($_SESSION[$key]))
            $_SESSION[$key] = $value;
    }

    /*
     * Remove a session.
     * @param $key session key value
     */
    public static function Remove($key)
    {
        if(isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }

    /*
     * Remove all session.
     */
    public static function RemoveAll()
    {
        if(isset($_SESSION))
            unset($_SESSION);
    }
}