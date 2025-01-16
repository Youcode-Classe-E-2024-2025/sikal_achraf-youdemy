<?php

class profile extends Controller
{
    public function index() 
    {
        $data['errors'] = [];
        $id = $_SESSION['USER_DATA']['user_id'];
        $user= new user();
        if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $result = $user->validate($_POST);
            if ($result) {
                $user->update($id, $_POST);

                redirect('admin/profile/'.$id);
            }
        }
        $data['errors'] = $user->errors;
        $data['title'] = 'profile';
        $this->view('profile',$data);
    }
}