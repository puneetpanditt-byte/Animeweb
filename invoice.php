<?php
require_once 'includes/init.php';

if (!isset($_SESSION['user_id'])) {
    redirect('login.php');
}

$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user_id = $_SESSION['user_id'];

// Fetch Order
$stmt = $pdo->prepare("SELECT o.*, u.username, u.email FROM orders o JOIN users u ON o.user_id = u.id WHERE o.id = ? AND o.user_id = ?");
$stmt->execute([$order_id, $user_id]);
$order = $stmt->fetch();

if (!$order) {
    die("INTELLIGENCE_ERROR: Order not found or access denied.");
}

// Fetch Order Items
$stmt = $pdo->prepare("SELECT oi.*, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
$stmt->execute([$order_id]);
$items = $stmt->fetchAll();

$pageTitle = "NEO-SHOGUN // INVOICE #" . $order_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Space+Grotesk:wght@700&display=swap" rel="stylesheet"/>
    <style>
        body {
            background: #131314;
            color: #e5e2e3;
            font-family: 'Space Mono', monospace;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ffb3af33;
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
        }
        .neon-border {
            border-left: 4px solid #ffb3af;
        }
        @media print {
            .no-print { display: none; }
            body { background: white; color: black; }
            .invoice-box { border: none; padding: 0; }
        }
    </style>
</head>
<body class="py-12">
    <div class="invoice-box shadow-2xl">
        <div class="flex justify-between items-start mb-12">
            <div>
                <h1 class="text-4xl font-bold text-primary tracking-tighter mb-2" style="font-family: 'Space Grotesk';">NEO-SHOGUN</h1>
                <p class="text-[10px] uppercase opacity-60 tracking-widest">Digital Vanguard Industries // Sector 0</p>
            </div>
            <div class="text-right">
                <h2 class="text-xl uppercase tracking-widest text-secondary-fixed mb-1">Acquisition Intel</h2>
                <p class="text-xs opacity-60">ORDER ID: #<?php echo $order['id']; ?></p>
                <p class="text-xs opacity-60">DATE: <?php echo date('d/m/Y', strtotime($order['created_at'])); ?></p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-12 mb-12">
            <div class="neon-border pl-6">
                <h3 class="text-[10px] uppercase text-primary mb-2 tracking-widest">Warrior Intel</h3>
                <p class="text-sm font-bold uppercase"><?php echo $order['username']; ?></p>
                <p class="text-xs opacity-60"><?php echo $order['email']; ?></p>
                <p class="text-xs opacity-60"><?php echo $order['phone']; ?></p>
            </div>
            <div class="text-right">
                <h3 class="text-[10px] uppercase text-primary mb-2 tracking-widest">Dispatch Sector</h3>
                <p class="text-xs opacity-60 whitespace-pre-line"><?php echo $order['address']; ?></p>
            </div>
        </div>

        <table class="w-full mb-12">
            <thead>
                <tr class="border-b border-primary/30 text-[10px] uppercase text-primary tracking-widest">
                    <th class="py-4 text-left">Artifact</th>
                    <th class="py-4 text-center">Qty</th>
                    <th class="py-4 text-right">Credits</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr class="border-b border-surface-variant/30">
                    <td class="py-4 text-sm uppercase"><?php echo $item['name']; ?></td>
                    <td class="py-4 text-center text-sm"><?php echo $item['quantity']; ?></td>
                    <td class="py-4 text-right text-sm font-bold">₹<?php echo number_format($item['price_at_purchase'] * $item['quantity']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="flex justify-end mb-12">
            <div class="w-64 space-y-3">
                <div class="flex justify-between text-xs uppercase opacity-60">
                    <span>Subtotal</span>
                    <span>₹<?php echo number_format($order['total_amount']); ?></span>
                </div>
                <div class="flex justify-between text-xs uppercase opacity-60">
                    <span>GST (18%)</span>
                    <span>Included</span>
                </div>
                <div class="flex justify-between text-lg uppercase text-primary font-bold border-t border-primary/30 pt-3">
                    <span>Total</span>
                    <span>₹<?php echo number_format($order['total_amount']); ?></span>
                </div>
            </div>
        </div>

        <div class="border-t border-surface-variant/30 pt-8 flex justify-between items-center">
            <div>
                <p class="text-[10px] uppercase opacity-50 mb-1">Payment Method</p>
                <p class="text-xs font-bold text-secondary-fixed uppercase"><?php echo $order['payment_method']; ?></p>
            </div>
            <div class="no-print">
                <button onclick="window.print()" class="px-6 py-2 bg-primary text-background font-bold text-[10px] uppercase tracking-widest hover:scale-105 transition-transform">Print Intel</button>
            </div>
        </div>

        <div class="mt-12 text-center text-[8px] opacity-30 uppercase tracking-[0.4em]">
            This document is an encrypted transmission from Shogun Industries. Verify at shoguncorps.io
        </div>
    </div>
</body>
</html>
