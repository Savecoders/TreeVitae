<?php
require_once 'core/DB.php';
require_once 'models/repository/IRepository.php';
require_once 'models/dto/Contacto.php';

class ContactRepository implements IRepository
{
    private $con;

    public function __construct()
    {
        $this->con = DB::getInstance();
    }

    public function add($entity): bool
    {
        try {

            $sql = "INSERT INTO contacto_iniciativa (iniciativa_id, user_id, nombres, apellidos, email, telefono, prioridad, asunto, mensaje, imagen) VALUES (:iniciativa_id, :user_id, :nombres, :apellidos, :email, :telefono, :prioridad, :asunto, :mensaje, :imagen)";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':iniciativa_id', $entity->getIdIniciativa()->getId());
            $stmt->bindParam(':user_id', $entity->getIdUsuario()->getId());
            $stmt->bindParam(':nombres', $entity->getNombre());
            $stmt->bindParam(':apellidos', $entity->getApellidos());
            $stmt->bindParam(':email', $entity->getEmail());
            $stmt->bindParam(':telefono', $entity->getTelefono());
            $stmt->bindParam(':prioridad', $entity->getPrioridad());
            $stmt->bindParam(':asunto', $entity->getAsunto());
            $stmt->bindParam(':imagen', $entity->getImagen());

            $res = $stmt->execute();
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en add de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function update($entity): bool
    {
        try {
            $sql = "UPDATE contacto_iniciativa SET nombres = :nombres, apellidos = :apellidos, email = :email, telefono = :telefono, prioridad = :prioridad, asunto = :asunto, imagen = :imagen WHERE id = :id and iniciativa_id = :iniciativa_id";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':nombres', $entity->getNombre());
            $stmt->bindParam(':apellidos', $entity->getApellidos());
            $stmt->bindParam(':email', $entity->getEmail());
            $stmt->bindParam(':telefono', $entity->getTelefono());
            $stmt->bindParam(':prioridad', $entity->getPrioridad());
            $stmt->bindParam(':asunto', $entity->getAsunto());
            $stmt->bindParam(':imagen', $entity->getImagen());
            $stmt->bindParam(':iniciativa_id', $entity->getIdIniciativa()->getId());
            $stmt->bindParam(':id', $entity->getId());

            $res = $stmt->execute();
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en update de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function delete($id): bool
    {
        try {
            $sql = "DELETE FROM contacto_iniciativa WHERE id = :id";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':id', $id);

            $res = $stmt->execute();
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en delete de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            $sql = "SELECT * FROM contacto_iniciativa";

            $stmt = $this->con->prepare($sql);

            $stmt->execute();

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en getAll de IniciativaRepository " . $er->getMessage());
            return [];
        }
    }

    public function getById($id): bool
    {
        try {
            $sql = "SELECT * FROM contacto_iniciativa WHERE id = :id";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en getById de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function filterBy($criteria): array
    {
        try {
            $sql = "SELECT * FROM contacto_iniciativa WHERE nombres LIKE :nombres";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':nombres', $criteria);

            $stmt->execute();

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en filterBy de IniciativaRepository " . $er->getMessage());
            return [];
        }
    }

    /*public function getByIniciativaId($iniciativa_id): array
    {
        try {
            $sql = "SELECT * FROM contacto_iniciativa WHERE iniciativa_id = :iniciativa_id";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':iniciativa_id', $iniciativa_id);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $er) {
            error_log("Error en getByIniciativaId de ContactRepository " . $er->getMessage());
            return [];
        }
    }*/
}
