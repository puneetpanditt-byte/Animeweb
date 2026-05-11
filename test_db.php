<?php
require_once 'config/db.php';

try {
    $stmt = $pdo->query("SELECT 1");
    echo "<h1 style='color: green;'>NEURAL_LINK_ACTIVE: Database connection successful!</h1>";
    
    // Check tables
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<h3>Detected Archives (Tables):</h3><ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<h1 style='color: red;'>NEURAL_LINK_SEVERED: Database connection failed!</h1>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<p>Check if you have imported the SQL file in PHPMyAdmin and if your password is correct in config/db.php.</p>";
}
?>
