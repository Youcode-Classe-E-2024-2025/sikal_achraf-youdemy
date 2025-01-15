<?php
// /////////////// factory ////////////////

// abstract class user {
//     private $name;
//     private $email;
//     private $password;
//     abstract public function login($email, $password);
//     abstract public function signup($name, $email, $password);
// }

// /////////////// student factory ////////////////

// class student extends user {
//     public function signup($name, $email, $password) {
//         return new studentSignup($name, $email, $password);
//     }
//     public function login($email, $password) {
//         return new studentLogin($email, $password);
//     }
// }

// /////////////// teacher factory ////////////////

// class teacher extends user {
//     public function signup($name, $email, $password) {
//         return new teacherSignup($name, $email, $password);
//     }
//     public function login($email, $password) {
//         return new teacherLogin($email, $password);
//     }
// }

// ////////////// student products //////////////

// class studentSignup {
//     public function __construct($name, $email, $password) {
//         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
//         $role = "student";
//         $this->connect = (new Database)->db;
//         $stmt = $this->connect->prepare("INSERT INTO Users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
//         return $stmt->execute([$name, $email, $hashedPassword, $role]);
//     }
// }

// class studentLogin {
//     public function __construct($email, $password) {
        
//     }
// }

// ////////////// teacher products //////////////

// class teacherSignup {
//     public function __construct($name, $email, $password) {
//         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
//         $role = "teacher";
//         $this->connect = (new Database)->db;
//         $stmt = $this->connect->prepare("INSERT INTO Users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
//         return $stmt->execute([$name, $email, $hashedPassword, $role]);
//     }
// }

// class teacherLogin {
//     public function __construct($email, $password) {
        
//     }
// }
// $sign = new teacher();
// $sign->signup("shqskj","hsjd",'sdhjkq');
// $sign = new student();
// $sign->signup();

// function login($email) {
//     $this->connect = (new Database)->db;
//     $stmt = $this->connect->prepare("SELECT * FROM Users WHERE email = ?;");
//     $stmt->execute([$email]);
//     $stmt->fetch(PDO::FETCH_ASSOC);
//     if ($user) {
//         if (password_verify($password, $user['password'])) {
//             echo "Password is correct!<br>";
//             return $user;
//         } else {
//             echo "Password is incorrect!<br>";
//             header("Location: ../view/login/login.php?error=Password_or_email_incorrect");
//             return false;
//         }
//     } else {
//         header("Location: ../view/login/login.php?error=Password_or_email_incorrect");
//         return false;
//     }
// }


class user extends model
{
    public $errors = [];
    protected $table = "users";

    protected $queryColumns= [
        "lastname",
        "firstname",
        "email",
        "password",
        "role"
    ];
    public function validate($data) {
        $this->errors = [];
        if (empty($data['firstname'])) {
            $this->errors['firstname'] = "First name is required";
        }
        
        if (empty($data['lastname'])) {
            $this->errors['lastname'] = "last name is required";
        }
        
        if (empty($data['email'])) {
            $this->errors['email'] = "email is required";
        }
            if (!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "email is not valide";
            }else
            if ($this->where(['email'=>$data['email']])) {
                $this->errors['email'] = "email already existes";
            }
        
        if (empty($data['password'])) {
            $this->errors['password'] = "password is required";
        }
        
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
    

}