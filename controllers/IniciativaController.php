<?php
require_once 'models/repository/Iniciativa.repository.php';
require_once 'models/dto/Iniciativa.php';

class IniciativaController
{
    private $model;

    public function __construct()
    {
        $this->model = new IniciativaRespository();
    }

    public function viewall()
    {
        $iniciativas = $this->model->getAll();
        $title = 'Iniciativas';
        require_once  VINICIATIVA . 'viewall.php';
    }
}
