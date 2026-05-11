<?php
/**
 * NEO-SHOGUN Header Component
 */
if (!isset($pageTitle)) {
    $pageTitle = "NEO-SHOGUN // DIGITAL VANGUARD";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-variant": "#353436",
                    "inverse-surface": "#e5e2e3",
                    "on-tertiary-container": "#480064",
                    "on-tertiary-fixed-variant": "#74009f",
                    "error-container": "#93000a",
                    "primary-container": "#ff5357",
                    "on-surface-variant": "#e9bcb9",
                    "inverse-primary": "#bf0024",
                    "surface-container-low": "#1c1b1c",
                    "surface-bright": "#3a393a",
                    "on-primary": "#68000e",
                    "tertiary-fixed-dim": "#ebb2ff",
                    "tertiary": "#ebb2ff",
                    "on-background": "#e5e2e3",
                    "surface-container-high": "#2a2a2b",
                    "primary": "#ffb3af",
                    "surface": "#131314",
                    "on-secondary-fixed": "#002022",
                    "secondary-fixed-dim": "#00dbe9",
                    "primary-fixed-dim": "#ffb3af",
                    "surface-container": "#201f20",
                    "on-error-container": "#ffdad6",
                    "outline-variant": "#5f3e3d",
                    "on-tertiary": "#520071",
                    "error": "#ffb4ab",
                    "on-primary-fixed": "#410006",
                    "on-surface": "#e5e2e3",
                    "surface-tint": "#ffb3af",
                    "on-secondary-container": "#00686f",
                    "secondary-fixed": "#7df4ff",
                    "background": "#131314",
                    "outline": "#b08784",
                    "on-secondary-fixed-variant": "#004f54",
                    "secondary": "#d3fbff",
                    "inverse-on-surface": "#313031",
                    "tertiary-fixed": "#f8d8ff",
                    "surface-container-highest": "#353436",
                    "on-error": "#690005",
                    "primary-fixed": "#ffdad8",
                    "on-primary-fixed-variant": "#930019",
                    "on-secondary": "#00363a",
                    "surface-container-lowest": "#0e0e0f",
                    "secondary-container": "#00eefc",
                    "on-tertiary-fixed": "#320047"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "unit-4": "16px",
                    "unit-12": "48px",
                    "margin-mobile": "16px",
                    "margin-desktop": "64px",
                    "gutter": "24px",
                    "unit-8": "32px",
                    "unit-1": "4px",
                    "base": "4px",
                    "max-width": "1440px",
                    "unit-2": "8px"
            },
            "fontFamily": {
                    "label-mono": ["Space Mono"],
                    "body-md": ["Inter"],
                    "headline-md": ["Space Grotesk"],
                    "body-lg": ["Inter"],
                    "headline-lg": ["Space Grotesk"],
                    "headline-lg-mobile": ["Space Grotesk"],
                    "display-xl": ["Space Grotesk"]
            },
            "fontSize": {
                    "label-mono": ["12px", {"lineHeight": "1.0", "letterSpacing": "0.1em", "fontWeight": "500"}],
                    "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "headline-md": ["32px", {"lineHeight": "1.3", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "headline-lg": ["48px", {"lineHeight": "1.2", "fontWeight": "700"}],
                    "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                    "display-xl": ["72px", {"lineHeight": "1.1", "letterSpacing": "-0.04em", "fontWeight": "700"}]
            }
          },
        },
      }
    </script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="font-body-md text-on-surface">
    <div class="particles-bg"></div>

    <!-- Navbar Protocol -->
    <nav class="fixed top-0 w-full z-[100] bg-surface/10 backdrop-blur-sm border-b border-primary/10 hover:bg-surface/80 hover:backdrop-blur-xl hover:border-primary/30 transition-all duration-500 py-4 px-margin-mobile md:px-margin-desktop">
        <div class="max-w-max-width mx-auto flex justify-between items-center">
            <a href="index.php" class="font-headline-md text-2xl font-bold tracking-tighter text-primary drop-shadow-[0_0_10px_rgba(255,179,175,0.5)]">NEO-SHOGUN</a>
            
            <div class="hidden md:flex items-center gap-unit-8">
                <a href="index.php" class="font-label-mono text-xs text-primary border-b-2 border-primary pb-1">HOME</a>
                <a href="shop.php" class="font-label-mono text-xs text-on-surface-variant hover:text-primary transition-colors">ARTIFACTS</a>
                <a href="sale.php" class="font-label-mono text-xs text-[#FF0033] hover:text-primary transition-colors animate-pulse">FLASH SALE</a>
                <a href="about.php" class="font-label-mono text-xs text-on-surface-variant hover:text-primary transition-colors">MISSION</a>
                <a href="support.php" class="font-label-mono text-xs text-on-surface-variant hover:text-primary transition-colors">SUPPORT</a>
            </div>

            <div class="flex items-center gap-unit-4">
                <?php if(isset($_SESSION['user_id'])): 
                    $unread = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0");
                    $unread->execute([$_SESSION['user_id']]);
                    $count = $unread->fetchColumn();
                ?>
                <a href="profile.php#notifications" class="relative material-symbols-outlined text-on-surface-variant p-2 hover:bg-primary/10 rounded-full transition-all">
                    notifications
                    <?php if($count > 0): ?>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                    <?php endif; ?>
                </a>
                <?php endif; ?>
                <a href="shop.php" class="material-symbols-outlined text-primary p-2 hover:bg-primary/10 rounded-full transition-all">shopping_bag</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="px-unit-4 py-2 border border-primary text-primary font-label-mono text-[10px] uppercase tracking-widest hover:bg-primary hover:text-background transition-all">IDENTITY</a>
                <?php else: ?>
                    <a href="login.php" class="px-unit-4 py-2 bg-primary text-background font-label-mono text-[10px] uppercase tracking-widest hover:scale-105 transition-transform">ACCESS</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
