<?php
require_once 'includes/init.php';
$pageTitle = "NEO-SHOGUN // ARTIFACTS";
include 'includes/header.php';

// Filters
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : null;
$search_query = isset($_GET['search']) ? cleanInput($_GET['search']) : '';

$sql = "SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE 1=1";
$params = [];

if ($category_filter) {
    $sql .= " AND p.category_id = ?";
    $params[] = $category_filter;
}

if ($search_query) {
    $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)";
    $params[] = "%$search_query%";
    $params[] = "%$search_query%";
}

$sql .= " ORDER BY p.created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Filters -->
            <aside class="w-full md:w-64 flex-shrink-0">
                <div class="glass-panel p-6 rounded-xl sticky top-24">
                    <h2 class="font-headline-md text-lg text-primary mb-6 flex items-center gap-2 uppercase tracking-widest">
                        <span class="material-symbols-outlined">filter_list</span> Intelligence
                    </h2>
                    
                    <form action="shop.php" method="GET" class="space-y-8">
                        <div>
                            <label class="font-label-mono text-[10px] text-on-surface-variant uppercase mb-3 block">Search Archives</label>
                            <input type="text" name="search" value="<?php echo $search_query; ?>" placeholder="KATANA..." class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-2 focus:outline-none focus:border-primary text-xs font-label-mono">
                        </div>

                        <div>
                            <label class="font-label-mono text-[10px] text-on-surface-variant uppercase mb-3 block">Sectors</label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="category" value="" <?php echo !$category_filter ? 'checked' : ''; ?> class="hidden peer">
                                    <span class="font-label-mono text-xs peer-checked:text-primary transition-colors uppercase">All Sectors</span>
                                </label>
                                <?php foreach ($categories as $cat): ?>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="category" value="<?php echo $cat['id']; ?>" <?php echo $category_filter == $cat['id'] ? 'checked' : ''; ?> class="hidden peer">
                                    <span class="font-label-mono text-xs peer-checked:text-primary transition-colors uppercase group-hover:text-primary"><?php echo $cat['name']; ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3 bg-surface-variant text-primary font-label-mono text-[10px] uppercase tracking-widest border border-primary/50 hover:bg-primary hover:text-on-primary transition-all">
                            Apply Filters
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Product Grid -->
            <section class="flex-grow">
                <div class="flex justify-between items-center mb-8">
                    <p class="font-label-mono text-[10px] uppercase opacity-50"><?php echo count($products); ?> Artifacts Detected</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php if (empty($products)): ?>
                        <div class="col-span-full py-20 text-center glass-panel">
                            <p class="font-label-mono text-xs uppercase opacity-50">No artifacts found in this sector.</p>
                        </div>
                    <?php endif; ?>

                    <?php foreach ($products as $product): ?>
                    <div class="glass-panel rounded-xl overflow-hidden group hover:border-primary transition-all duration-500">
                        <div class="relative aspect-[4/5] overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>"/>
                            <?php if($product['rarity'] != 'Common'): ?>
                                <div class="absolute top-4 right-4 bg-primary/20 backdrop-blur-md text-primary font-label-mono text-[10px] px-2 py-1 uppercase font-bold border border-primary/30"><?php echo $product['rarity']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-headline-md text-lg uppercase tracking-tight group-hover:text-primary transition-colors"><?php echo $product['name']; ?></h3>
                                <span class="font-label-mono text-secondary-fixed text-sm">₹<?php echo number_format($product['price']); ?></span>
                            </div>
                            <p class="text-xs text-on-surface-variant line-clamp-2 mb-2"><?php echo $product['description']; ?></p>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-[14px] text-secondary-fixed">local_shipping</span>
                                <span class="font-label-mono text-[10px] text-secondary-fixed uppercase">FREE Delivery</span>
                            </div>
                            <a href="product.php?id=<?php echo $product['id']; ?>" class="w-full py-3 border border-primary text-primary font-label-mono text-xs uppercase hover:bg-primary hover:text-background transition-all block text-center">View Artifact</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
