<?php
class ActividadController
{
    private $model;

    public function __construct()
    {
        // $this->model = new IniciativaRepository();
    }

    public function viewall()
    {
        // $iniciativas = $this->model->getAll();
        require_once 'views/actividad/actividad.viewall.php';
    }
}
