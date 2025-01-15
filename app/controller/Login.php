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
                        $_SESSION['USER_DATA'] = $row;

                        redirect('home');
                    }
                }
                $data['errors']['email']= "Wrong email or password";
                // message("Your account is successfuly created, Please login");
                // redirect('login');
        }
        // $data['errors'] = $user->errors;
        // $data['title'] = 'signup';
        $this->view('login',$data);
    }
}