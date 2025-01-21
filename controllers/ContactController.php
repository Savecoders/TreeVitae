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

    public function new(){
        try{

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $contacto = new Contacto();
    
                $contacto->setIdIniciativa(new Iniciativa($_GET['id'] ?? 0));
                $contacto->setIdUsuario(new Usuario($_SESSION['user_id'] ?? 0)); 
    
                $contacto->setNombres(filter_input(INPUT_POST, 'nombres'));
                $contacto->setApellidos(filter_input(INPUT_POST, 'apellidos'));
                $contacto->setEmail(filter_input(INPUT_POST, 'email'));
                $contacto->setTelefono(filter_input(INPUT_POST, 'telefono'));
                $contacto->setPrioridad(filter_input(INPUT_POST, 'prioridad'));
                $contacto->setAsunto(filter_input(INPUT_POST, 'asunto'));
                $contacto->setMensaje(filter_input(INPUT_POST, 'mensaje'));
    
                if ($_FILES['imagen']['size'] > 0) {
                    $contacto->setImagen(file_get_contents($_FILES['imagen']['tmp_name']));
                }
    
                $resultado = $this->model->add($contacto);
            }
        }catch(PDOException $e){
            error_log('Error en ContactController@add: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        try{
            $parametro = htmlentities($_GET['id']??"");
            $contacto = $this->model->deleteId($parametro);

            require_once VCONTACT . 'viewall.php';
        }catch(PDOException $e){
            error_log('Error en ContactController@deleteId: ' . $e->getMessage());
        }
    }
}