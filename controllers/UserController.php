<?php
class UserController
{
    private $model;

    public function __construct()
    {
        // $this->model = new IniciativaRepository();
    }

    public function viewall()
    {
        // $iniciativas = $this->model->getAll();
        require_once 'views/user/user.profile.php';
    }

    public function login()
    {
        // $iniciativas = $this->model->getAll();
        require_once 'views/user/user.login.php';
    }

    public function register()
    {
        // $iniciativas = $this->model->getAll();
        require_once 'views/user/user.register.php';
    }
}
