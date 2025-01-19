<?php
//DAO: Data Access Object
require_once 'core/DB.php';
require_once 'models/repository/IRepository.php';

class TagsRepository implements IRepository
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getAll(): array
    {
        try {
            $query = "SELECT * FROM tags";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getAll de TagsRepository " . $e->getMessage());
            return [];
        }
    }

    public function getById($id): bool
    {
        try {

            $query = "SELECT * FROM tags WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getById de TagsRepository " . $e->getMessage());
            return false;
        }
    }

    public function create($data): bool
    {
        try {

            $query = "INSERT INTO tags (name) VALUES (:name)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $data->getNombre, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en create de TagsRepository " . $e->getMessage());
            return false;
        }
    }

    public function update($data): bool
    {
        $query = "UPDATE tags SET name = :name WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id): bool
    {
        $query = "DELETE FROM tags WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function add($data): bool
    {
        return $this->create($data);
    }

    public function filterBy($criteria): array
    {
        try {
            $query = "SELECT * FROM tags WHERE name LIKE :criteria";
            $stmt = $this->db->prepare($query);
            $criteria = "%$criteria%";
            $stmt->bindParam(':criteria', $criteria, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en filterBy de TagsRepository " . $e->getMessage());
            return [];
        }
    }
}
