<?php
/**
 * admin controller
 */
class admin extends Controller
{
    public function index() 
    {
        $data['title'] = "Dashboard";

        if (!auth::logged_in()) {
            message("please log in");
            redirect("login");
        }
        $this->view('admin/dashboard',$data);
    }
    public function courses($id= null)
    {
        if (!auth::logged_in()) {
            message("please log in");
            redirect("login");
        }
        $data = [];
        $this->view('admin/courses',$data);
    }
    public function profile($id= null) 
    {
        $is = $id ?? auth::getuser_Id();
        $user = new user();
        $data['row'] = $row = $user->first(['user_id'=>$id]);
        if (!auth::logged_in()) {
            message("please log in");
            redirect("login");
        }
        if ($_SERVER["REQUEST_METHOD"]== "POST" && $row) {
            $user->update($id, $_POST);
            redirect("admin/profile/".$id);
        }
        
        $data['title'] = "Profile";
        $this->view('admin/profile',$data);
    }
}