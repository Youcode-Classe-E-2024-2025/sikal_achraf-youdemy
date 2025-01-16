<?php

/**
 * authentification class
 */

 class Auth
 {
    public static function authenticate($row)
    {
        if (is_array($row)) {
            $_SESSION['USER_DATA'] = $row;
        }
    }
    public static function logout()
    {
        if (!empty($_SESSION['USER_DATA'])) {
            unset($_SESSION['USER_DATA']);
        }
    }
    public static function logged_in()
    {
        if (!empty($_SESSION['USER_DATA'])) {
            return true;
        }
        return false;
    }
    public static function is_admin()
    {
        if (!empty($_SESSION['USER_DATA'])) {
            if ($_SESSION['USER_DATA']['role'] == 'admin') {
                return true;
            }
        }
        return false;
    }
    public static function __callStatic($fun, $args)
    {
        $key = str_replace("get", "", strtolower($fun));
        if (!empty($_SESSION['USER_DATA'][$key])) {
            return $_SESSION['USER_DATA'][$key];
        }
        return '';
    }
 }