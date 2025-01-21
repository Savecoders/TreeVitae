<?php
require_once 'core/DB.php';
require_once 'models/repository/IRepository.php';
require_once 'models/dto/Iniciativa.php';

class GaleriaRepository implements IRepository
{
    private $con;

    public function __construct()
    {
        $this->con = DB::getInstance();
    }

    public function add($entity): bool | int
    {
        try {
            for ($i = 0; $i < count($entity->getGaleria()); $i++) {
                $sql = "INSERT INTO galeria_iniciativa (iniciativa_id, imagen) VALUES (:iniciativa_id, :imagen)";
                $stmt = $this->con->prepare($sql);

                $iniciativaId = $entity->getId();
                $imagen = $entity->getGaleria()[$i];
                $stmt->bindParam(':iniciativa_id', $iniciativaId);
                $stmt->bindParam(':imagen', $imagen);
                $stmt->execute();
            }

            return true;
        } catch (PDOException $er) {
            error_log("Error en add de GaleriaRepository " . $er->getMessage());
            return false;
        }
    }

    public function update($entity): bool
    {
        try {

            $sql = "DELETE FROM galeria_iniciativa WHERE iniciativa_id = :id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $entity->getId());
            $stmt->execute();

            for ($i = 0; $i < count($entity->getGaleria()); $i++) {
                $sql = "INSERT INTO galeria_iniciativa (iniciativa_id, imagen) VALUES (:iniciativa_id, :imagen)";
                $stmt = $this->con->prepare($sql);
                $stmt->bindParam(':iniciativa_id', $entity->getId());
                $stmt->bindParam(':imagen', $entity->getGaleria()[$i]);
                $stmt->execute();
            }
            return true;
        } catch (PDOException $er) {
            error_log("Error en update de GaleriaRepository " . $er->getMessage());
            return false;
        }
    }

    public function delete($id): bool
    {
        try {
            $sql = "DELETE FROM galeria_iniciativa WHERE ID = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $er) {
            error_log("Error en delete de GaleriaRepository " . $er->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            $sql = "SELECT * FROM galeria_iniciativa";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $er) {
            error_log("Error en getAll de GaleriaRepository " . $er->getMessage());
            return [];
        }
    }

    public function getById(int $id): bool
    {
        try {
            $sql = "SELECT * FROM galeria_iniciativa WHERE iniciativa_id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $er) {
            error_log("Error en getById de GaleriaRepository " . $er->getMessage());
            return false;
        }
    }

    public function filterBy(int $condition): array
    {
        try {
            $sql = "SELECT * FROM galeria_iniciativa WHERE iniciativa_id = :iniciativa_id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':iniciativa_id', $condition);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $er) {
            error_log("Error en filterBy de GaleriaRepository " . $er->getMessage());
            return [];
        }
    }
}
