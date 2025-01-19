<?php

class course extends model
{
    public $errors = [];
    protected $table = "courses";

    protected $afterSelect= [
        'get_category_id',
        'get_user_id',
    ];

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
            $this->errors['title'] = "A Course title onley can have small and capital letters, spaces or [_&-]";
        }

        if (empty($data['primary_subject'])) {
            $this->errors['primary_subject'] = "Primary subject is required";
        }elseif(!preg_match("/^[a-zA-Z \_\-\&]+$/",trim($data['primary_subject']))){
            $this->errors['primary_subject'] = "Primary subject onley can have small and capital letters, spaces or [_&-]";
        }

        if (empty($data['price'])) {
            $this->errors['price'] = "price is required";
        }elseif(!preg_match("/^[0-9]+$/",trim($data['price']))){
            $this->errors['price'] = "price onley can only be an integer";
        }

        if (empty($data['category_id'])) {
            $this->errors['category_id'] = "Category is required";
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    protected function get_category_id($rows)
    {
        $db = new database();
        if (!empty($rows[0]['category_id'])) {
            foreach ($rows as $key => $row) {
                $query = "select * from categories where id = :id limit 1";
                $cate = $db->query($query,['id'=>$row['category_id']]);
                if (!empty($cate)) {
                    $rows[$key]['category_row'] = $cate[0];
                }
            }
        }
        return $rows;
    }
    protected function get_user_id($rows)
    {
        $db = new database();
        if (!empty($rows[0]['user_id'])) {
            foreach ($rows as $key => $row) {
                $query = "select * from users where user_id = :id limit 1";
                $user = $db->query($query,['id'=>$row['user_id']]);
                if (!empty($user)) {
                    $user[0]['name'] = $user[0]['firstname']." ".$user[0]['lastname'];
                    $rows[$key]['user_row'] = $user[0];
                }
            }
        }
        return $rows;
    }

}