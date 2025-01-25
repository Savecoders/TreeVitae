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
            $sql = "SELECT * FROM usuarios WHERE email = :email AND password = :password AND estado = 1";
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
    public function getById($id): array
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE ID = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : [];
        } catch (PDOException $er) {
            error_log("Error en getById de UsuarioRepository " . $er->getMessage());
            return [];
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
            $sql = "INSERT INTO usuarios (nombre_usuario, email, password, fecha_nacimiento, genero, foto_perfil, estado) 
                VALUES (:nombre_usuario, :email, :password, :fecha_nacimiento, :genero, :foto_perfil, :estado)";
            $stmt = $this->con->prepare($sql);

            $nombre_usuario = $entity->getNombre();
            $email = $entity->getEmail();
            $password = $entity->getPassword();
            $fecha_nacimiento = $entity->getFechaNacimiento();
            $genero = $entity->getGenero();
            $foto_perfil = $entity->getFotoPerfil();
            $estado = 1;

            // Pasar variables por referencia
            $stmt->bindParam(':nombre_usuario', $nombre_usuario);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':foto_perfil', $foto_perfil, PDO::PARAM_LOB);
            $stmt->bindParam(':estado', $estado);

            $res = $stmt->execute();
            return $res;
        } catch (PDOException $er) {
            error_log("Error en add de UsuarioRepository " . $er->getMessage());
            return false;
        }
    }

    public function update($entity): bool
    {
        try {
            $sql = "UPDATE usuarios 
                    SET nombre_usuario = :nombre, 
                        email = :email, 
                        password = :password, 
                        fecha_nacimiento = :fecha_nacimiento, 
                        foto_perfil = :foto_perfil, 
                        genero = :genero 
                    WHERE ID = :id";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':nombre', $entity->getNombre());
            $stmt->bindParam(':email', $entity->getEmail());
            $stmt->bindParam(':password', $entity->getPassword());
            $stmt->bindParam(':fecha_nacimiento', $entity->getFechaNacimiento());
            $stmt->bindParam(':foto_perfil', $entity->getFotoPerfil(), PDO::PARAM_LOB);
            $stmt->bindParam(':genero', $entity->getGenero());
            $stmt->bindParam(':id', $entity->getId());

            $res = $stmt->execute();
            return $res;
        } catch (PDOEXception $er) {
            error_log(" Error en update de UsuarioRepository " . $er->getMessage());
            return false;
        }
    }

    public function isAdminOfInitiative($userId): bool
    {
        try {
            $sql = "SELECT COUNT(*) FROM iniciativas WHERE creador_id = :userId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            return $result > 0;
        } catch (PDOException $e) {
            error_log("Error en isAdminOfInitiative: " . $e->getMessage());
            return false;
        }
    }

    public function isJoinedToSomething($userId): bool
    {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios_iniciativas_roles WHERE usuario_id = :userId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            return $result > 0;
        } catch (PDOException $e) {
            error_log("Error en isJoinedToSomething: " . $e->getMessage());
            return false;
        }
    }
    public function deactivate($id): bool
    {
        try {
            $sql = "UPDATE usuarios SET estado = 0 WHERE ID = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al desactivar usuario: " . $e->getMessage());
            return false;
        }
    }

    public function searchUsersWithInitiatives($searchTerm): array
    {
        try {
            $sql = "SELECT u.ID, u.nombre_usuario, u.email, i.id AS iniciativa_id, i.nombre AS iniciativa_nombre
                    FROM usuarios u
                    INNER JOIN iniciativas i ON u.ID = i.creador_id";

            if (!empty($searchTerm)) {
                $sql .= " WHERE u.nombre_usuario LIKE :searchTerm";
            }

            $stmt = $this->con->prepare($sql);

            if (!empty($searchTerm)) {
                $searchTerm = "%$searchTerm%";
                $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en searchUsersWithInitiatives: " . $e->getMessage());
            return [];
        }
    }
}
