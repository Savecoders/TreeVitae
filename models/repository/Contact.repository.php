<?php
//Autor:Farfan Sanchez Abraham
require_once 'core/DB.php';
require_once 'models/repository/IRepository.php';
require_once 'models/dto/Contacto.php';

class ContactRepository 
{
    private $con;

    public function __construct()
    {
        $this->con = DB::getInstance();
    }

    public function getByIniciativaId($iniciativa_id)
    {
        try {
            $sql = "SELECT * FROM contacto_iniciativa WHERE iniciativa_id = :id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $iniciativa_id, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            error_log("Error en getByIniciativaId de ContactRepository " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM contacto_iniciativa WHERE id = :id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOEXception $e) {
            error_log("Error en getById de IniciativaRepository " . $e->getMessage());
            return [];
        }
    }

    public function searchByAsunto($asunto)
    {
        try {
            $sql = "SELECT * FROM contacto_iniciativa WHERE asunto LIKE :asunto";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':asunto', $asunto, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en searchByAsunto de ContactRepository " . $e->getMessage());
            return [];
        }
    }

    public function add($contacto){
        try {

            $sql = "INSERT INTO contacto_iniciativa (iniciativa_id, user_id, nombres, apellidos, email, telefono, prioridad, asunto, mensaje, imagen) VALUES (:iniciativa_id, :user_id, :nombres, :apellidos, :email, :telefono, :prioridad, :asunto, :mensaje, :imagen)";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':iniciativa_id', $contacto->getIdIniciativa(), PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $contacto->getIdUsuario(), PDO::PARAM_INT);
            $stmt->bindParam(':nombres', $contacto->getNombres(), PDO::PARAM_STR);
            $stmt->bindParam(':apellidos', $contacto->getApellidos(), PDO::PARAM_STR);
            $stmt->bindParam(':email', $contacto->getEmail(), PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $contacto->getTelefono(), PDO::PARAM_STR);
            $stmt->bindParam(':prioridad', $contacto->getPrioridad(), PDO::PARAM_STR);
            $stmt->bindParam(':asunto', $contacto->getAsunto(), PDO::PARAM_STR);
            $stmt->bindParam(':mensaje', $contacto->getMensaje(), PDO::PARAM_STR);
            $stmt->bindParam(':imagen', $contacto->getImagen(), PDO::PARAM_LOB);

            $res = $stmt->execute();
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en add de IniciativaRepository " . $er->getMessage());
            return [];
        }
    }

    public function deleteId($id)
    {
        try {
            $sql = "DELETE FROM contacto_iniciativa WHERE id = :id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $e) {
            error_log("Error en delete de IniciativaRepository " . $e->getMessage());
            return false;
        }
    }
}
