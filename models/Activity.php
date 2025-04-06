<?php
class Activity {
    private $db;
    private $table = 'activities';

    public $id;
    public $name;
    public $description;
    public $benefits;
    public $price;

    public function __construct($database) {
        $this->db = $database;
    }

    // Get total count
    public function countAll() {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $this->db->single()->total;
    }

    // Get paginated activities
    public function getPaginated($limit, $offset) {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY name LIMIT :limit OFFSET :offset';
        $this->db->query($query);
        $this->db->bind(':limit', (int) $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', (int) $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
    

    public function getById($id) {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function count() {
        $query = 'SELECT COUNT(*) as total FROM ' . $this->table;
        $this->db->query($query);
        return $this->db->single()->total;
    }
    
}
?>
