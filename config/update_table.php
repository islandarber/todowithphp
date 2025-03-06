<?php

require_once('./db.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Drop the existing tasks table if it exists
    $pdo->exec("DROP TABLE IF EXISTS tasks");

    // Create the tasks table with the correct schema
    $sql = "CREATE TABLE tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        task VARCHAR(255) NOT NULL,
        is_completed BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
    echo "Table 'tasks' created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>