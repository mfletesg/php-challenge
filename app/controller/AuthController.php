<?php

require 'app/models/Auth.php';

class AuthController {

    public function index()
    {
      $posts = Auth::get();
      require VIEWS_PATH . '/login.php';
    }

    public function create()
    {
      $posts = Auth::create();
      require VIEWS_PATH . '/create.php';
    }


}