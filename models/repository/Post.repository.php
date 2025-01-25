<?php
// Autor: Vivanco Garcia Angel Enrique
require_once 'core/DB.php';
require_once 'models/repository/IRepository.php';
require_once 'models/dto/Post.php';

class PostRepository
{
    private $con;

    public function __construct()
    {
        $this->con = DB::getInstance();
    }

    public function add($post)
    {
        try {
            $sql = "INSERT INTO posts (iniciativa_id, autor_id, titulo, subtitulo, contenido, permite_comentarios, fecha_publicacion) 
                    VALUES (:iniciativa_id, :autor_id, :titulo, :subtitulo, :contenido, :permite_comentarios, :fecha_publicacion)";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':iniciativa_id', $post->getIniciativaId(), PDO::PARAM_INT);
            $stmt->bindParam(':autor_id', $post->getAutorId(), PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $post->getTitulo(), PDO::PARAM_STR);
            $stmt->bindParam(':subtitulo', $post->getSubtitulo(), PDO::PARAM_STR);
            $stmt->bindParam(':contenido', $post->getContenido(), PDO::PARAM_STR);
            $stmt->bindParam(':permite_comentarios', $post->getPermiteComentarios(), PDO::PARAM_INT);
            $stmt->bindParam(':fecha_publicacion', $post->getFechaPublicacion(), PDO::PARAM_STR);

            $res = $stmt->execute();
            return $res;
        } catch (PDOException $e) {
            error_log("Error en add de PostRepository: " . $e->getMessage());
            return 0;
        }
    }

    public function getByIniciativaId($iniciativa_id)
    {
        try {
            $sql = "
                SELECT 
                    posts.*, 
                    usuarios.nombre_usuario 
                FROM 
                    posts
                INNER JOIN 
                    usuarios 
                ON 
                    posts.autor_id = usuarios.id
                WHERE 
                    posts.iniciativa_id = :id
                ORDER BY 
                    posts.fecha_publicacion DESC
            ";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $iniciativa_id, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            error_log("Error en getByIniciativaId de PostRepository: " . $e->getMessage());
            return [];
        }
    }


    public function isUserAutor($iniciativa_id, $usuario_id)
    {
        try {
            // Consulta para verificar si el usuario es autor de la iniciativa en los posts
            $sql = "SELECT * FROM posts WHERE iniciativa_id = :iniciativa_id AND autor_id = :usuario_id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':iniciativa_id', $iniciativa_id, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);

            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Si se encuentra un post que coincida con el usuario y la iniciativa, retorna true
            return count($res) > 0;
        } catch (PDOException $er) {
            error_log("Error en isUserAutor de PostRepository: " . $er->getMessage());
            return false;
        }
    }

    public function obtenerPosts(){
        try {
            $sql = "
            SELECT 
                posts.*, 
                usuarios.nombre_usuario 
            FROM 
                posts
            INNER JOIN 
                usuarios 
            ";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $er){
            error_log("Error en obtenerPosts de PostRepository: " . $er->getMessage());
        }
    }
    
    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM posts WHERE id = :id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOEXception $e) {
            error_log("Error en getById de PostsRepository" . $e->getMessage());
            return [];
        }
    }

    public function searchByAsunto($asunto, $parametro)
    {
        try {
            $sql = "SELECT * FROM contacto_iniciativa WHERE asunto LIKE :asunto AND iniciativa_id = :id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':asunto', $asunto, PDO::PARAM_STR);
            $stmt->bindParam(':id', $parametro, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en searchByAsunto de ContactRepository" . $e->getMessage());
            return [];
        }
    }   

    public function update($post)
    {
        try {
            $sql = "UPDATE posts 
                    SET 
                        titulo = :titulo, 
                        subtitulo = :subtitulo, 
                        contenido = :contenido, 
                        permite_comentarios = :permite_comentarios,
                        fecha_publicacion = :fecha_publicacion
                    WHERE 
                        id = :id";   
            $stmt = $this->con->prepare($sql);        
            // Vincula los parámetros de la consulta con los valores del objeto Post
            $stmt->bindParam(':titulo', $post->getTitulo(), PDO::PARAM_STR);
            $stmt->bindParam(':subtitulo', $post->getSubtitulo(), PDO::PARAM_STR);
            $stmt->bindParam(':contenido', $post->getContenido(), PDO::PARAM_STR);
            $stmt->bindParam(':permite_comentarios', $post->getPermiteComentarios(), PDO::PARAM_INT);
            $stmt->bindParam(':fecha_publicacion', $post->getFechaPublicacion(), PDO::PARAM_STR);
            $stmt->bindParam(':id', $post->getId(), PDO::PARAM_INT);
    
            // Ejecuta la consulta
            $res = $stmt->execute();
    
            return $res;
        } catch (PDOException $e) {
            error_log("Error en update de PostRepository: " . $e->getMessage());
            return false;
        }
    }
    

    public function deleteId($id)
    {
        try {
            $sql = "DELETE FROM posts WHERE id = :id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $e) {
            error_log("Error en delete de PostRepository " . $e->getMessage());
            return false;
        }
    }

}

