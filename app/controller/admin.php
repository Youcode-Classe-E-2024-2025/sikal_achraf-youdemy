<?php
/**
 * admin controller
 */
class admin extends Controller
{
    public function index() 
    {
        $data['title'] = "admin";
        
        $this->view('admin',$data);
    }
}