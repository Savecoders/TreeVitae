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

            $session_id = $_SESSION['user']['ID'] ?? 0;

            $isUserAdmin = $this->model->isUserAdmin($iniciativa_id, $session_id);

            

            $isUserFollowers = $this->model->isUserFollower($iniciativa_id, $session_id);
            $isUserMenber = $this->model->isUserMember($iniciativa_id, $session_id);



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

    public function update_view()
    {
        // exist user session ?
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?c=user&f=login_view');
            return;
        }


        if (!isset($_GET['id'])) {
            redirectWithMessage(false, '', 'La iniciativa que estas buscando, no esta disponible :(', 'index.php?c=iniciativa&f=viewall');
            return;
        }

        if (!$this->model->isUserAdmin($_GET['id'], $_SESSION['user']['ID'])) {
            redirectWithMessage(false, '', 'No tienes permisos para realizar esta acción', 'index.php?c=iniciativa&f=viewall');
            return;
        }

        $iniciativa_id = (int) $_GET['id'];

        $iniciativasResult = $this->model->getById($iniciativa_id);

        if (!$iniciativasResult || count($iniciativasResult) === 0 || !is_array($iniciativasResult) || !$iniciativasResult) {
            redirectWithMessage(false, '', 'No se ha encontrado la iniciativa', 'index.php?c=iniciativa&f=viewall');
            return;
        }

        $iniciativa = $this->getIniciative([$iniciativasResult]);

        $title = 'Actualizar Iniciativa';
        $tagsRepository = new TagsRepository();
        $tags = $tagsRepository->getAll();
        require_once  VINICIATIVA . 'update.php';
    }

    public function assignFollower()
    {
        $response = array(
            'success' => false,
            'message' => '',
            'data' => null
        );

        if (!isset($_SESSION['user'])) {
            $response['message'] = 'Usuario no autenticado';
            echo json_encode($response);
            return;
        }

        if (!isset($_GET['id'])) {
            $response['message'] = 'ID de iniciativa no proporcionado';
            echo json_encode($response);
            return;
        }
        $iniciativa_id = (int) $_GET['id'];
        $user_id = (int) $_SESSION['user']['ID'];

        try {
            $isFollower = $this->model->assignUserFollower($iniciativa_id, $user_id);

            if ($isFollower) {
                $response['success'] = true;
                $response['message'] = 'Ahora sigues esta iniciativa';
            }
        } catch (Exception $e) {
            $response['message'] = 'Error al seguir la iniciativa';
            error_log('Error en assignFollower: ' . $e->getMessage());
        }

        echo json_encode($response);
    }

    public function assignMember()
    {
        $response = array(
            'success' => false,
            'message' => '',
            'data' => null
        );

        if (!isset($_SESSION['user'])) {
            $response['message'] = 'Usuario no autenticado';
            echo json_encode($response);
            return;
        }

        if (!isset($_GET['id'])) {
            $response['message'] = 'ID de iniciativa no proporcionado';
            echo json_encode($response);
            return;
        }

        $iniciativa_id = (int) $_GET['id'];
        $user_id = (int) $_SESSION['user']['ID'];

        try {
            $isMember = $this->model->assignUserMember($user_id, $iniciativa_id);

            if ($isMember) {
                $response['success'] = true;
                $response['message'] = 'Ahora eres miembro de esta iniciativa';
            } else {
                $response['message'] = 'No se pudo unir a la iniciativa';
            }
        } catch (Exception $e) {
            $response['message'] = 'Error al unirte a la iniciativa';
            error_log('Error en assignMember: ' . $e->getMessage());
        }

        echo json_encode($response);
    }
    public function removeFollower()
    {
        $response = array(
            'success' => false,
            'message' => '',
            'data' => null
        );

        if (!isset($_SESSION['user'])) {
            $response['message'] = 'Usuario no autenticado';
            echo json_encode($response);
            return;
        }

        if (!isset($_GET['id'])) {
            $response['message'] = 'ID de iniciativa no proporcionado';
            echo json_encode($response);
            return;
        }

        try {
            $iniciativa_id = (int) $_GET['id'];
            $user_id = (int) $_SESSION['user']['ID'];

            $isRemoved = $this->model->removeUserFollowIniciative($user_id, $iniciativa_id);

            if ($isRemoved) {
                $response['success'] = true;
                $response['message'] = 'Has dejado de seguir esta iniciativa';
            }
        } catch (Exception $e) {
            $response['message'] = 'Error al dejar de seguir la iniciativa';
            error_log('Error en removeFollower: ' . $e->getMessage());
        }

        echo json_encode($response);
    }

    public function removeMember()
    {
        $response = array(
            'success' => false,
            'message' => '',
            'data' => null
        );

        if (!isset($_SESSION['user'])) {
            $response['message'] = 'Usuario no autenticado';
            echo json_encode($response);
            return;
        }

        if (!isset($_GET['id'])) {
            $response['message'] = 'ID de iniciativa no proporcionado';
            echo json_encode($response);
            return;
        }

        try {
            $iniciativa_id = (int) $_GET['id'];
            $user_id = (int) $_SESSION['user']['ID'];

            $isRemoved = $this->model->removeUserMemberIniciative($user_id, $iniciativa_id);

            if ($isRemoved) {
                $response['success'] = true;
                $response['message'] = 'Has abandonado esta iniciativa';
            }
        } catch (Exception $e) {
            $response['message'] = 'Error al abandonar la iniciativa';
            error_log('Error en removeMember: ' . $e->getMessage());
        }

        echo json_encode($response);
    }



    public function update()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirectWithMessage(false, '', 'Método no permitido', 'index.php?c=iniciativa&f=viewall');
            return;
        }

        if (!isset($_GET['id'])) {
            redirectWithMessage(false, '', 'La iniciativa que estas buscando, no esta disponible :(', 'index.php?c=iniciativa&f=viewall');
            return;
        }

        if (!$this->model->isUserAdmin($_GET['id'], $_SESSION['user']['ID'])) {
            redirectWithMessage(false, '', 'No tienes permisos para realizar esta acción', 'index.php?c=iniciativa&f=viewall');
            return;
        }

        $iniciativa_id = (int) $_GET['id'];

        $iniciativa = $this->populate();

        $iniciativa->setId($iniciativa_id);

        $isUpdated = $this->model->update($iniciativa);

        if (!$isUpdated) {
            redirectWithMessage(false, '', 'Error al actualizar la iniciativa', 'index.php?c=iniciativa&f=update_view&id=' . $iniciativa_id);
            return;
        }

        $galeriaRepository = new GaleriaRepository();
        $isGaleriaAssign = $galeriaRepository->add($iniciativa);

        $isTagsAssign = $this->model->assignTags($iniciativa_id, $iniciativa->getTags());

        if (!$isGaleriaAssign || !$isTagsAssign) {
            redirectWithMessage(false, '', 'Error al actualizar la iniciativa', 'index.php?c=iniciativa&f=update_view&id=' . $iniciativa_id);
            return;
        }

        redirectWithMessage(true, 'Iniciativa actualizada con éxito', 'Iniciativa actualizada con éxito', 'index.php?c=iniciativa&f=viewall');
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
