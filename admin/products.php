<?php
require_once '../includes/init.php';

if (!isAdmin()) {
    redirect('../login.php');
}

$pageTitle = "ADMIN PROTOCOL // ARTIFACTS";
include '../includes/header.php';

// Handle Deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);
    $_SESSION['success'] = "ARTIFACT_DELETED: ID #$id removed from archives.";
    redirect('products.php');
}

$products = $pdo->query("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC")->fetchAll();
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
?>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex justify-between items-center mb-12">
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-primary text-4xl">inventory_2</span>
                <h1 class="font-display-xl text-4xl uppercase tracking-tighter">Artifact Archives</h1>
            </div>
            <a href="add-product.php" class="px-6 py-3 bg-secondary-fixed text-background font-label-mono text-xs uppercase tracking-widest hover:scale-105 transition-transform">Initialize New Artifact</a>
        </div>

        <?php if ($success): ?>
            <div class="bg-secondary-fixed/10 border border-secondary-fixed text-secondary-fixed p-4 text-xs font-label-mono mb-12 text-center">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <div class="glass-panel overflow-hidden">
            <table class="w-full text-left font-label-mono text-xs">
                <thead>
                    <tr class="text-primary border-b border-surface-variant bg-surface-variant/20">
                        <th class="p-6">ID</th>
                        <th class="p-6">Intel</th>
                        <th class="p-6">Sector</th>
                        <th class="p-6">Credits</th>
                        <th class="p-6">Stock</th>
                        <th class="p-6">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $p): ?>
                    <tr class="border-b border-surface-variant/30 hover:bg-surface-variant/10 transition-colors">
                        <td class="p-6">#<?php echo $p['id']; ?></td>
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <img src="<?php echo $p['image_url']; ?>" class="w-12 h-12 object-cover border border-primary/30">
                                <div>
                                    <p class="font-bold"><?php echo $p['name']; ?></p>
                                    <p class="opacity-50 text-[10px]"><?php echo $p['rarity']; ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="p-6"><?php echo $p['category_name']; ?></td>
                        <td class="p-6">₹<?php echo number_format($p['price']); ?></td>
                        <td class="p-6"><?php echo $p['stock']; ?></td>
                        <td class="p-6">
                            <div class="flex gap-4">
                                <a href="edit-product.php?id=<?php echo $p['id']; ?>" class="text-secondary-fixed hover:underline">RECODE</a>
                                <a href="products.php?delete=<?php echo $p['id']; ?>" onclick="return confirm('Confirm Purge?')" class="text-error hover:underline">PURGE</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

<?php include '../includes/footer.php'; ?>
