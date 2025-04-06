<?php
/**
 * Trainer Class
 * Handles all trainer-related operations
 */
class Trainer {
    private Database $db;
    private string $table = 'trainers';

    // Trainer properties
    public int|null $id = null;
    public string $name;
    public string $email;
    public string $location;
    public string $certifications;
    public int $years;
    public string $specialization;

    /**
     * Constructor - Initialize database connection
     * @param Database $database
     */
    public function __construct(Database $database) {
        $this->db = $database;
    }

    /**
     * Get all trainers
     * @return array
     */
    public function getAll(): array {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY name");
        return $this->db->resultSet();
    }

    /**
     * Get a trainer by ID
     * @param int $id
     * @return object|null
     */
    public function getById(int $id): object|null {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Create a new trainer
     * @return bool
     */
    public function create(): bool {
        $this->db->query("INSERT INTO {$this->table} 
            (name, email, location, certifications, years, specialization) 
            VALUES 
            (:name, :email, :location, :certifications, :years, :specialization)");

        $this->bindValues();
        return $this->db->execute();
    }

    /**
     * Update trainer data
     * @return bool
     */
    public function update(): bool {
        $this->db->query("UPDATE {$this->table} SET 
            name = :name, 
            email = :email, 
            location = :location, 
            certifications = :certifications, 
            years = :years, 
            specialization = :specialization 
            WHERE id = :id");

        $this->db->bind(':id', $this->id);
        $this->bindValues();
        return $this->db->execute();
    }

    /**
     * Delete a trainer
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Internal: bind shared properties
     */
    private function bindValues(): void {
        $this->db->bind(':name', $this->name);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':location', $this->location);
        $this->db->bind(':certifications', $this->certifications);
        $this->db->bind(':years', $this->years);
        $this->db->bind(':specialization', $this->specialization);
    }

    public function count(): int {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $this->db->single()->total;
    }
    
    public function getPaginated(int $limit, int $offset): array {
        $query = "SELECT * FROM {$this->table} ORDER BY name LIMIT :limit OFFSET :offset";
        $this->db->query($query);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
    
}
?>
