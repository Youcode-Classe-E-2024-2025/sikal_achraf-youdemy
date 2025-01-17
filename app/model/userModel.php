<?php
class user extends model
{
    public $errors = [];
    protected $table = "users";

    protected $queryColumns= [
        "lastname",
        "firstname",
        "email",
        "password",
        "role",
        "slug",
        "about",
        "company",
        "country",
        "address",
        "phone",
        "job"
    ];
    public function validate($data) {
        $this->errors = [];
        if (empty($data['firstname'])) {
            $this->errors['firstname'] = "First name is required";
        }elseif(!preg_match("/^[a-zA-Z]+$/",trim($data['firstname']))){
            $this->errors['firstname'] = "First name onley can have small and capital letters";
        }
        
        if (empty($data['lastname'])) {
            $this->errors['lastname'] = "Last name is required";
        }elseif(!preg_match("/^[a-zA-Z]+$/",trim($data['lastname']))){
            $this->errors['lastname'] = "Last name onley can have small and capital letters";
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