<?php
require_once 'includes/init.php';
$pageTitle = "NEO-SHOGUN // VERIFY";
include 'includes/header.php';

if (isset($_SESSION['user_id'])) {
    redirect('profile.php');
}

$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['error'], $_SESSION['success']);
?>

    <div class="w-full max-w-md px-6 mx-auto py-20">
        <div class="text-center mb-12">
            <a href="index.php" class="font-display-xl text-5xl font-bold tracking-tighter text-primary mb-2 block">NEO-SHOGUN</a>
            <p class="font-label-mono text-[10px] text-secondary-fixed uppercase tracking-[0.3em]">Neural Link Requesting Access</p>
        </div>

        <div class="glass-panel p-8 border-t-2 border-primary">
            <div class="flex gap-4 mb-8 border-b border-surface-variant pb-4">
                <button class="font-label-mono text-sm uppercase text-primary border-b-2 border-primary pb-2">Initialize</button>
                <a href="register.php" class="font-label-mono text-sm uppercase opacity-50 hover:opacity-100 transition-opacity pb-2">Register</a>
            </div>

            <?php if ($error): ?>
                <div class="bg-error/10 border border-error text-error p-3 text-xs font-label-mono mb-6 text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="bg-secondary-fixed/10 border border-secondary-fixed text-secondary-fixed p-3 text-xs font-label-mono mb-6 text-center">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form action="actions/auth.php?action=login" method="POST" class="space-y-6">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div>
                    <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">Email Address (India Hub)</label>
                    <input type="email" name="email" placeholder="PUNEET.K@SHOGUN.IN" required class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">Access Key</label>
                    <input type="password" name="password" placeholder="••••••••" required class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary">
                </div>
                
                <div class="flex justify-between items-center py-2">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="rounded-none border-primary bg-transparent text-primary focus:ring-0">
                        <span class="font-label-mono text-[10px] uppercase opacity-60 group-hover:opacity-100">Keep Sync Active</span>
                    </label>
                    <a href="forgot-password.php" class="font-label-mono text-[10px] uppercase text-secondary-fixed hover:underline">Forgot Key?</a>
                </div>

                <button type="submit" class="w-full py-4 bg-[#FF0033] text-white font-label-mono text-sm uppercase tracking-widest neon-glow-red hover:scale-[1.02] transition-transform">
                    Establish Connection
                </button>
            </form>
        </div>

        <p class="text-center mt-12 font-label-mono text-[10px] opacity-30 uppercase tracking-widest">Authorized Warriors Only // Sector 0 Restricted</p>
    </div>

<?php include 'includes/footer.php'; ?>
