<?php
/**
 * NEO-SHOGUN Intelligence Report (Reviews)
 */
require_once __DIR__ . '/../includes/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
    redirect('../shop.php');
}

if (!verifyCSRF($_POST['csrf_token'])) {
    $_SESSION['error'] = "SECURITY_BREACH: Invalid CSRF Token.";
    redirect($_SERVER['HTTP_REFERER']);
}

$user_id = $_SESSION['user_id'];
$product_id = (int)$_POST['product_id'];
$rating = (int)$_POST['rating'];
$comment = cleanInput($_POST['comment']);

// Check if user already reviewed this product
$stmt = $pdo->prepare("SELECT id FROM reviews WHERE user_id = ? AND product_id = ?");
$stmt->execute([$user_id, $product_id]);
if ($stmt->fetch()) {
    $_SESSION['error'] = "REPORT_EXISTS: You have already submitted intel on this artifact.";
    redirect('../product.php?id=' . $product_id);
}

try {
    $stmt = $pdo->prepare("INSERT INTO reviews (user_id, product_id, rating, comment, status) VALUES (?, ?, ?, ?, 'Approved')");
    $stmt->execute([$user_id, $product_id, $rating, $comment]);
    
    // Add reward points for review
    $stmt = $pdo->prepare("UPDATE users SET reward_points = reward_points + 50 WHERE id = ?");
    $stmt->execute([$user_id]);
    
    $_SESSION['success'] = "INTELLIGENCE_LOGGED: Your report has been added. +50 Reward Points.";
    redirect('../product.php?id=' . $product_id);
} catch (PDOException) {
    $_SESSION['error'] = "SYSTEM_ERROR: Could not log intel.";
    redirect('../product.php?id=' . $product_id);
}
?>
