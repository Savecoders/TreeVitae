<?php
//Autor: Pincay Alvarez Pablo Salvador
require_once 'core/DB.php';
require_once 'models/repository/IRepository.php';
require_once 'models/dto/Iniciativa.php';

class IniciativaRespository implements IRepository
{
    private $con;

    public function __construct()
    {
        $this->con = DB::getInstance();
    }

    public function add($entity): bool | int
    {
        try {
            $sql = "INSERT INTO iniciativas (nombre, descripcion, logo, cover, fecha_creacion, creador_id) VALUES (:nombre, :descripcion, :logo, :cover, :fecha_creacion, :creador)";
            $stmt = $this->con->prepare($sql);

            $nombre = $entity->getNombre();
            $descripcion = $entity->getDescripcion();
            $logo = $entity->getLogo();
            $cover = $entity->getCover();
            $fecha_creacion = date('Y-m-d H:i:s');
            $creador = $entity->getCreador();

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':logo', $logo);
            $stmt->bindParam(':cover', $cover);
            $stmt->bindParam(':fecha_creacion', $fecha_creacion);
            $stmt->bindParam(':creador', $creador);

            $stmt->execute();
            return $this->con->lastInsertId();
        } catch (PDOException $er) {
            error_log("Error en add de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function assignAdmin($iniciativa_id, $usuario_id): bool
    {
        try {

            $iniciativa = (int) $iniciativa_id;
            $usuario = (int) $usuario_id;
            $rol_id = 1;
            $sql = "INSERT INTO usuarios_iniciativas_roles (iniciativa_id, usuario_id, rol_id) VALUES (:iniciativa_id, :usuario_id, :rol_id)";
            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':iniciativa_id', $iniciativa);
            $stmt->bindParam(':usuario_id', $usuario);
            $stmt->bindParam(':rol_id', $rol_id);

            $stmt->execute();

            return true;
        } catch (PDOException $er) {
            error_log("Error en assignAdmin de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function assignTags($id, $tags): bool
    {
        try {
            // First delete existing tags
            $sqlDelete = "DELETE FROM iniciativa_tags WHERE iniciativa_id = :iniciativa_id";
            $stmtDelete = $this->con->prepare($sqlDelete);
            $stmtDelete->bindParam(':iniciativa_id', $id);
            $stmtDelete->execute();

            // Then insert new tags
            foreach ($tags as $tag) {
                $sql = "INSERT INTO iniciativa_tags (iniciativa_id, tag_id) VALUES (:iniciativa_id, :tag_id)";
                $stmt = $this->con->prepare($sql);

                $tagId = $tag->getID();
                $stmt->bindParam(':iniciativa_id', $id);
                $stmt->bindParam(':tag_id', $tagId);

                $stmt->execute();
            }
            return true;
        } catch (PDOException $er) {
            error_log("Error en assignTags de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function update($entity): bool
    {
        try {
            $sql = "UPDATE iniciativas SET nombre = :nombre, descripcion = :descripcion, logo = :logo, cover = :cover WHERE id = :id and creador_id = :creador";

            $stmt = $this->con->prepare($sql);

            $nombre = $entity->getNombre();
            $descripcion = $entity->getDescripcion();
            $logo = $entity->getLogo();
            $cover = $entity->getCover();
            $creador = $entity->getCreador();
            $id = $entity->getId();

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':logo', $logo);
            $stmt->bindParam(':cover', $cover);
            $stmt->bindParam(':creador', $creador);
            $stmt->bindParam(':id', $id);

            $res = $stmt->execute();
            return $res;
        } catch (PDOException $er) {
            error_log("Error en update de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function delete($id): bool
    {
        try {
            $sql = "UPDATE iniciativas SET estado = 'Inactiva' WHERE ID = :id";

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
            $sql = "SELECT * FROM iniciativas WHERE estado = 'Activa'";

            $stmt = $this->con->prepare($sql);

            $stmt->execute();

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en getAll de IniciativaRepository " . $er->getMessage());
            return [];
        }
    }

    public function getById($id): array | bool
    {
        try {
            $sql = "SELECT * FROM iniciativas WHERE ID = :id AND estado = 'Activa'";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en getById de IniciativaRepository " . $er->getMessage());
            return [];
        }
    }

    public function filterBy($criteria): array
    {
        try {
            $sql = "SELECT * FROM iniciativas WHERE nombre LIKE :nombre AND estado = 'Activa'";

            $stmt = $this->con->prepare($sql);

            $criteria = $criteria . '%';
            $stmt->bindParam(':nombre', $criteria);

            $stmt->execute();

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en filterBy de IniciativaRepository " . $er->getMessage());
            return [];
        }
    }

    public function getIniciativeRolUser($iniciativa_id, $usuario_id): array
    {
        try {
            $sql = "SELECT * FROM usuarios_iniciativas_roles WHERE iniciativa_id = :iniciativa_id AND usuario_id = :usuario_id";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':iniciativa_id', $iniciativa_id);
            $stmt->bindParam(':usuario_id', $usuario_id);

            $stmt->execute();

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOEXception $er) {
            error_log("Error en getIniciativeRolUser de IniciativaRepository " . $er->getMessage());
            return [];
        }
    }

    public function isUserAdmin($iniciativa_id, $usuario_id): bool
    {
        try {
            $sql = "SELECT * FROM usuarios_iniciativas_roles WHERE iniciativa_id = :iniciativa_id AND usuario_id = :usuario_id AND rol_id = 1";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':iniciativa_id', $iniciativa_id);
            $stmt->bindParam(':usuario_id', $usuario_id);

            $stmt->execute();

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return count($res) > 0;
        } catch (PDOEXception $er) {
            error_log("Error en isUserAdmin de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function isUserFollower($iniciativa_id, $usuario_id): bool
    {
        try {
            $sql = "SELECT * FROM usuarios_iniciativas_roles WHERE iniciativa_id = :iniciativa_id AND usuario_id = :usuario_id AND rol_id = 2";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':iniciativa_id', $iniciativa_id);
            $stmt->bindParam(':usuario_id', $usuario_id);

            $stmt->execute();

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return count($res) > 0;
        } catch (PDOEXception $er) {
            error_log("Error en isUserMember de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function isUserMember($iniciativa_id, $usuario_id): bool
    {
        try {
            $sql = "SELECT * FROM usuarios_iniciativas_roles WHERE iniciativa_id = :iniciativa_id AND usuario_id = :usuario_id AND rol_id = 3";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':iniciativa_id', $iniciativa_id);
            $stmt->bindParam(':usuario_id', $usuario_id);

            $stmt->execute();

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return count($res) > 0;
        } catch (PDOEXception $er) {
            error_log("Error en isUserMember de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function assignUserFollower($iniciativa_id, $user_id): bool
    {
        try {
            // Check if both user and initiative exist
            $checkExists = "SELECT u.ID as user_exists, i.ID as initiative_exists 
                       FROM usuarios u, iniciativas i 
                       WHERE u.ID = :user_id AND i.ID = :iniciativa_id";
            $stmt = $this->con->prepare($checkExists);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':iniciativa_id', $iniciativa_id);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                error_log("User ID $user_id or Initiative ID $iniciativa_id does not exist");
                return false;
            }

            $sql = "INSERT INTO usuarios_iniciativas_roles (usuario_id, iniciativa_id, rol_id) 
                VALUES (:usuario_id, :iniciativa_id, 2)";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':usuario_id', $user_id);
            $stmt->bindParam(':iniciativa_id', $iniciativa_id);

            return $stmt->execute();
        } catch (PDOException $er) {
            error_log("Error en assignUserFollower: " . $er->getMessage());
            return false;
        }
    }

    public function assignUserMember($user_id, $iniciativa_id): bool
    {
        try {
            // First check if user exists
            $checkUser = "SELECT ID FROM usuarios WHERE ID = :user_id";
            $stmt = $this->con->prepare($checkUser);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                error_log("User ID $user_id does not exist");
                return false;
            }

            $sql = "INSERT INTO usuarios_iniciativas_roles (usuario_id, iniciativa_id, rol_id) 
                VALUES (:usuario_id, :iniciativa_id, 3)";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':usuario_id', $user_id);
            $stmt->bindParam(':iniciativa_id', $iniciativa_id);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en assignUserMember: " . $e->getMessage());
            return false;
        }
    }


    public function removeUserFollowIniciative($user_id, $iniciativa_id): bool
    {
        try {
            $sql = "DELETE FROM usuarios_iniciativas_roles WHERE usuario_id = :usuario_id AND iniciativa_id = :iniciativa_id AND rol_id = 2";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':usuario_id', $user_id);
            $stmt->bindParam(':iniciativa_id', $iniciativa_id);

            $stmt->execute();

            return true;
        } catch (PDOEXception $er) {
            error_log("Error en removeUserFollowIniciative de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }

    public function removeUserMemberIniciative($user_id, $iniciativa_id): bool
    {
        try {
            $sql = "DELETE FROM usuarios_iniciativas_roles WHERE usuario_id = :usuario_id AND iniciativa_id = :iniciativa_id AND rol_id = 3";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':usuario_id', $user_id);
            $stmt->bindParam(':iniciativa_id', $iniciativa_id);

            $stmt->execute();

            return true;
        } catch (PDOEXception $er) {
            error_log("Error en removeUserMemberIniciative de IniciativaRepository " . $er->getMessage());
            return false;
        }
    }
}
