<?php
/**
 * NEO-SHOGUN Wishlist Protocol
 */
require_once __DIR__ . '/../includes/init.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'IDENTITY_REQUIRED']);
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : (isset($_GET['id']) ? (int)$_GET['id'] : 0);
$action = $_GET['action'] ?? 'toggle';

if ($action == 'toggle') {
    $stmt = $pdo->prepare("SELECT id FROM wishlist WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    $exists = $stmt->fetch();

    if ($exists) {
        $stmt = $pdo->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$user_id, $product_id]);
        $res = ['status' => 'removed', 'message' => 'ARTIFACT_RELEASED: Removed from wishlist.'];
    } else {
        $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $product_id]);
        $res = ['status' => 'added', 'message' => 'ARTIFACT_LINKED: Added to wishlist.'];
    }
    
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        echo json_encode($res);
    } else {
        $_SESSION['success'] = $res['message'];
        redirect('../product.php?id=' . $product_id);
    }
}
?>
