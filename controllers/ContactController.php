<?php
class PostController
{
    private $model;

    public function __construct()
    {
        // $this->model = new IniciativaRepository();
    }

    public function viewall()
    {
        // $iniciativas = $this->model->getAll();
        require_once 'views/post/contact.viewall.php';
    }

    public function view()
    {
        // $iniciativas = $this->model->getAll();
        require_once 'views/post/contact.view.php';
    }
}
