<?php

class logout extends Controller
{
    public function index() 
    {
        auth::logout();
        redirect('home');
    }
}