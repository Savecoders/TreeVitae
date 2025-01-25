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

    // Método para mostrar la vista del formulario de creación de un nuevo post
    public function new_view()
    {
        try {
            $parametro = htmlentities($_GET['id'] ?? '');
            require_once VPOST . 'new.php';
        } catch (PDOException $e) {
            error_log('Error en PostController@new_view: ' . $e->getMessage());
        }
    }

    // Método para procesar la creación de un nuevo post
    public function new()
    {
        try {
            $parametro = htmlentities($_GET['id'] ?? '');
            $postData = $_POST; // Datos enviados desde el formulario
            $newPost = $this->populateAdd($postData); // Llenar los datos en el objeto DTO
            $newPost->setIniciativaId($parametro); // Asocia el post a la iniciativa (u otro contexto)
            $newPost->setAutorId($_SESSION['user']['ID'] ?? 0); // Asigna el usuario que crea el post

            $this->model->add($newPost); // Llama al método para agregar el post en la base de datos

            // Redirige a la vista de todos los posts
            header("Location: index.php?c=iniciativa&f=view&id=$parametro");
        } catch (PDOException $e) {
            error_log('Error en PostController@new: ' . $e->getMessage());
        }
    }

    // Método para mapear los datos del formulario al objeto DTO
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
            $asunto = htmlentities($_GET['b'] ?? '');
            $iniciativa = htmlentities($_GET['id'] ?? '');
            $contactos = $this->model->searchByAsunto('%' . $asunto . '%', $iniciativa);
            
            echo json_encode($contactos);
        } catch (PDOException $e) {
            error_log('Error en ContactController@search: ' . $e->getMessage());
        }
    }

    public function viewall()
    {
        try {
            // Obtener el parámetro de la iniciativa desde la URL
            $parametro = htmlentities($_GET['id'] ?? 0);   
            // Obtener todos los posts relacionados con la iniciativa
            $post = $this->model->getByIniciativaId($parametro);    
            // Obtener el ID del usuario actual desde la sesión
            $session_id = $_SESSION['user']['ID'] ?? 0;   
            // Verificar si el usuario es autor de la iniciativa
            $isAutor = $this->model->isUserAutor($parametro, $session_id);  
            // Incluir la vista para mostrar los posts
            require_once VPOST . 'viewall.php';
        } catch (PDOException $e) {
            error_log('Error en PostController@viewall: ' . $e->getMessage());
        }
    }

    public function viewposts()
    {
        try {
            $post= $this->model->obtenerPosts();   
            // Incluir la vista para mostrar los posts
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

    public function edit(){
        try{
            $parametro = htmlentities($_GET['id']);
            $contacto = $this->populate();
            $exito = $this->model->update($contacto);
            header("Location: index.php?c=post&f=viewall&id=$parametro");
        }catch(PDOException $e){
            error_log('Error en ContactController@update: ' . $e->getMessage());
        }
    }
    
    public function populate() {
        $post = new Post();
        $post->setId($_POST['id']);  
        $post->setIniciativaId($_POST['iniciativa_id']);  
        $post->setAutorId($_SESSION['user']['ID']);  
        $post->setTitulo($_POST['titulo']);
        $post->setSubtitulo($_POST['subtitulo']);
        $post->setContenido($_POST['contenido']);
        $post->setPermiteComentarios($_POST['permite_comentarios']); 
        $post->setFechaPublicacion($_POST['fecha_publicacion']);  
        
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
