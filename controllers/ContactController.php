<?php
class ContactController
{
    private $model;

    public function __construct()
    {
        $this->model = new ContactRepository();
    }

    public function viewall()
    {
        $contactos = $this->model->getAll();
        require_once 'views/post/contact.viewall.php';
    }

    public function view($id)
    {
        $contacto = $this->model->getById($id);
        if($contacto){
            require_once 'views/contact';
        }
        require_once 'views/post/contact.view.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contacto = new Contact();
            
            $contacto->setNombre($_POST['nombres']);
            $contacto->setApellidos($_POST['apellidos']);
            $contacto->setEmail($_POST['correoElectronico']);
            $contacto->setTelefono($_POST['telefono']);
            $contacto->setPrioridad($_POST['prioridad']);
            $contacto->setAsunto($_POST['asunto']);
            $contacto->setMensaje($_POST['mensaje']);

            if ($_FILES['foto']['size'] > 0) {
                $contacto->setImagen($this->uploadFile($_FILES['foto']));
            }

            $result = $this->repository->add($contacto);

            if ($result) {
                header('Location: contact.php?success=true');
                exit;
            } else {
                header('Location: contact.php?error=true');
                exit;
            }
        }

        // Si no es POST, mostrar el formulario
        require_once 'views/contact/add.php';
    }
}
