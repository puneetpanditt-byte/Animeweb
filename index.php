<?php
require_once 'includes/init.php';
$pageTitle = "NEO-SHOGUN // HOME";
include 'includes/header.php';
?>

    <div class="loading-screen" id="loader">
        <div class="progress-text">Loading Experience... <span id="percent">0%</span></div>
        <div class="loader">
            <div class="loader-bar" id="bar"></div>
        </div>
    </div>

    <canvas id="hero-canvas"></canvas>

    <div id="scroll-container">
        <section class="section">
            <div class="glass-card">
                <h1>The Journey</h1>
                <p>Scroll down to experience the cinematic movement of high-quality anime frames.</p>
            </div>
        </section>

        <section class="section">
            <div class="glass-card">
                <h1>Fluid Motion</h1>
                <p>Every frame is carefully synchronized with your scroll velocity for a seamless experience.</p>
            </div>
        </section>

        <section class="section">
            <div class="glass-card">
                <h1>Visual Mastery</h1>
                <p>Art meets technology in this interactive sequence.</p>
            </div>
        </section>

        <section class="section">
            <div class="glass-card">
                <h1>Begin Again</h1>
                <p>The loop continues. Thank you for watching.</p>
            </div>
        </section>
    </div>

    <div class="scroll-indicator" id="indicator">
        <div class="mouse"></div>
        <span style="font-size: 0.7rem; opacity: 0.5;">SCROLL</span>
    </div>

    <main>
        <!-- Flash Sale Countdown -->
        <section class="py-unit-8 bg-surface-container-lowest">
            <div class="px-margin-mobile md:px-margin-desktop max-w-max-width mx-auto">
                <div class="glass-panel p-unit-8 border-l-4 border-l-primary flex flex-col md:flex-row items-center justify-between gap-unit-8">
                    <div class="flex items-center gap-unit-4">
                        <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings: 'FILL' 1;">timer</span>
                        <div>
                            <h2 class="font-headline-md text-headline-md leading-tight">FLASH PROTOCOL</h2>
                            <p class="font-label-mono text-label-mono text-primary-fixed-dim">SYSTEM PURGE ENDS IN:</p>
                        </div>
                    </div>
                    <div class="flex gap-unit-4 font-display-xl text-display-xl text-primary">
                        <div class="flex flex-col items-center">
                            <span class="leading-none">04</span>
                            <span class="text-xs font-label-mono uppercase tracking-tighter text-on-surface-variant">HRS</span>
                        </div>
                        <span class="animate-pulse">:</span>
                        <div class="flex flex-col items-center">
                            <span class="leading-none">22</span>
                            <span class="text-xs font-label-mono uppercase tracking-tighter text-on-surface-variant">MIN</span>
                        </div>
                        <span class="animate-pulse">:</span>
                        <div class="flex flex-col items-center">
                            <span class="leading-none">59</span>
                            <span class="text-xs font-label-mono uppercase tracking-tighter text-on-surface-variant">SEC</span>
                        </div>
                    </div>
                    <button class="px-unit-8 py-unit-4 bg-surface-variant text-primary font-label-mono text-label-mono border border-primary/50 hover:bg-primary hover:text-on-primary transition-all duration-300">
                        ACCESS SALE
                    </button>
                </div>
            </div>
        </section>

        <!-- Categories Slider -->
        <section class="py-unit-12">
            <div class="px-margin-mobile md:px-margin-desktop max-w-max-width mx-auto">
                <div class="flex justify-between items-end mb-unit-8">
                    <h3 class="font-headline-lg text-headline-lg">CATEGORIES</h3>
                    <div class="flex gap-unit-2">
                        <button class="p-unit-2 border border-surface-variant hover:border-primary text-on-surface-variant hover:text-primary transition-all">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <button class="p-unit-2 border border-surface-variant hover:border-primary text-on-surface-variant hover:text-primary transition-all">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                    <?php
                    $categories = $pdo->query("SELECT * FROM categories LIMIT 3")->fetchAll();
                    foreach ($categories as $cat):
                        $img = "";
                        if($cat['slug'] == 'apparel') $img = "https://lh3.googleusercontent.com/aida-public/AB6AXuBUWaVE_15m7ecrd0GCeD3Kn9O8kBLPYvZbGHzahuGzHBnr1ZNfLgvzHqk7QVodxJXOUbfZ6RSoGi19qa0Nb0o2qq6idFv_EgRoUVMX-Bfxwc8WgtIPNokGMagc-Io-cWjWNJAeF6CKpCUmWZkAyaIAjtdlBXiIKGaZ6k8mhR5bzWWtcEbovSlryt13FbOynloQvxLNc-cLDE_gVFLui45r0NSGkZgGwmx8L8_sbb2SCR5BGhn7nvbNIIIfgzhpBaqWhR9usf1rJ88x";
                        if($cat['slug'] == 'figures') $img = "https://lh3.googleusercontent.com/aida-public/AB6AXuCfql8gBZ9X7OXMTf5tleuz6tVvDQFrwp7aIU5l0WQ7XUWp0nYV4_klM_0YC4_Y8st8Td838pPY_NOMBrs5WWc_Vxq5mGcRJbXszSttzYIAgQQXTBKpFfzdOVAIVSsKPcBuqkB_SrFqUpergTndmL9ZMOdPj7uBAWs9m6DWDX6TspyGhvNwGJqFVVZWdtbqJyVhJhu0juzOkNQltAVzEVHLcPumuN9WtT6OIr2_7dwBBcPwzRhM5qgSFNPKIFICEmKgRuViHxbrCm-f";
                        if($cat['slug'] == 'accessories') $img = "https://lh3.googleusercontent.com/aida-public/AB6AXuANus_S8NoAKGMXKOgusTDAgpgilJxkGdQEqgNs3LJSE8Mt7jrwhvBv6qaNwIq1wGZy_KA814Uv6SsL2t_Q9LmpIBGhWkrwqaxOjP5h3EHT9X58EFiYuq041E90xDou7otrdNxPJiiPmC2CY-3XLGKKR7iNzLg9XNh1cXR1dOmQy0gFFjYpwxY5PSv5wZF5ILRJR3257xDqOEm_jD1G0h_Tv3nYxV4Ilbx3iwaveiL27ITIoY5j3fzNsoIXqdiOiMlTWEWx5oFhF6PV";
                    ?>
                    <a href="<?php echo $cat['slug']; ?>.php" class="relative h-96 group overflow-hidden cursor-pointer block">
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="<?php echo $img; ?>" alt="<?php echo $cat['name']; ?>"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-background to-transparent opacity-80"></div>
                        <div class="absolute bottom-0 left-0 p-unit-8">
                            <p class="font-label-mono text-label-mono text-secondary-fixed mb-unit-1">GEAR UP</p>
                            <h4 class="font-headline-md text-headline-md"><?php echo strtoupper($cat['name']); ?></h4>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Trending Artifacts -->
        <section class="py-unit-12 bg-surface-container">
            <div class="px-margin-mobile md:px-margin-desktop max-w-max-width mx-auto">
                <div class="flex items-center gap-unit-4 mb-unit-12">
                    <div class="h-px flex-1 bg-surface-variant"></div>
                    <h2 class="font-headline-lg text-headline-lg tracking-tight">TRENDING ARTIFACTS</h2>
                    <div class="h-px flex-1 bg-surface-variant"></div>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-gutter">
                    <?php
                    $products = $pdo->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 4")->fetchAll();
                    foreach ($products as $product):
                    ?>
                    <div class="glass-panel group relative overflow-hidden transition-all duration-300 hover:-translate-y-2">
                        <?php if($product['rarity'] != 'Common'): ?>
                        <div class="absolute top-unit-2 left-unit-2 z-10">
                            <span class="bg-primary text-on-primary font-label-mono text-[10px] px-unit-2 py-unit-1 uppercase font-bold"><?php echo $product['rarity']; ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="h-64 overflow-hidden bg-black/20">
                            <img class="w-full h-full object-contain p-unit-8 transition-transform duration-500 group-hover:scale-110" src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>"/>
                        </div>
                        <div class="p-unit-4 border-t border-primary/20">
                            <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">SHOGUN INDUSTRIES</p>
                            <h5 class="font-headline-md text-lg truncate mb-unit-2"><?php echo $product['name']; ?></h5>
                            <div class="flex flex-col gap-1 mb-unit-2">
                                <div class="flex justify-between items-center">
                                    <span class="font-headline-md text-primary text-xl">₹<?php echo number_format($product['price']); ?></span>
                                    <button class="p-unit-2 bg-primary/10 border border-primary/30 text-primary hover:bg-primary hover:text-on-primary transition-all">
                                        <span class="material-symbols-outlined">add_shopping_cart</span>
                                    </button>
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[12px] text-secondary-fixed">local_shipping</span>
                                    <span class="font-label-mono text-[9px] text-secondary-fixed uppercase">FREE Delivery</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Newsletter -->
        <section class="py-unit-12 border-y border-surface-variant">
            <div class="px-margin-mobile md:px-margin-desktop max-w-3xl mx-auto text-center">
                <h3 class="font-headline-lg text-headline-lg mb-unit-4">JOIN THE VANGUARD</h3>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-unit-8">Receive critical intel on new drops, secret artifacts, and regional mission briefings.</p>
                <form action="actions/newsletter.php" method="POST" class="flex flex-col md:flex-row gap-unit-4">
                    <input class="flex-1 bg-surface-container border-b-2 border-secondary-fixed text-on-surface px-unit-4 py-unit-2 focus:ring-0 focus:outline-none focus:border-primary transition-all font-label-mono" placeholder="NEURAL_EMAIL@PROTO.COL" type="email" name="email" required/>
                    <button type="submit" class="px-unit-12 py-unit-2 bg-[#FF0033] text-white font-label-mono text-label-mono uppercase tracking-widest neon-glow-red hover:scale-105 transition-all">
                        INITIATE
                    </button>
                </form>
            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>
