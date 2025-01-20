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

    /*public function viewall($iniciativa_id)
    {
        $contacts = $this->model->getByIniciativaId($iniciativa_id);
        if (empty($contacts)) {
            $_SESSION['message'] = "No se encontraron contactos para esta iniciativa.";
        }
        require_once VCONTACT . 'viewall.php';

    }*/

    public function viewall()
    {
        $contactos = $this->model->getAll();
        if (empty($contactos)) {
            $_SESSION['message'] = "No se encontraron contactos.";
        }
        require_once VCONTACT . 'viewall.php';
    }
    
    public function view($id)
    {
        $contacto = $this->model->getById(limpiar($id));
        if (!$contacto) {
            redirectWithMessage(false, "", "El contacto no existe.", 'index.php?c=contacto');
            return;
        }
        $title = 'Contacto';
        require_once VCONTACT . 'view.php';
    }

    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $contacto = new Contact();
                $contacto->setNombre(limpiar($_POST['nombres'] ?? ''));
                $contacto->setApellidos(limpiar($_POST['apellidos'] ?? ''));
                $contacto->setEmail(limpiar($_POST['correoElectronico'] ?? ''));
                $contacto->setTelefono(limpiar($_POST['telefono'] ?? ''));
                $contacto->setPrioridad(limpiar($_POST['prioridad'] ?? ''));
                $contacto->setAsunto(limpiar($_POST['asunto'] ?? ''));
                $contacto->setMensaje(limpiar($_POST['mensaje'] ?? ''));

                if (!empty($_FILES['foto']['size'])) {
                    $imagen = $this->uploadFile($_FILES['foto']);
                    if ($imagen) {
                        $contacto->setImagen($imagen);
                    } else {
                        redirectWithMessage(false, "", "Error al cargar la imagen.", 'index.php?c=contacto');
                        return;
                    }
                }

                $result = $this->model->add($contacto);
                redirectWithMessage($result, "Contacto agregado correctamente.", "No se pudo agregar el contacto.", 'index.php?c=contacto');
            } catch (Exception $e) {
                error_log("Error en ContactController::new - " . $e->getMessage());
                redirectWithMessage(false, "", "Ocurrió un error inesperado.", 'index.php?c=contacto');
            }
        } else {
            require_once VACTIVIDAD . 'new.php';
        }
    }

    public function delete()
    {
        $id = limpiar($_REQUEST['id'] ?? "");
        if (!$id) {
            redirectWithMessage(false, "", "ID inválido.", 'index.php?c=contacto&f=viewall');
            return;
        }

        $exito = $this->model->delete($id);
        redirectWithMessage($exito, "Contacto eliminado correctamente.", "No se pudo eliminar el contacto.", 'index.php?c=contacto&f=viewall');
    }

    private function uploadFile($file)
    {
        $uploadDir = 'uploads/';
        $fileName = basename($file['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return $targetFile;
        }
        return false;
    }
}