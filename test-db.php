<?php
require_once 'config/db.php';

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "🧪 DB Connection Successful!";
} catch (PDOException $e) {
    echo "❌ DB Connection Failed: " . $e->getMessage();
}
?>
