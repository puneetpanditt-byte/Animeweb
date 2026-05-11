<?php
/**
 * NEO-SHOGUN Order Processing Protocol
 */
require_once __DIR__ . '/../includes/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['cart'])) {
    redirect('../shop.php');
}

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "IDENTITY_REQUIRED: Please access your profile before acquisition.";
    redirect('../login.php');
}

$user_id = $_SESSION['user_id'];
$address = cleanInput($_POST['address']);
$phone = cleanInput($_POST['phone']);
$payment_method = cleanInput($_POST['payment_method']);
$cart = $_SESSION['cart'];

$total_amount = 0;
foreach ($cart as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

try {
    $pdo->beginTransaction();
    
    // Create order
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, address, phone, payment_method, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
    $stmt->execute([$user_id, $total_amount, $address, $phone, $payment_method]);
    $order_id = $pdo->lastInsertId();
    
    // Create order items
    $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?)");
    foreach ($cart as $product_id => $item) {
        $stmt->execute([$order_id, $product_id, $item['quantity'], $item['price']]);
        
        // Update stock
        $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ?")->execute([$item['quantity'], $product_id]);
    }
    
    $pdo->commit();
    
    // Clear cart
    $_SESSION['cart'] = [];
    $_SESSION['success'] = "ACQUISITION_AUTHORIZED: Order #$order_id has been initiated.";
    redirect('../profile.php');
    
} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['error'] = "SYSTEM_FAILURE: Acquisition failed. " . $e->getMessage();
    redirect('../checkout.php');
}
?>
