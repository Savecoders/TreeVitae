<?php
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
