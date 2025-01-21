<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once 'models/repository/Contact.repository.php';
require_once 'models/dto/Iniciativa.php';
require_once 'utils/redirectWithMessage.php';
require_once 'utils/cleanser.php';

class ContactController
{
    private ContactRepository $model;

    public function __construct()
    {
        $this->model = new ContactRepository();
    }

    public function viewall()
    {
        try{
            $parametro = htmlentities($_GET['id']??"");
            $contactos = $this->model->getByIniciativaId($parametro);

            require_once VCONTACT . 'viewall.php';
        }catch(PDOException $e){
            error_log('Error en ContactController@viewall: ' . $e->getMessage());
        }
    }
    
    public function view()
    {
        try{
            $parametro = htmlentities($_GET['id']??"");
            $contacto = $this->model->getById($parametro);

            require_once VCONTACT . 'view.php';
        }catch(PDOExceptrion $e){
            error_log('Error en ContactController@view: ' . $e->getMessage());
        }
    }

    public function search()
    {
        try {
            $asunto = htmlentities($_GET['asunto'] ?? '');
            $contactos = !empty($asunto) ? $this->model->searchByAsunto('%' . $asunto . '%') : $this->model->getByIniciativaId(0);
    
            require_once VCONTACT . 'viewall.php';
        } catch (PDOException $e) {
            error_log('Error en ContactController@search: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        try{
            $parametro = htmlentities($_GET['id']??"");
            $contacto = $this->model->deleteId($parametro);

            require_once VCONTACT . 'viewall.php';
        }catch(PDOException $e){
            error_log('Error en ContactController@delete: ' . $e->getMessage());
        }
    }
}