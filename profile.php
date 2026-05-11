<?php
require_once 'includes/init.php';

if (!isset($_SESSION['user_id'])) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$pageTitle = "NEO-SHOGUN // IDENTITY";
include 'includes/header.php';

// Mark notifications as read
$pdo->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = ?")->execute([$user_id]);

$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
?>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <?php if ($success): ?>
            <div class="bg-secondary-fixed/10 border border-secondary-fixed text-secondary-fixed p-4 text-xs font-label-mono mb-12 text-center">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Avatar & Stats -->
            <div class="lg:w-1/4">
                <div class="glass-panel p-6 text-center border-b-2 border-primary sticky top-24">
                    <div class="w-32 h-32 mx-auto rounded-full border-2 border-primary p-1 mb-6 overflow-hidden">
                        <img class="w-full h-full object-cover rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAue8oLXcYI5gTxRr-Ez_vMm8Fc275QjbHDHAGxSuEqo22T41AtrbGvVPQSq8R-_CgC4rtFXbN4jXBszVBw-b6-y9c-3gbauwYxtBhIF-TFinWcpcUyCnAZLWtng4leuZ9Df2p_sUw7LQ7whbLDbimcPmsMuIJSVxDCNk0s97aj_4zfDEN4ECuy5T-sk6QVbsDTbHv7LsI4u8otttkP0QXWlvpuHBLTyecZQDHlS0p5D9WMS0YFH-HkQUwrIby47IboP2H12-yQ--H"/>
                    </div>
                    <h2 class="font-headline-md text-xl uppercase tracking-widest mb-2"><?php echo strtoupper($user['username']); ?></h2>
                    <p class="font-label-mono text-[10px] text-secondary-fixed mb-6 uppercase tracking-[0.2em]">Rank: <?php echo $user['rank']; ?></p>
                    
                    <div class="space-y-4 py-6 border-t border-surface-variant text-left">
                        <div>
                            <p class="font-label-mono text-[10px] opacity-50 uppercase">Credits</p>
                            <p class="text-primary font-headline-md">₹<?php echo number_format($user['credits']); ?></p>
                        </div>
                        <div>
                            <p class="font-label-mono text-[10px] opacity-50 uppercase">Reward Points</p>
                            <p class="text-secondary-fixed font-headline-md"><?php echo number_format($user['reward_points']); ?></p>
                        </div>
                        <div>
                            <p class="font-label-mono text-[10px] opacity-50 uppercase">Hub</p>
                            <p class="text-on-surface font-label-mono text-[10px]">INDIA_SECTOR_0</p>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-surface-variant">
                        <a href="actions/auth.php?action=logout" class="block w-full py-2 border border-error/50 text-error font-label-mono text-[10px] uppercase hover:bg-error hover:text-white transition-all">Terminate Session</a>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="lg:w-3/4 space-y-12">
                <!-- Notifications -->
                <section id="notifications">
                    <h2 class="font-display-xl text-3xl mb-8 uppercase tracking-tighter flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary">notifications</span> Comms Channel
                    </h2>
                    <div class="space-y-4">
                        <?php
                        $notifs = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
                        $notifs->execute([$user_id]);
                        $notifs_list = $notifs->fetchAll();
                        
                        if (empty($notifs_list)):
                        ?>
                            <div class="glass-panel p-8 text-center opacity-50 font-label-mono text-xs uppercase">No transmissions received.</div>
                        <?php else: ?>
                            <?php foreach ($notifs_list as $n): ?>
                            <div class="glass-panel p-4 border-l-2 border-primary <?php echo $n['is_read'] ? 'opacity-60' : ''; ?>">
                                <div class="flex justify-between items-center mb-1">
                                    <h4 class="font-label-mono text-xs text-primary uppercase"><?php echo $n['title']; ?></h4>
                                    <span class="text-[10px] opacity-40 uppercase"><?php echo date('d/m H:i', strtotime($n['created_at'])); ?></span>
                                </div>
                                <p class="text-xs text-on-surface-variant"><?php echo $n['message']; ?></p>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- Orders -->
                <section>
                    <h2 class="font-display-xl text-3xl mb-8 uppercase tracking-tighter flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary">archive</span> Acquisition Archives
                    </h2>
                    <div class="space-y-6">
                        <?php
                        $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
                        $stmt->execute([$user_id]);
                        $orders = $stmt->fetchAll();
                        
                        if (empty($orders)):
                        ?>
                            <div class="glass-panel p-12 text-center border-dashed border-2 border-surface-variant">
                                <p class="font-label-mono text-xs opacity-50 uppercase">No acquisition history recorded.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                            <div class="glass-panel p-6 border-l-4 border-secondary-fixed">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="font-label-mono text-xs text-primary uppercase">Order #<?php echo $order['id']; ?></span>
                                    <span class="font-label-mono text-[10px] opacity-50 uppercase"><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></span>
                                </div>
                                <div class="flex justify-between items-end">
                                    <div>
                                        <p class="font-label-mono text-xs uppercase mb-1">Status: <span class="text-secondary-fixed"><?php echo $order['status']; ?></span></p>
                                        <p class="font-label-mono text-[10px] opacity-50 uppercase truncate max-w-xs"><?php echo $order['address']; ?></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-headline-md text-xl">₹<?php echo number_format($order['total_amount']); ?></p>
                                        <a href="invoice.php?id=<?php echo $order['id']; ?>" class="font-label-mono text-[10px] text-secondary-fixed uppercase hover:underline">Download Intel</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- Wishlist -->
                <section>
                    <h2 class="font-display-xl text-3xl mb-8 uppercase tracking-tighter flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary">favorite</span> Linked Artifacts
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php
                        $wish = $pdo->prepare("SELECT w.id as wish_id, p.* FROM wishlist w JOIN products p ON w.product_id = p.id WHERE w.user_id = ?");
                        $wish->execute([$user_id]);
                        $wishlist = $wish->fetchAll();
                        
                        if (empty($wishlist)):
                        ?>
                            <div class="col-span-full glass-panel p-12 text-center border-dashed border-2 border-surface-variant">
                                <p class="font-label-mono text-xs opacity-50 uppercase">No artifacts linked to your profile.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($wishlist as $item): ?>
                            <div class="glass-panel p-4 flex gap-4">
                                <img src="<?php echo $item['image_url']; ?>" class="w-20 h-20 object-cover border border-primary/30">
                                <div class="flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-label-mono text-xs uppercase mb-1"><?php echo $item['name']; ?></h4>
                                        <p class="text-secondary-fixed font-bold text-xs">₹<?php echo number_format($item['price']); ?></p>
                                    </div>
                                    <div class="flex gap-4">
                                        <a href="product.php?id=<?php echo $item['id']; ?>" class="text-[10px] uppercase text-primary hover:underline">View</a>
                                        <a href="actions/wishlist.php?id=<?php echo $item['id']; ?>" class="text-[10px] uppercase text-error hover:underline">Unlink</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
