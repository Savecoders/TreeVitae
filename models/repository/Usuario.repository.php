<?php
//DAO: Data Access Object
require_once 'core/DB.php';
require_once 'models/repository/IRepository.php';

class UsuarioRepository implements IRepository
{
    private $con;

    public function __construct()
    {
        $this->con = DB::getInstance();
    }

    public function login($email, $password): array
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = :email AND password = :password";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : [];
        } catch (PDOException $er) {
            // echo $er->getMessage();
            error_log("Error en login de UsuarioRepository " . $er->getMessage());
            return [];
        }
    }

    public function delete($id): bool
    {
        try {
            $sql = "DELETE FROM usuarios WHERE ID = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $res = $stmt->execute();
            return $res;
        } catch (PDOException $er) {
            error_log("Error en delete de UsuarioRepository " . $er->getMessage());
            return false;
        }
    }

    public function getAll(): array
    {
        try {
            $sql = "SELECT * FROM usuarios";
            $stmt = $this->con->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $er) {
            error_log("Error en getAll de UsuarioRepository " . $er->getMessage());
            return [];
        }
    }

    public function getById($id): bool
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE ID = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $er) {
            error_log("Error en getById de UsuarioRepository " . $er->getMessage());
            return false;
        }
    }

    public function filterBy($criteria): array
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE " . $criteria;
            $stmt = $this->con->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $er) {
            error_log("Error en filterBy de UsuarioRepository " . $er->getMessage());
            return [];
        }
    }

    public function add($entity): bool
    {
        try {
            $sql = "INSERT INTO usuarios (nombre_usuario, password, email, fecha_nacimiento, foto_perfil, genero) VALUES (:nombre, :password, :email, :fecha_nacimiento, :foto_perfil, :genero)";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':nombre', $entity->getNombre());
            $stmt->bindParam(':password', $entity->getPassword());
            $stmt->bindParam(':email', $entity->getEmail());
            $stmt->bindParam(':fecha_nacimiento', $entity->getFechaNacimiento());
            $stmt->bindParam(':foto_perfil', $entity->getFotoPerfil());
            $stmt->bindParam(':genero', $entity->getGenero());

            $res = $stmt->execute();
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en add de UsuarioRepository " . $er->getMessage());
            return false;
        }
    }

    public function update($entity): bool
    {
        try {
            $sql = "UPDATE usuarios SET nombre_usuario = :nombre, password = :password, email = :email, fecha_nacimiento = :fecha_nacimiento, foto_perfil = :foto_perfil, genero = :genero WHERE ID = :id";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':nombre', $entity->getNombre());
            $stmt->bindParam(':password', $entity->getPassword());
            $stmt->bindParam(':email', $entity->getEmail());
            $stmt->bindParam(':fecha_nacimiento', $entity->getFechaNacimiento());
            $stmt->bindParam(':foto_perfil', $entity->getFotoPerfil());
            $stmt->bindParam(':genero', $entity->getGenero());
            $stmt->bindParam(':id', $entity->getId());

            $res = $stmt->execute();
            return $res;
        } catch (PDOEXception $er) {
            error_log(" Error en update de UsuarioRepository " . $er->getMessage());
            return false;
        }
    }
}
