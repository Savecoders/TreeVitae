<?php
//Autor:Farfan Sanchez Abraham
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
            $parametro = htmlentities($_GET['id']?? 0);
            $contactos = $this->model->getByIniciativaId($parametro);

            if (!isset($_GET['id'])) {
                redirectWithMessage(false, '', 'Error en los contactos de esta iniciativa :(', 'index.php?c=contact&f=viewall');
                return;
            }
            $session_id = $_SESSION['user']['ID'] ?? 0;
            
            $isUserAdmin = $this->model->isUserAdmin($parametro, $session_id);

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

    public function new_view(){
        try{
            $parametro = htmlentities($_GET['id'] ?? '');
            require_once VCONTACT . 'new.php';
        }catch(PDOException $e){
            error_log('Error en ContactController@add: ' . $e->getMessage());
        }
    }

    public function new(){
        try{
            $parametro = htmlentities($_GET['id'] ?? '');
            $contactoNuevo = $_POST;
            $cot = $this->populateAdd($contactoNuevo);  
            $cot->setIdIniciativa($parametro);
            $cot->setIdUsuario($_SESSION['user']['ID']);
            $cont=$this->model->add($cot);
            
            header("Location: index.php?c=contact&f=viewall&id=$parametro");
        }catch(PDOException $e){
            error_log('Error en ContactController@add: ' . $e->getMessage());
        }
    }

    public function populateAdd($contactoNuevo){
        $contacto = new Contacto();
        $contacto->setNombres($contactoNuevo['nombres']);
        $contacto->setApellidos($contactoNuevo['apellidos']);
        $contacto->setEmail($contactoNuevo['correoElectronico']);
        $contacto->setTelefono($contactoNuevo['telefono']);
        $contacto->setPrioridad($contactoNuevo['prioridad']);
        $contacto->setAsunto($contactoNuevo['asunto']);
        $contacto->setMensaje($contactoNuevo['mensaje']);
        //$contacto->setImagen(htmlentities($contactoNuevo['foto'] ?? ''));
        return $contacto;
    }

    public function new_update(){
        try{
            $parametro = htmlentities($_GET['id']);
            $contacto = $this->model->getById($parametro);
            require_once VCONTACT . 'update.php';
        }catch(PDOException $e){
            error_log('Error en ContactController@update: ' . $e->getMessage());
        }
    }

    public function edit(){
        try{
            $parametro = htmlentities($_GET['id']);
            $contacto = $this->populate();
            $exito = $this->model->update($contacto);
            header("Location: index.php?c=contact&f=viewall&id=$parametro");
        }catch(PDOException $e){
            error_log('Error en ContactController@update: ' . $e->getMessage());
        }
    }

    public function populate(){
        $contacto = new Contacto();
        $contacto->setId($_POST['id']);
        $contacto->setNombres($_POST['nombres']);
        $contacto->setApellidos($_POST['apellidos']);
        $contacto->setEmail($_POST['correoElectronico']);
        $contacto->setTelefono($_POST['telefono']);
        $contacto->setPrioridad($_POST['prioridad']);
        $contacto->setAsunto($_POST['asunto']);
        $contacto->setMensaje($_POST['mensaje']);
        return $contacto;
    }

    public function delete()
    {
        try{
            $parametro = htmlentities($_GET['id']);
            $parametro2 = htmlentities($_GET['i']);
            $contacto = $this->model->deleteId($parametro);
            
            header("Location: index.php?c=contact&f=viewall&id=$parametro2");
        }catch(PDOException $e){
            error_log('Error en ContactController@deleteId: ' . $e->getMessage());
        }
    }
}