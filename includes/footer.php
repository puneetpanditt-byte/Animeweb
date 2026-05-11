<?php
/**
 * NEO-SHOGUN Footer Component
 */
?>
    <!-- Footer -->
    <footer class="bg-surface-container-lowest py-unit-12 border-t border-surface-variant">
        <div class="flex flex-col md:flex-row justify-between items-start px-margin-mobile md:px-margin-desktop gap-unit-8 max-w-max-width mx-auto">
            <div class="max-w-sm">
                <div class="font-headline-md text-primary tracking-widest mb-unit-4">NEO-SHOGUN</div>
                <p class="font-body-md text-body-md text-on-surface-variant mb-unit-4">The ultimate destination for digital warriors and enthusiasts of the cyberpunk anime aesthetic. Hand-crafted artifacts for the next generation.</p>
                <div class="flex gap-unit-4">
                    <a class="text-on-surface-variant hover:text-secondary-fixed transition-all" href="#"><span class="material-symbols-outlined">public</span></a>
                    <a class="text-on-surface-variant hover:text-secondary-fixed transition-all" href="#"><span class="material-symbols-outlined">share</span></a>
                    <a class="text-on-surface-variant hover:text-secondary-fixed transition-all" href="#"><span class="material-symbols-outlined">terminal</span></a>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-unit-12">
                <div class="flex flex-col gap-unit-2">
                    <h6 class="font-label-mono text-label-mono text-primary uppercase mb-unit-2">Sectors</h6>
                    <a class="text-on-surface-variant hover:text-secondary-fixed hover:underline decoration-secondary-fixed font-body-md" href="shop.php">Artifacts</a>
                    <a class="text-on-surface-variant hover:text-secondary-fixed hover:underline decoration-secondary-fixed font-body-md" href="about.php">Mission</a>
                    <a class="text-on-surface-variant hover:text-secondary-fixed hover:underline decoration-secondary-fixed font-body-md" href="profile.php">Vault</a>
                    <a class="text-on-surface-variant hover:text-secondary-fixed hover:underline decoration-secondary-fixed font-body-md" href="contact.php">Comm-Link</a>
                </div>
                <div class="flex flex-col gap-unit-2">
                    <h6 class="font-label-mono text-label-mono text-primary uppercase mb-unit-2">Protocol</h6>
                    <a class="text-on-surface-variant hover:text-secondary-fixed hover:underline decoration-secondary-fixed font-body-md" href="privacy.php">Privacy Protocol</a>
                    <a class="text-on-surface-variant hover:text-secondary-fixed hover:underline decoration-secondary-fixed font-body-md" href="terms.php">Terms of Service</a>
                    <a class="text-on-surface-variant hover:text-secondary-fixed hover:underline decoration-secondary-fixed font-body-md" href="dispatch.php">Dispatch Status</a>
                    <a class="text-on-surface-variant hover:text-secondary-fixed hover:underline decoration-secondary-fixed font-body-md" href="support.php">Neural Support</a>
                </div>
            </div>
        </div>
        <div class="px-margin-mobile md:px-margin-desktop max-w-max-width mx-auto mt-unit-12 pt-unit-8 border-t border-surface-variant/30 text-center md:text-left">
            <p class="font-label-mono text-[10px] text-on-surface-variant opacity-50">© 2024 NEO-SHOGUN INDUSTRIES. ALL RIGHTS RESERVED. // ENCRYPTED CONNECTION SECURED</p>
        </div>
    </footer>

    <!-- BottomNavBar (Mobile Only) -->
    <nav class="fixed bottom-0 w-full z-50 rounded-t-xl bg-surface-container/90 backdrop-blur-lg border-t border-secondary-fixed/20 shadow-[0_-4px_24px_rgba(0,238,252,0.15)] flex justify-around items-center h-unit-12 md:hidden">
        <a href="index.php" class="flex flex-col items-center justify-center text-secondary-fixed drop-shadow-[0_0_5px_rgba(0,219,233,0.8)] active:scale-90 transition-transform duration-150">
            <span class="material-symbols-outlined">home</span>
            <span class="font-label-mono text-[10px] uppercase">Home</span>
        </a>
        <a href="shop.php" class="flex flex-col items-center justify-center text-on-surface-variant opacity-60 hover:text-secondary-fixed transition-opacity active:scale-90 transition-transform duration-150">
            <span class="material-symbols-outlined">grid_view</span>
            <span class="font-label-mono text-[10px] uppercase">Shop</span>
        </a>
        <a href="sale.php" class="flex flex-col items-center justify-center text-[#FF0033] animate-pulse active:scale-90 transition-transform duration-150">
            <span class="material-symbols-outlined">bolt</span>
            <span class="font-label-mono text-[10px] uppercase">Sale</span>
        </a>
        <a href="profile.php" class="flex flex-col items-center justify-center text-on-surface-variant opacity-60 hover:text-secondary-fixed transition-opacity active:scale-90 transition-transform duration-150">
            <span class="material-symbols-outlined">account_circle</span>
            <span class="font-label-mono text-[10px] uppercase">Profile</span>
        </a>
    </nav>

    <script src="script.js"></script>
</body>
</html>
