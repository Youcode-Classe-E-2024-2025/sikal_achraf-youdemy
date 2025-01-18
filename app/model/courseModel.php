<?php

class course extends model
{
    public $errors = [];
    protected $table = "courses";

    protected $queryColumns= [
        'title',
        'description',
        'user_id',
        'price',
        'primary_subject',
        'course_image',
        'category_id',
        'created_at'
    ];
    public function validate($data) {
        $this->errors = [];
        if (empty($data['title'])) {
            $this->errors['title'] = "A Course title is required";
        }elseif(!preg_match("/^[a-zA-Z \_\-\&]+$/",trim($data['title']))){
            $this->errors['title'] = "A Course title onley can have small and capital letters spaces [_&-]";
        }
        
        if (empty($data['category_id'])) {
            $this->errors['category_id'] = "Category is required";
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
    

}