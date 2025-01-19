<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once 'models/repository/Iniciativa.repository.php';
require_once 'models/repository/Tags.repository.php';
require_once 'models/repository/Galeria.repository.php';
require_once 'models/dto/Iniciativa.php';
require_once 'models/dto/Tags.php';
require_once 'utils/redirectWithMessage.php';
require_once 'utils/cleanser.php';

class IniciativaController
{
    private IniciativaRespository $model;

    public function __construct()
    {
        $this->model = new IniciativaRespository();
    }

    public function viewall()
    {
        $iniciativas = $this->model->getAll();
        $tagsRepository = new TagsRepository();
        $tags = $tagsRepository->getAll();
        $title = 'Iniciativas';
        require_once  VINICIATIVA . 'viewall.php';
    }

    public function view($id)
    {
        $iniciativa = $this->model->getById($id);
        $tagsRepository = new TagsRepository();
        $tags = $tagsRepository->getAll();
        $title = 'Iniciativa';
        require_once  VINICIATIVA . 'view.php';
    }

    public function new_view()
    {
        $title = 'Crear Iniciativa';
        $tagsRepository = new TagsRepository();
        $tags = $tagsRepository->getAll();
        require_once  VINICIATIVA . 'new.php';
    }

    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirectWithMessage(false, '', 'Método no permitido', 'index.php?c=iniciativa&f=new_view');
            return;
        }

        $iniciativa = $this->populate();

        $iniciativa->setCreador($_SESSION['user']['ID']);

        $id_iniciativa = $this->model->add($iniciativa);

        if (!is_numeric($id_iniciativa)) {
            redirectWithMessage(false, '', 'Error al crear la iniciativa', 'index.php?c=iniciativa&f=new_view');
            return;
        }

        $iniciativa->setId($id_iniciativa);

        $galeriaRepository = new GaleriaRepository();
        $isGaleriaAssign = $galeriaRepository->add($iniciativa);

        $isTagsAssign = $this->model->assignTags($id_iniciativa, $iniciativa->getTags());

        // asignar administrador

        $id_user = (int) $_SESSION['user']['ID'];

        $isAssignAdmin = $this->model->assignAdmin($id_iniciativa, $id_user);

        if (!$isGaleriaAssign || !$isTagsAssign || !$isAssignAdmin) {
            redirectWithMessage(false, '', 'Error al crear la iniciativa', 'index.php?c=iniciativa&f=new_view');
            return;
        }

        redirectWithMessage(true, 'Iniciativa creada con éxito', 'Iniciativa creada con éxito', 'index.php?c=iniciativa&f=viewall');
    }

    public function populate()
    {
        $iniciativa = new Iniciativa();

        $iniciativa->setNombre(limpiar($_POST['name']));
        $iniciativa->setDescripcion(limpiar($_POST['description']));

        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $iniciativa->setLogo(file_get_contents($_FILES['logo']['tmp_name']));
        } else {
            $iniciativa->setLogo(null);
        }

        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            $iniciativa->setCover(file_get_contents($_FILES['cover']['tmp_name']));
        } else {
            $iniciativa->setCover(null);
        }

        $tags = [];
        foreach (explode(',', $_POST['selected_tags']) as $tagId) {
            $tag = new Tags();
            $tagIdNumber = (int) $tagId;
            $tag->setID($tagIdNumber);
            array_push($tags, $tag);
        }

        $galeria = [];
        if (isset($_FILES['gallery'])) {
            foreach ($_FILES['gallery']['tmp_name'] as $tmpFilePath) {
                if ($tmpFilePath) {
                    $galeria[] = file_get_contents($tmpFilePath);
                }
            }
        }

        $iniciativa->setGaleria($galeria);
        $iniciativa->setTags($tags);

        // Ensure creador is set correctly
        $iniciativa->setCreador($_SESSION['user']['ID']);

        return $iniciativa;
    }
}
