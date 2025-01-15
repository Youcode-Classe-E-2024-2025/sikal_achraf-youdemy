<?php

class signup extends Controller
{
    public function index() 
    {
        $data['errors'] = [];
        $user= new user();
        if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $result = $user->validate($_POST);
            if ($result) {
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user->insert($_POST);

                message("Your account is successfuly created, Please login");
                redirect('login');
            }
        }
        $data['errors'] = $user->errors;
        $data['title'] = 'signup';
        $this->view('signup',$data);
    }
}