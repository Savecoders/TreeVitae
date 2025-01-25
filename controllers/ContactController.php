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
            $parametro = limpiar($_GET['id']?? 0);
            $contactos = $this->model->getByIniciativaId($parametro);
            $session_id = $_SESSION['user']['ID'] ?? 0;
            
            $isUserAdmin = $this->model->isUserAdmin($parametro, $session_id);

            require_once VCONTACT . 'viewall.php';
        }catch(Exception $e){
            error_log('Error en ContactController@viewall: ' . $e->getMessage());
        }
    }
    
    public function view()
    {
        try{
            $parametro = limpiar($_GET['id']??"");
            $contacto = $this->model->getById($parametro);

            require_once VCONTACT . 'view.php';
        }catch(Exception $e){
            error_log('Error en ContactController@view: ' . $e->getMessage());
        }
    }

    public function search()
    {
        try {
            $asunto = limpiar($_GET['b'] ?? '');
            $iniciativa = limpiar($_GET['id'] ?? '');
            $contactos = $this->model->searchByAsunto('%' . $asunto . '%', $iniciativa);
            
            echo json_encode($contactos);
        } catch (Exception $e) {
            error_log('Error en ContactController@search: ' . $e->getMessage());
        }
    }
    
    public function new_view(){
        try{
            $parametro = limpiar($_GET['id'] ?? '');
            require_once VCONTACT . 'new.php';
        }catch(Exception $e){
            error_log('Error en ContactController@add: ' . $e->getMessage());
        }
    }

    public function new(){
        try{
            $parametro = limpiar($_GET['id'] ?? '');
            $contactoNuevo = $_POST;
            $cot = $this->populateAdd($contactoNuevo);  
            $cot->setIdIniciativa($parametro);
            $cot->setIdUsuario($_SESSION['user']['ID']);
            $cont=$this->model->add($cot);

            if($cont){
                redirectWithMessage(true, 'Contacto registrado exitosamente.', '', 'index.php?c=contact&f=viewall'.$parametro);
            }
            
            header("Location: index.php?c=contact&f=viewall&id=$parametro");
        }catch(Exception $e){
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
        return $contacto;
    }

    public function new_update(){
        try{
            $parametro = limpiar($_GET['id']);
            $contacto = $this->model->getById($parametro);
            require_once VCONTACT . 'update.php';
        }catch(Exception $e){
            error_log('Error en ContactController@update: ' . $e->getMessage());
        }
    }

    public function edit(){
        try{
            $parametro = limpiar($_GET['id']);
            $contacto = $this->populate();
            $exito = $this->model->update($contacto);
            if($exito){
                redirectWithMessage(true, 'Contacto editado exitosamente.', '', 'index.php?c=contact&f=viewall'.$parametro);
            }
            header("Location: index.php?c=contact&f=viewall&id=$parametro");
        }catch(Exception $e){
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
            $parametro = limpiar($_GET['id']);
            $parametro2 = limpiar($_GET['i']);
            $contacto = $this->model->deleteId($parametro);
            if($contacto){
                redirectWithMessage(true, 'Contacto eliminado exitosamente.', '', 'index.php?c=contact&f=viewall'.$parametro);
            }
            header("Location: index.php?c=contact&f=viewall&id=$parametro2");
        }catch(Exception $e){
            error_log('Error en ContactController@deleteId: ' . $e->getMessage());
        }
    }
}