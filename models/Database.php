<?php
// Load DB credentials
require_once __DIR__ . '/../config/db.php';

/**
 * Database Class
 * Handles PDO database connection and operations
 */
class Database {
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    private string $dbname = DB_NAME;
    private string $port = DB_PORT ?? '3307';

    private PDO|null $conn = null;
    private PDOStatement|null $stmt = null;
    private string $error = '';

    /**
     * Constructor - establish PDO connection
     */
    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            die("❌ DB Connection Error: {$this->error}");
        }
    }

    /**
     * Prepares a SQL statement
     */
    public function query(string $query): void {
        if ($this->conn) {
            $this->stmt = $this->conn->prepare($query);
        } else {
            die("❌ Cannot prepare query. No DB connection.");
        }
    }

    /**
     * Binds parameters with optional PDO type detection
     */
    public function bind(string $param, mixed $value, ?int $type = null): void {
        if (is_null($type)) {
            $type = match (true) {
                is_int($value)  => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default         => PDO::PARAM_STR,
            };
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Executes the prepared SQL statement
     */
    public function execute(): bool {
        return $this->stmt->execute();
    }

    /**
     * Fetches multiple records
     */
    public function resultSet(): array {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Fetches a single record
     */
    public function single(): object|false {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Returns affected row count
     */
    public function rowCount(): int {
        return $this->stmt->rowCount();
    }

    /**
     * Returns last inserted ID
     */
    public function lastInsertId(): string {
        return $this->conn->lastInsertId();
    }

    /**
     * Checks if connection is active
     */
    public function isConnected(): bool {
        return $this->conn !== null;
    }
}
?>
