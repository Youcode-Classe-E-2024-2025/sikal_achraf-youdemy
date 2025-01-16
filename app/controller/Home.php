<?php

class home extends Controller
{
    public function index() {
        $db= new database();
        $db->createTable();

        $data['title'] = 'home';
        $this->view('home',$data);
    }
}