<?php
// Load environment variables
require_once('../vendor/autoload.php');
Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$port = $_ENV['DB_PORT'] ;
try {
    // Create a new PDO instance with the port
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
