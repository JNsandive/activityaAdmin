<?php

require_once __DIR__ . '/../utils/Logger.php';

/**
 * BaseModel
 * Shared model functionality with Activity and Trainer list views
 */
abstract class BaseModel {
    protected Database $db;
    protected string $table;

    public function __construct(Database $db, string $table) {
        $this->db = $db;
        $this->table = $table;
    }

    /**
     * Count total records in the table
     */
    public function count(): int {
        try {
            $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
            return $this->db->single()->total;
        } catch (Throwable $e) {
            Logger::error("BaseModel::count", $e->getMessage());
            return 0;
        }
    }

    /**
     * Fetch a single row by ID
     */
    public function getById(int $id): object|null {
        try {
            $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
            $this->db->bind(':id', $id);
            return $this->db->single();
        } catch (Throwable $e) {
            Logger::error("BaseModel::getById", $e->getMessage());
            return null;
        }
    }

    /**
     * Fetch paginated rows
     */
    public function getPaginated(int $limit, int $offset): array {
        try {
            $query = "SELECT * FROM {$this->table} ORDER BY name LIMIT :limit OFFSET :offset";
            $this->db->query($query);
            $this->db->bind(':limit', $limit, PDO::PARAM_INT);
            $this->db->bind(':offset', $offset, PDO::PARAM_INT);
            return $this->db->resultSet();
        } catch (Throwable $e) {
            Logger::error("BaseModel::getPaginated", $e->getMessage());
            return [];
        }
    }
}
