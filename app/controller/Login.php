<?php

class login extends Controller
{
    public function index() 
    {
        $data['title'] = "login";
        $data['errors'] = [];
        $user= new user();
        if ($_SERVER["REQUEST_METHOD"]== "POST") {
                $row = $user->first(['email'=>$_POST['email']]);
                if ($row) {
                    if ($row['password'] === $_POST['password']) {
                        Auth::authenticate($row);
                        redirect('home');
                    }
                }
                $data['errors']['email']= "Wrong email or password";
        }
        $this->view('login',$data);
    }
}