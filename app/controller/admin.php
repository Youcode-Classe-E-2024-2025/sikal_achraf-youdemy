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
    public function courses($action= null, $id= null)
    {
        if (!auth::logged_in()) {
            message("please log in");
            redirect("login");
        }
        $user_id = auth::getuser_Id();
        $course = new course();
        $data = [];
        $data['action'] = $action;
        $data['id'] = $id;
        if ($action == "add") {
            $category = new category();

            $data['categories'] = $category->findAll("asc");

            if ($_SERVER["REQUEST_METHOD"]== "POST")
            {
                if ($course->validate($_POST)) {
                    $_POST["user_id"] = $user_id;

                    $course->insert($_POST);

                    $row = $course->first(['user_id'=>$user_id]);
                    message("Your course was successfuly created");
                    if ($row) {
                        redirect('admin/courses/edit/'.$row->id);
                    }else {
                        redirect('admin/courses');
                    }
                    
                }
                $data['errors'] = $course->errors;
            }
        }
        elseif ($action == "edit") 
        {
            //////////////// get courses info ////////////////
            $data['row'] = $course->first(['user_id'=>$user_id, 'course_id'=>$id]);
        }
        else {
            //////////////// courses view ////////////////
            $data['rows'] = $course->where(['user_id'=>$user_id]);
        }

        $this->view('admin/courses',$data);
    }
    public function profile($id= null) 
    {
        $id = $id ?? auth::getuser_Id();
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