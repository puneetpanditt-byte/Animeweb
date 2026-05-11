<?php
/**
 * NEO-SHOGUN Initialization Protocol
 */

// Secure session start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// CSRF Protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function verifyCSRF($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Database Connection
require_once __DIR__ . '/../config/db.php';

// SEO & Meta Defaults
$pageTitle = "NEO-SHOGUN // DIGITAL VANGUARD";

// Helper functions (could be moved to functions.php)
function redirect($url) {
    header("Location: $url");
    exit();
}

function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check for admin
function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

function notify($user_id, $title, $message) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, title, message) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $title, $message]);
}
?>
