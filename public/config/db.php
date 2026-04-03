<?php
// db.php – Database connection configuration

$host    = 'localhost';
$db      = 'infocafe';
$user    = 'root';
$pass    = ''; // Laragon default is empty
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Create the PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // In production, you'd want to log this instead of echoing it
    die("Database connection failed: " . $e->getMessage());
}

/**
 * Helper function to run prepared statements
 * matches the usage in your login.php
 */
function query($sql, $params = []) {
    global $pdo;
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (\PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}