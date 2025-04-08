<?php
require_once 'BaseModel.php';

class Trainer extends BaseModel implements TrainerInterface {
    public int|null $id = null;
    public string $name;
    public string $email;
    public string $location;
    public string $certifications;
    public int $years;
    public string $specialization;

    public function __construct(Database $db) {
        parent::__construct($db, 'trainers');
    }

    public function create(): bool {
        $this->db->query("INSERT INTO {$this->table} 
            (name, email, location, certifications, years, specialization) 
            VALUES 
            (:name, :email, :location, :certifications, :years, :specialization)");

        $this->bindValues();
        return $this->db->execute();
    }

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

    public function delete(int $id): bool {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    private function bindValues(): void {
        $this->db->bind(':name', $this->name);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':location', $this->location);
        $this->db->bind(':certifications', $this->certifications);
        $this->db->bind(':years', $this->years);
        $this->db->bind(':specialization', $this->specialization);
    }
}
