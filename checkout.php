<?php
require_once 'includes/init.php';
$pageTitle = "NEO-SHOGUN // ACQUISITION";
include 'includes/header.php';

$cart = $_SESSION['cart'] ?? [];
$subtotal = 0;
foreach ($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

// Discount Calculation
$discount = 0;
$coupon = $_SESSION['applied_coupon'] ?? null;
if ($coupon) {
    if ($coupon['type'] == 'Percentage') {
        $discount = ($subtotal * $coupon['value']) / 100;
    } else {
        $discount = $coupon['value'];
    }
}

$total = $subtotal - $discount;

$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <h1 class="font-display-xl text-5xl mb-12 uppercase tracking-tighter">Final Acquisition</h1>

        <?php if ($success): ?>
            <div class="bg-secondary-fixed/10 border border-secondary-fixed text-secondary-fixed p-4 text-xs font-label-mono mb-8 text-center">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="bg-error/10 border border-error text-error p-4 text-xs font-label-mono mb-8 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($cart)): ?>
            <div class="glass-panel p-20 text-center">
                <span class="material-symbols-outlined text-primary text-6xl mb-6">shopping_basket</span>
                <h2 class="font-headline-md text-2xl mb-4 uppercase tracking-widest">Vault is Empty</h2>
                <p class="font-label-mono text-xs opacity-50 mb-8 uppercase">No artifacts detected in current session.</p>
                <a href="shop.php" class="px-8 py-3 bg-primary text-background font-label-mono text-xs uppercase tracking-widest hover:scale-105 transition-transform inline-block">Browse Artifacts</a>
            </div>
        <?php else: ?>
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Acquisition Details -->
                <div class="lg:w-2/3 space-y-8">
                    <!-- Delivery Protocol -->
                    <div class="glass-panel p-8 border-l-4 border-primary">
                        <h2 class="font-headline-md text-xl mb-6 uppercase tracking-widest flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">local_shipping</span> Delivery Protocol
                        </h2>
                        <form id="checkout-form" action="actions/order.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <div class="md:col-span-2">
                                <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">Delivery Address / Sector</label>
                                <textarea name="address" required placeholder="NEW_DELHI_SECTOR_45, BLOCK-C, UNIT-889" class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary h-24"></textarea>
                            </div>
                            <div>
                                <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">Contact Link (Mobile)</label>
                                <input type="tel" name="phone" required placeholder="+91 XXXXX XXXXX" class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary">
                            </div>
                            <div>
                                <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">Email Protocol (India)</label>
                                <input type="email" name="email" required placeholder="PUNEET.K@SHOGUN.IN" class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary">
                            </div>
                        </form>
                    </div>

                    <!-- Payment Protocol -->
                    <div class="glass-panel p-8 border-l-4 border-secondary-fixed">
                        <h2 class="font-headline-md text-xl mb-6 uppercase tracking-widest flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary-fixed">payments</span> Payment Protocol
                        </h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="cursor-pointer group">
                                <input type="radio" name="payment_method" form="checkout-form" value="UPI" checked class="hidden peer">
                                <div class="p-4 border border-surface-variant text-center peer-checked:border-secondary-fixed peer-checked:bg-secondary-fixed/5 group-hover:border-secondary-fixed transition-all">
                                    <p class="font-label-mono text-[10px] uppercase">UPI / GPAY</p>
                                </div>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="payment_method" form="checkout-form" value="CARD" class="hidden peer">
                                <div class="p-4 border border-surface-variant text-center peer-checked:border-secondary-fixed peer-checked:bg-secondary-fixed/5 group-hover:border-secondary-fixed transition-all">
                                    <p class="font-label-mono text-[10px] uppercase">CREDIT/DEBIT</p>
                                </div>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="payment_method" form="checkout-form" value="NETBANKING" class="hidden peer">
                                <div class="p-4 border border-surface-variant text-center peer-checked:border-secondary-fixed peer-checked:bg-secondary-fixed/5 group-hover:border-secondary-fixed transition-all">
                                    <p class="font-label-mono text-[10px] uppercase">NET BANKING</p>
                                </div>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="payment_method" form="checkout-form" value="COD" class="hidden peer">
                                <div class="p-4 border border-surface-variant text-center peer-checked:border-secondary-fixed peer-checked:bg-secondary-fixed/5 group-hover:border-secondary-fixed transition-all">
                                    <p class="font-label-mono text-[10px] uppercase">CASH (COD)</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Vault Summary -->
                <div class="lg:w-1/3">
                    <div class="glass-panel p-8 sticky top-24">
                        <h2 class="font-headline-md text-xl mb-6 uppercase tracking-widest border-b border-surface-variant pb-4">Vault Summary</h2>
                        <div class="space-y-4 mb-8">
                            <?php foreach ($cart as $id => $item): ?>
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-label-mono text-xs uppercase"><?php echo $item['name']; ?></p>
                                    <p class="font-label-mono text-[10px] opacity-50 uppercase">QTY: <?php echo $item['quantity']; ?></p>
                                </div>
                                <span class="font-label-mono text-xs text-primary">₹<?php echo number_format($item['price'] * $item['quantity']); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Coupon System -->
                        <div class="mb-8">
                            <form action="actions/coupon.php" method="POST" class="flex gap-2">
                                <input type="text" name="coupon_code" placeholder="ENTER CIPHER..." class="flex-1 bg-surface-container border-b border-surface-variant text-on-surface p-2 text-[10px] font-label-mono focus:outline-none focus:border-secondary-fixed">
                                <button type="submit" class="px-4 py-2 border border-secondary-fixed text-secondary-fixed font-label-mono text-[10px] uppercase hover:bg-secondary-fixed/10">Apply</button>
                            </form>
                            <?php if ($coupon): ?>
                                <p class="text-[10px] text-secondary-fixed mt-2 uppercase font-label-mono">Applied: <?php echo $coupon['code']; ?> (-₹<?php echo number_format($discount); ?>)</p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="border-t border-surface-variant pt-4 space-y-2 mb-8">
                            <div class="flex justify-between font-label-mono text-[10px] uppercase opacity-50">
                                <span>Subtotal</span>
                                <span>₹<?php echo number_format($subtotal); ?></span>
                            </div>
                            <?php if ($discount > 0): ?>
                            <div class="flex justify-between font-label-mono text-[10px] uppercase text-secondary-fixed">
                                <span>Cipher Discount</span>
                                <span>-₹<?php echo number_format($discount); ?></span>
                            </div>
                            <?php endif; ?>
                            <div class="flex justify-between font-label-mono text-[10px] uppercase opacity-50">
                                <span>Taxes (GST 18%)</span>
                                <span>Included</span>
                            </div>
                            <div class="flex justify-between font-headline-md text-lg uppercase text-primary pt-2">
                                <span>Final Credits</span>
                                <span>₹<?php echo number_format($total); ?></span>
                            </div>
                        </div>

                        <button type="submit" form="checkout-form" class="w-full py-4 bg-[#FF0033] text-white font-label-mono text-sm uppercase tracking-widest neon-glow-red hover:scale-105 transition-transform">
                            Authorize Acquisition
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

<?php include 'includes/footer.php'; ?>
