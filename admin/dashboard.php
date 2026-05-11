<?php
require_once '../includes/init.php';

if (!isAdmin()) {
    redirect('../login.php');
}

$pageTitle = "ADMIN PROTOCOL // DASHBOARD";

// Stats
$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_orders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$total_revenue = $pdo->query("SELECT SUM(total_amount) FROM orders")->fetchColumn() ?? 0;
$total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();

include '../includes/header.php'; // I might need a specific admin header later
?>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex items-center gap-4 mb-12">
            <span class="material-symbols-outlined text-primary text-4xl">dashboard</span>
            <h1 class="font-display-xl text-4xl uppercase tracking-tighter">Command Center</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="glass-panel p-6 border-l-4 border-primary">
                <p class="font-label-mono text-[10px] text-on-surface-variant uppercase mb-2">Total Warriors</p>
                <h3 class="font-headline-md text-3xl"><?php echo number_format($total_users); ?></h3>
            </div>
            <div class="glass-panel p-6 border-l-4 border-secondary-fixed">
                <p class="font-label-mono text-[10px] text-on-surface-variant uppercase mb-2">Total Acquisitions</p>
                <h3 class="font-headline-md text-3xl"><?php echo number_format($total_orders); ?></h3>
            </div>
            <div class="glass-panel p-6 border-l-4 border-primary">
                <p class="font-label-mono text-[10px] text-on-surface-variant uppercase mb-2">Total Revenue</p>
                <h3 class="font-headline-md text-3xl">₹<?php echo number_format($total_revenue); ?></h3>
            </div>
            <div class="glass-panel p-6 border-l-4 border-secondary-fixed">
                <p class="font-label-mono text-[10px] text-on-surface-variant uppercase mb-2">Active Artifacts</p>
                <h3 class="font-headline-md text-3xl"><?php echo number_format($total_products); ?></h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Recent Orders -->
            <div class="glass-panel p-8">
                <h2 class="font-headline-md text-xl mb-6 uppercase tracking-widest border-b border-surface-variant pb-4">Recent Transmissions</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left font-label-mono text-xs">
                        <thead>
                            <tr class="text-primary border-b border-surface-variant">
                                <th class="py-4">ID</th>
                                <th class="py-4">Warrior</th>
                                <th class="py-4">Credits</th>
                                <th class="py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = $pdo->query("SELECT o.*, u.username FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC LIMIT 5")->fetchAll();
                            foreach ($orders as $order):
                            ?>
                            <tr class="border-b border-surface-variant/30 hover:bg-surface-variant/10 transition-colors">
                                <td class="py-4">#<?php echo $order['id']; ?></td>
                                <td class="py-4"><?php echo $order['username']; ?></td>
                                <td class="py-4">₹<?php echo number_format($order['total_amount']); ?></td>
                                <td class="py-4">
                                    <span class="px-2 py-1 bg-secondary-fixed/10 text-secondary-fixed border border-secondary-fixed/30"><?php echo $order['status']; ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="glass-panel p-8">
                <h2 class="font-headline-md text-xl mb-6 uppercase tracking-widest border-b border-surface-variant pb-4">Command Actions</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="products.php" class="p-4 border border-surface-variant hover:border-primary transition-all group flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">inventory_2</span>
                        <span class="font-label-mono text-xs uppercase">Manage Artifacts</span>
                    </a>
                    <a href="orders.php" class="p-4 border border-surface-variant hover:border-primary transition-all group flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary-fixed group-hover:scale-110 transition-transform">shopping_cart</span>
                        <span class="font-label-mono text-xs uppercase">Manage Orders</span>
                    </a>
                    <a href="users.php" class="p-4 border border-surface-variant hover:border-primary transition-all group flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">group</span>
                        <span class="font-label-mono text-xs uppercase">Manage Warriors</span>
                    </a>
                    <a href="reports.php" class="p-4 border border-surface-variant hover:border-primary transition-all group flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary-fixed group-hover:scale-110 transition-transform">analytics</span>
                        <span class="font-label-mono text-xs uppercase">View Intelligence</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

<?php include '../includes/footer.php'; ?>
