<?php
abstract class BaseModel {
    protected Database $db;
    protected string $table;

    public function __construct(Database $db, string $table) {
        $this->db = $db;
        $this->table = $table;
    }

    public function count(): int {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $this->db->single()->total;
    }

    public function getById(int $id): object|null {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getPaginated(int $limit, int $offset): array {
        $query = "SELECT * FROM {$this->table} ORDER BY name LIMIT :limit OFFSET :offset";
        $this->db->query($query);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
}
