<?php
class category extends model
{
    public $errors = [];
    protected $table = "categories";

    protected $queryColumns= [
        "category"
    ];
    public function validate($data) {
        $this->errors = [];
        if (empty($data['category'])) {
            $this->errors['category'] = "A category is required";
        }elseif(!preg_match("/^[a-zA-Z]+$/",trim($data['lastname']))){
            $this->errors['category'] = "category onley can have small and capital letters";
        }
        
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
    

}