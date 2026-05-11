<?php
/**
 * NEO-SHOGUN Vault Protocol (Cart)
 */
require_once __DIR__ . '/../includes/init.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        addToCart();
        break;
    case 'remove':
        removeFromCart();
        break;
    case 'update':
        updateCart();
        break;
    case 'clear':
        $_SESSION['cart'] = [];
        redirect('../shop.php');
        break;
    default:
        redirect('../shop.php');
}

function addToCart() {
    global $pdo;
    
    $product_id = (int)$_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
    // Check if product exists
    $stmt = $pdo->prepare("SELECT id, name, price, image_url FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();
    
    if (!$product) redirect('../shop.php');
    
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image_url'],
            'quantity' => $quantity
        ];
    }
    
    if (isset($_POST['buy_now'])) {
        redirect('../checkout.php');
    } else {
        $_SESSION['success'] = "ARTIFACT_SECURED: Added to vault.";
        redirect('../product.php?id=' . $product_id);
    }
}

function removeFromCart() {
    $product_id = (int)$_GET['id'];
    unset($_SESSION['cart'][$product_id]);
    redirect('../checkout.php');
}

function updateCart() {
    foreach ($_POST['quantity'] as $id => $qty) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['quantity'] = (int)$qty;
        }
    }
    redirect('../checkout.php');
}
?>
