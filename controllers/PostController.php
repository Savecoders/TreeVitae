<?php
//Autor: Vivanco Garcia Angel Enrique
if (!isset($_SESSION)) {
    session_start();
}
require_once 'models/repository/Post.repository.php';
require_once 'models/dto/Post.php';
require_once 'utils/redirectWithMessage.php';
require_once 'utils/cleanser.php';
require_once 'utils/redirectWithMessage.php';

class PostController
{
    private PostRepository $model;

    public function __construct()
    {
        $this->model = new PostRepository();
    }

    public function new_view()
    {
        try {
            $parametro = htmlentities($_GET['id'] ?? '');
            require_once VPOST . 'new.php';
        } catch (PDOException $e) {
            error_log('Error en PostController@new_view: ' . $e->getMessage());
        }
    }

    public function new()
    {
        try {
            $parametro = htmlentities($_GET['id'] ?? '');
            $postData = $_POST; 
            $newPost = $this->populateAdd($postData); 
            $newPost->setIniciativaId($parametro); 
            $newPost->setAutorId($_SESSION['user']['ID'] ?? 0); 
            $this->model->add($newPost); 
            header("Location: index.php?c=iniciativa&f=view&id=$parametro");
        } catch (PDOException $e) {
            error_log('Error en PostController@new: ' . $e->getMessage());
        }
    }

    private function populateAdd(array $postData): Post
    {
        $post = new Post();
        $post->setTitulo(htmlentities($postData['titulo'] ?? ''));
        $post->setSubtitulo(htmlentities($postData['subtitulo'] ?? ''));
        $post->setContenido(htmlentities($postData['contenido'] ?? ''));
        $post->setPermiteComentarios(htmlentities($postData['permite_comentarios'] ?? '0'));
        $post->setFechaPublicacion(htmlentities($postData['fecha_publicacion'] ?? null));
        return $post;
    }

    public function search()
    {
        try {
            $titulo = htmlentities($_GET['t'] ?? ''); 
            $posts = $this->model->searchByTitle('%' . $titulo . '%'); 
    
            echo json_encode($posts); 
        } catch (PDOException $e) {
            error_log('Error en PostController@search: ' . $e->getMessage());
        }
    }
    
    public function viewall()
    {
        try {
            $parametro = htmlentities($_GET['id'] ?? 0);   
            $post = $this->model->getByIniciativaId($parametro);    
            $session_id = $_SESSION['user']['ID'] ?? 0;   
            $isAutor = $this->model->isUserAutor($parametro, $session_id);  
            require_once VPOST . 'viewall.php';
        } catch (PDOException $e) {
            error_log('Error en PostController@viewall: ' . $e->getMessage());
        }
    }

    public function viewposts()
    {
        try {
            $post= $this->model->obtenerPosts();   
            require_once VPOST . 'viewall.php';
        } catch (PDOException $e) {
            error_log('Error en PostController@viewall: ' . $e->getMessage());
        }
    }
    
    public function view()
    {
        // $iniciativas = $this->model->getAll();
        require_once 'views/post/post.view.php';
    }

    public function new_update() {
        try {
            $parametro = htmlentities($_GET['id']);
            $post = $this->model->getById($parametro);
            require_once VPOST . 'update.php'; 
        } catch (PDOException $e) {
            error_log('Error en PostController@new_update: ' . $e->getMessage());
        }
    }

    public function edit() {
        try {
            $parametro = htmlentities($_GET['id']);
            $post = $this->populate();
            $exito = $this->model->update($post);
            if ($exito) {
                header("Location: index.php?c=post&f=viewall&id=$parametro");
            } else {
                header("Location: index.php?c=post&f=new_update&id=$parametro&error=1");
            }
        } catch (PDOException $e) {
            error_log('Error en PostController@edit: ' . $e->getMessage());
        }
    }

    public function populate() {
        $post = new Post();
        $post->setId($_POST['id']);
        $post->setTitulo($_POST['titulo']);
        $post->setSubtitulo($_POST['subtitulo']);
        $post->setContenido($_POST['contenido']);
        $post->setPermiteComentarios($_POST['permite_comentarios']);
        $post->setFechaPublicacion(date('Y-m-d H:i:s')); 
        return $post;
    }

    public function delete()
    {
        try{
            $parametro = htmlentities($_GET['id']);
            $parametro2 = htmlentities($_GET['i']);
            $post = $this->model->deleteId($parametro);
            if($post){
                redirectWithMessage(true, 'post eliminado con exito', '', 'index.php?c=post&f=viewall&id='.$parametro2);
            }
        }catch(PDOException $e){
            error_log('Error en ContactController@deleteId: ' . $e->getMessage());
        }
    }

}
