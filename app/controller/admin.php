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
        $user_id = Auth::getId();
		$course = new Course();
		$category = new Category();
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
            if ($_SERVER["REQUEST_METHOD"]== "POST")
            {
                $id = trim($_GET['url'],'admin/courses/edit/');
                // ///////////////////////////////////////////// file upload star /////////////////////////////////////
                // $target_dir = "uploads/";
                // $target_file = $target_dir . basename($_FILES["IMG"]["name"]);
                // $uploadOk = 1;
                // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // // Check if image file is a actual image or fake image
                // if(isset($_POST)) {
                //     $check = getimagesize($_FILES["IMG"]["tmp_name"]);
                //     if($check !== false) {
                //         echo "File is an image - " . $check["mime"] . ".";
                //         $uploadOk = 1;
                //     } else {
                //         echo "File is not an image.";
                //         $uploadOk = 0;
                //     }
                // }

                // // Check if file already exists
                // if (file_exists($target_file)) {
                //     echo "Sorry, file already exists.";
                //     $uploadOk = 0;
                // }

                // // Check file size
                // if ($_FILES["IMG"]["size"] > 50000000) {
                //     echo "Sorry, your file is too large.";
                //     $uploadOk = 0;
                // }

                // // Allow certain file formats
                // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                //     $uploadOk = 0;
                // }

                // // Check if $uploadOk is set to 0 by an error
                // if ($uploadOk == 0) {
                //     echo "Sorry, your file was not uploaded.";
                // // if everything is ok, try to upload file
                // } else {
                //     if (move_uploaded_file($_FILES["IMG"]["tmp_name"], $target_file)) {
                //         echo "The file ". htmlspecialchars( basename( $_FILES["IMG"]["name"])). " has been uploaded.";
                //     } else {
                //         echo "Sorry, there was an error uploading your file.";
                //     }
                // }
                // ////////////////////////////////////////// file upload end /////////////////////////////////////////
                // dd($_FILES);
                $course->update($id, $_POST,'course_id');
                redirect('admin/courses/edit/'.$id);
            }
            //////////////// get courses info ////////////////
            $data['categories'] = $category->findAll("asc");
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