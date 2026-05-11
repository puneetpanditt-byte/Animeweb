<?php
/**
 * NEO-SHOGUN Cipher Protocol (Coupons)
 */
require_once __DIR__ . '/../includes/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
    redirect('../checkout.php');
}

$code = cleanInput($_POST['coupon_code']);
$stmt = $pdo->prepare("SELECT * FROM coupons WHERE code = ? AND status = 1 AND expiry_date >= CURDATE()");
$stmt->execute([$code]);
$coupon = $stmt->fetch();

if ($coupon) {
    $_SESSION['applied_coupon'] = [
        'id' => $coupon['id'],
        'code' => $coupon['code'],
        'type' => $coupon['discount_type'],
        'value' => $coupon['discount_value']
    ];
    $_SESSION['success'] = "CIPHER_ACCEPTED: Discount applied to acquisition.";
} else {
    $_SESSION['error'] = "INVALID_CIPHER: Coupon code is expired or invalid.";
}

redirect('../checkout.php');
?>
