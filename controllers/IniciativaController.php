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
        try {

            $iniciativasResult = $this->model->getAll();
            $iniciativas = $this->getIniciative($iniciativasResult);
            $tagsRepository = new TagsRepository();
            $tags = $tagsRepository->getAll();
            $title = 'Iniciativas';
            require_once  VINICIATIVA . 'viewall.php';
        } catch (Exception $e) {
            error_log('Error en IniciativaController@viewall: ' . $e->getMessage());
            redirectWithMessage(false, '', 'No podemos mostrar las iniciativas en estos momentos', 'index.php?c=iniciativa&f=viewall');
        }
    }

    public function view()
    {
        try {

            if (!isset($_GET['id'])) {
                redirectWithMessage(false, '', 'No se ha proporcionado un ID', 'index.php?c=iniciativa&f=viewall');
                return;
            }

            $iniciativa_id = (int) $_GET['id'];

            $iniciativasResult = $this->model->getById($iniciativa_id);

            if (!$iniciativasResult || count($iniciativasResult) === 0 || !is_array($iniciativasResult) || !$iniciativasResult) {
                redirectWithMessage(false, '', 'No se ha encontrado la iniciativa', 'index.php?c=iniciativa&f=viewall');
                return;
            }

            $iniciativa = $this->getIniciative([$iniciativasResult]);

            $title = 'Iniciativa';
            require_once  VINICIATIVA . 'view.php';
        } catch (Exception $e) {
            error_log('Error en IniciativaController@view: ' . $e->getMessage());
            redirectWithMessage(false, '', 'No podemos mostrar las iniciativas en estos momentos', 'index.php?c=iniciativa&f=viewall');
        }
    }

    public function new_view()
    {
        // exist user session ?
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?c=user&f=login_view');
            return;
        }

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

    private function getIniciative($resultTable)
    {
        $iniciativas = [];
        foreach ($resultTable as $row) {
            $iniciativa = new Iniciativa();
            $iniciativa->setId($row['ID']);
            $iniciativa->setNombre($row['nombre']);
            $iniciativa->setDescripcion($row['descripcion']);
            $iniciativa->setLogo($row['logo']);
            $iniciativa->setCover($row['cover']);
            $iniciativa->setFechaCreacion($row['fecha_creacion']);

            $tagsRepository = new TagsRepository();
            $tagsResult = $tagsRepository->getByInitiativeId($row['ID']);

            $tags = [];
            foreach ($tagsResult as $tagRow) {
                $tag = new Tags();
                $tag->setID($tagRow['tag_id']);
                $tag->setNombre($tagRow['nombre']);
                array_push($tags, $tag);
            }

            $iniciativa->setTags($tags);

            $iniciativa->setCreador($row['creador_id']);
            array_push($iniciativas, $iniciativa);
        }
        return $iniciativas;
    }
}
