<?php
/**
 * NEO-SHOGUN Database Protocol
 * Enhanced for Vercel & Multi-Environment Support
 */

// Use Environment Variables (Recommended for Vercel/Production)
// If not set, it falls back to local or legacy hosting values
$host = getenv('DB_HOST') ?: null;
$db   = getenv('DB_NAME') ?: null;
$user = getenv('DB_USER') ?: null;
$pass = getenv('DB_PASS') ?: null;

// Fallback logic for Local XAMPP or Legacy Hosting
if (!$host) {
    $is_local = ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1' || $_SERVER['SERVER_NAME'] == 'localhost');
    
    if ($is_local) {
        $host = 'localhost';
        $db   = 'neo_shogun';
        $user = 'root';
        $pass = '';
    } else {
        // Live Hosting Settings (InfinityFree) - Recommended to use DB_PASS Env Var
        $host = 'sql112.infinityfree.com';
        $db   = 'if0_41767756_NEOSHOGUN';
        $user = 'if0_41767756';
        $pass = ''; // REMOVED FOR SECURITY: Set this in DB_PASS environment variable
    }
}

$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // In production, don't leak connection details
     error_log($e->getMessage());
     die("NEURAL_SYNC_FAILED: Database connection could not be established.");
}
?>
