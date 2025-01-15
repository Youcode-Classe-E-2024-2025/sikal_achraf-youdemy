<?php

class login extends Controller
{
    public function index() {
        $db= new database();
        $db->createTable();

        $data['title'] = 'login';
        $this->view('login',$data);
    }
}