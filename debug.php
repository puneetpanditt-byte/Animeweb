<?php
/**
 * NEO-SHOGUN System Diagnostics
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>System Diagnostic Protocol</h1>";

// 1. Check Config
echo "<h3>1. Configuration Check:</h3>";
if (file_exists('config/db.php')) {
    echo "<p style='color: green;'>[OK] config/db.php found.</p>";
    require_once 'config/db.php';
    echo "<p style='color: green;'>[OK] Database connection successful.</p>";
} else {
    echo "<p style='color: red;'>[ERROR] config/db.php NOT found!</p>";
}

// 2. Check Includes
echo "<h3>2. Core Includes Check:</h3>";
$includes = ['includes/init.php', 'includes/header.php', 'includes/footer.php'];
foreach ($includes as $file) {
    if (file_exists($file)) {
        echo "<p style='color: green;'>[OK] $file found.</p>";
    } else {
        echo "<p style='color: red;'>[ERROR] $file NOT found!</p>";
    }
}

// 3. Check Database Tables
echo "<h3>3. Database Integrity Check:</h3>";
try {
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<p>Detected Tables: " . implode(', ', $tables) . "</p>";
    if (in_array('products', $tables)) {
        echo "<p style='color: green;'>[OK] Artifact archives detected.</p>";
    } else {
        echo "<p style='color: red;'>[ERROR] Table 'products' missing!</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>[ERROR] Could not query tables: " . $e->getMessage() . "</p>";
}

// 4. Server Info
echo "<h3>4. Environment Intel:</h3>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p>Root Path: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";

echo "<br><hr><p>Please share the results shown above to diagnose the issue.</p>";
?>
