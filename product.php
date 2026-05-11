<?php
require_once 'includes/init.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$stmt = $pdo->prepare("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE p.id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    redirect('shop.php');
}

// Check if in wishlist
$in_wishlist = false;
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT id FROM wishlist WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$_SESSION['user_id'], $id]);
    $in_wishlist = (bool)$stmt->fetch();
}

// Fetch Reviews
$stmt = $pdo->prepare("SELECT r.*, u.username FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = ? AND r.status = 'Approved' ORDER BY r.created_at DESC");
$stmt->execute([$id]);
$reviews = $stmt->fetchAll();

// Calculate Average Rating
$avg_rating = 0;
if (count($reviews) > 0) {
    $total_rating = array_sum(array_column($reviews, 'rating'));
    $avg_rating = round($total_rating / count($reviews), 1);
}

$pageTitle = "NEO-SHOGUN // " . $product['name'];
include 'includes/header.php';

$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);
?>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <?php if ($success): ?>
            <div class="bg-secondary-fixed/10 border border-secondary-fixed text-secondary-fixed p-4 text-xs font-label-mono mb-12 text-center">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="bg-error/10 border border-error text-error p-4 text-xs font-label-mono mb-12 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row gap-16 mb-20">
            <!-- Product Image -->
            <div class="lg:w-1/2">
                <div class="glass-panel p-2 rounded-2xl overflow-hidden relative">
                    <img class="w-full aspect-square object-cover rounded-xl" src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>"/>
                    
                    <a href="actions/wishlist.php?id=<?php echo $product['id']; ?>" class="absolute top-6 right-6 p-3 bg-surface/80 backdrop-blur-md rounded-full border border-primary/30 hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined <?php echo $in_wishlist ? 'text-primary' : 'text-on-surface-variant'; ?>" style="font-variation-settings: 'FILL' <?php echo $in_wishlist ? '1' : '0'; ?>;">favorite</span>
                    </a>
                </div>
            </div>

            <!-- Product Intel -->
            <div class="lg:w-1/2">
                <div class="flex justify-between items-start mb-4">
                    <span class="font-label-mono text-xs text-primary tracking-[0.3em] uppercase block">Archive: #NS-<?php echo str_pad($product['id'], 4, '0', STR_PAD_LEFT); ?></span>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary-fixed text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="font-label-mono text-xs text-secondary-fixed"><?php echo $avg_rating; ?> (<?php echo count($reviews); ?> REPORTS)</span>
                    </div>
                </div>
                <h1 class="font-display-xl text-6xl mb-6 uppercase tracking-tighter"><?php echo $product['name']; ?></h1>
                
                <div class="flex flex-col gap-1 mb-8">
                    <div class="flex items-center gap-4">
                        <span class="text-4xl font-headline-md text-secondary-fixed">₹<?php echo number_format($product['price']); ?></span>
                        <?php if($product['rarity'] != 'Common'): ?>
                        <span class="bg-primary/20 text-primary font-label-mono text-[10px] px-3 py-1 uppercase tracking-widest border border-primary/30"><?php echo $product['rarity']; ?> Artifact</span>
                        <?php endif; ?>
                    </div>
                    <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Inclusive of all taxes</p>
                </div>

                <!-- Indian E-commerce Features -->
                <div class="glass-panel p-4 mb-8 border-l-2 border-secondary-fixed bg-secondary-fixed/5">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="material-symbols-outlined text-secondary-fixed text-sm">local_shipping</span>
                        <p class="font-label-mono text-xs uppercase text-on-surface">FREE delivery by <span class="text-secondary-fixed">Wednesday, May 13</span></p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-sm">payments</span>
                        <p class="font-label-mono text-xs uppercase text-on-surface">Cash on Delivery Available</p>
                    </div>
                </div>

                <div class="mb-8 space-y-2">
                    <p class="font-label-mono text-[10px] text-primary uppercase tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-xs">sell</span> Bank Offer: 10% off on ICICI Bank Credits
                    </p>
                    <p class="font-label-mono text-[10px] text-primary uppercase tracking-widest flex items-center gap-2">
                        <span class="material-symbols-outlined text-xs">verified</span> 7 Days Replacement Policy
                    </p>
                </div>
                
                <p class="text-on-surface-variant text-lg mb-8 leading-relaxed">
                    <?php echo $product['description']; ?>
                </p>

                <div class="space-y-6 mb-12">
                    <div class="flex items-center gap-4 border-l-2 border-primary pl-4">
                        <span class="font-label-mono text-xs uppercase opacity-60">Sync Rate:</span>
                        <span class="font-label-mono text-xs text-primary">99.8% Neural Affinity</span>
                    </div>
                    <div class="flex items-center gap-4 border-l-2 border-secondary-fixed pl-4">
                        <span class="font-label-mono text-xs uppercase opacity-60">Category:</span>
                        <span class="font-label-mono text-xs text-secondary-fixed"><?php echo $product['category_name']; ?></span>
                    </div>
                </div>

                <form action="actions/cart.php?action=add" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <div class="flex flex-col sm:flex-row gap-4 mb-6">
                        <button type="submit" name="buy_now" class="flex-1 py-4 bg-[#FF0033] text-white font-label-mono text-sm uppercase tracking-widest text-center neon-glow-red hover:scale-105 transition-transform">
                            Acquire Artifact
                        </button>
                        <button type="submit" name="add_to_cart" class="flex-1 py-4 border border-secondary-fixed text-secondary-fixed font-label-mono text-sm uppercase tracking-widest hover:bg-secondary-fixed/10 transition-colors">
                            Add to Vault
                        </button>
                    </div>
                </form>
                <p class="font-label-mono text-[10px] text-on-surface-variant uppercase tracking-widest">Sold by <span class="text-primary">NEO-SHOGUN RETAIL (INDIA)</span></p>
            </div>
        </div>

        <!-- Intelligence Reports (Reviews) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div>
                <h2 class="font-display-xl text-3xl mb-8 uppercase tracking-tighter">Intelligence Reports</h2>
                <div class="space-y-6">
                    <?php if(empty($reviews)): ?>
                        <div class="glass-panel p-8 text-center border-dashed border-2 border-surface-variant">
                            <p class="font-label-mono text-xs opacity-50 uppercase">No intelligence reports submitted for this artifact yet.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($reviews as $rev): ?>
                        <div class="glass-panel p-6 border-l-4 border-primary/30">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-4">
                                    <span class="font-label-mono text-xs text-primary uppercase"><?php echo $rev['username']; ?></span>
                                    <div class="flex">
                                        <?php for($i=1; $i<=5; $i++): ?>
                                            <span class="material-symbols-outlined text-[14px] <?php echo $i <= $rev['rating'] ? 'text-secondary-fixed' : 'text-on-surface-variant opacity-20'; ?>" style="font-variation-settings: 'FILL' 1;">star</span>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <span class="font-label-mono text-[10px] opacity-30 uppercase"><?php echo date('d/m/Y', strtotime($rev['created_at'])); ?></span>
                            </div>
                            <p class="text-sm text-on-surface-variant italic">"<?php echo $rev['comment']; ?>"</p>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <h2 class="font-display-xl text-3xl mb-8 uppercase tracking-tighter">Log Intel</h2>
                <div class="glass-panel p-8">
                    <?php if(isset($_SESSION['user_id'])): ?>
                    <form action="actions/reviews.php" method="POST" class="space-y-6">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        
                        <div>
                            <label class="font-label-mono text-[10px] text-primary uppercase block mb-3">Affinity Rating</label>
                            <div class="flex gap-4">
                                <?php for($i=1; $i<=5; $i++): ?>
                                <label class="cursor-pointer group">
                                    <input type="radio" name="rating" value="<?php echo $i; ?>" <?php echo $i==5 ? 'checked' : ''; ?> class="hidden peer">
                                    <div class="w-10 h-10 flex items-center justify-center border border-surface-variant peer-checked:border-secondary-fixed peer-checked:bg-secondary-fixed/10 group-hover:border-secondary-fixed transition-all">
                                        <span class="font-label-mono text-sm"><?php echo $i; ?></span>
                                    </div>
                                </label>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <div>
                            <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">Observations</label>
                            <textarea name="comment" required placeholder="DEPLOYMENT SUCCESSFUL. NEURAL SYNC ACTIVE..." class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary h-32"></textarea>
                        </div>

                        <div class="bg-primary/5 p-4 border border-primary/20 mb-6">
                            <p class="font-label-mono text-[10px] text-primary uppercase tracking-widest flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">redeem</span> Rewards: +50 Credits for verified reports
                            </p>
                        </div>

                        <button type="submit" class="w-full py-4 bg-secondary-fixed text-background font-label-mono text-sm uppercase tracking-widest hover:scale-[1.02] transition-transform">
                            Submit Intelligence
                        </button>
                    </form>
                    <?php else: ?>
                        <div class="text-center py-10">
                            <p class="font-label-mono text-xs opacity-50 uppercase mb-6">Identity verification required to log intel.</p>
                            <a href="login.php" class="px-8 py-3 border border-primary text-primary font-label-mono text-xs uppercase hover:bg-primary hover:text-background transition-all">Verify Identity</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
