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