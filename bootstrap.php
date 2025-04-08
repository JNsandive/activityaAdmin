<?php
require_once 'config/db.php';
require_once 'utils/Logger.php';

try {
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `" . DB_NAME . "`");

    $sqlFilePath = __DIR__ . '/database.sql';

    if (file_exists($sqlFilePath)) {
        $sql = file_get_contents($sqlFilePath);

        // Always run CREATE TABLE statements
        preg_match_all('/CREATE TABLE IF NOT EXISTS.*?;/si', $sql, $createStatements);
        foreach ($createStatements[0] as $statement) {
            $pdo->exec($statement);
        }

        // Check if data already exists before inserting
        $stmt = $pdo->query("SELECT COUNT(*) FROM activities");
        $activityCount = $stmt->fetchColumn();

        if ($activityCount == 0) {
            // Run INSERT INTO statements
            preg_match_all('/INSERT INTO .*?;/si', $sql, $insertStatements);
            foreach ($insertStatements[0] as $insert) {
                $pdo->exec($insert);
            }
        }

    } else {
        echo "database.sql not found.";
    }

} catch (PDOException $e) {
    Logger::error('BootstrapError', $e->getMessage());

    echo "Database bootstrap error: " . $e->getMessage();
    exit;
}
?>
