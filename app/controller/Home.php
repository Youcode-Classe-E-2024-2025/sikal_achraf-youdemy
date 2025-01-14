<?php

class home
{
    public function index() {
        echo 'home page';
    }

    public function edit() {
        echo 'home editing';
    }

    public function delete($id) {
        echo 'home deletingn '.$id;
    }
}