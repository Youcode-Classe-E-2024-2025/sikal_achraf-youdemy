<?php

function show($stuff) {
    echo"<pre>";
    print_r($stuff);
    echo"</pre>";
}
function redirect($link)
{
    header("Location: " . ROOT . "/" . $link);
    die;
}
function set_value($key, $default = '') {
    if (!empty($_POST[$key])) {
        return $_POST[$key];
    }elseif(!empty($default)) {
        return $default;
    }
    return '';
}
function set_select($key, $value,$default = '') {
    if (!empty($_POST[$key])) {
        if ($value==$_POST[$key]) {
            return ' selected ';
        }
    }elseif(!empty($default)) {
        if ($value==$default) {
            return ' selected ';
        }
    }
    return '';
}
function message($msg="", $erase=false) {
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    }else {
        if (!empty($_SESSION['message']))
        {
            $msg =  $_SESSION['message'];
            if ($erase) {
                unset($_SESSION['message']);
            }
            return $msg;
        }
    }
    return false;
}
function esc($str) {
    return nl2br(htmlspecialchars($str));
}

function str_to_url() {
    $url = str_replace("'", "", $url);
    $url = preg_replace("~[^\\pL0-9_]+~u", "-", $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace("~[^-a-z0-9_]+~", "", $url);
    return $url;
}

function dd($stuff) {
    echo"<pre>";
    var_dump($stuff);die;
    echo"</pre>";
}