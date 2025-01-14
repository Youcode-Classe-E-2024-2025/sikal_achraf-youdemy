<?php

function show($stuff) {
    echo"<pre>";
    print_r($stuff);
    echo"</pre>";
}
class app {
    protected $controller= '_404';
    protected $method= 'index';

    function __construct() {
        $arr = $this->geturl();
        $filename = "../app/controller/".ucfirst($arr[0]).".php";
        if(file_exists($filename))
        {
            require $filename;
            $this->controller = $arr[0];
            unset($arr[0]);
        }else {
            require "../app/controller/".$this->controller.".php";
        }
        $myController = new $this->controller();
        $myMethod = $arr[1]??$this->method;
        if (!empty($arr[1])) 
        {
            if (method_exists($myController,strtolower($myMethod)))
            {
                $this->method = strtolower($myMethod);
                unset($arr[1]);
            }
        }
        $arr = array_values($arr);
        show($arr);
        call_user_func_array([$myController,$this->method], $arr);
    }
    private function geturl() {
        $url = $_GET['url'] ?? 'home';
        $url = filter_var($url,FILTER_SANITIZE_URL);
        $arr = explode('/',$url);
        return $arr;
    }
}
new app();