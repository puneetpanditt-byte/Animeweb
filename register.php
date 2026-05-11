<?php
require_once 'includes/init.php';
$pageTitle = "NEO-SHOGUN // ENLIST";
include 'includes/header.php';

if (isset($_SESSION['user_id'])) {
    redirect('profile.php');
}

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

    <div class="w-full max-w-xl px-6 mx-auto py-20">
        <div class="text-center mb-12">
            <a href="index.php" class="font-display-xl text-5xl font-bold tracking-tighter text-primary mb-2 block">NEO-SHOGUN</a>
            <p class="font-label-mono text-[10px] text-secondary-fixed uppercase tracking-[0.3em]">Enlist in the Digital Vanguard</p>
        </div>

        <div class="glass-panel p-10 border-t-2 border-secondary-fixed">
            <h2 class="font-headline-md text-2xl mb-8 uppercase tracking-widest text-center">Identity Enrollment</h2>
            
            <?php if ($error): ?>
                <div class="bg-error/10 border border-error text-error p-3 text-xs font-label-mono mb-6 text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="actions/auth.php?action=register" method="POST" class="space-y-6">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">First Name</label>
                        <input type="text" name="first_name" placeholder="PUNEET" required class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary transition-colors">
                    </div>
                    <div>
                        <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">Last Name</label>
                        <input type="text" name="last_name" placeholder="KUMAR" required class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary transition-colors">
                    </div>
                </div>

                <div>
                    <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">Email Address (India Hub)</label>
                    <input type="email" name="email" placeholder="PUNEET.K@SHOGUN.IN" required class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary transition-colors">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">Access Key</label>
                        <input type="password" name="password" placeholder="••••••••" required class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary transition-colors">
                    </div>
                    <div>
                        <label class="font-label-mono text-[10px] text-primary uppercase block mb-2">Confirm Key</label>
                        <input type="password" name="confirm_password" placeholder="••••••••" required class="w-full bg-surface-container border-b border-surface-variant text-on-surface p-3 focus:outline-none focus:border-primary transition-colors">
                    </div>
                </div>

                <div class="py-4">
                    <label class="flex items-start gap-3 cursor-pointer group">
                        <input type="checkbox" required class="mt-1 rounded-none border-primary bg-transparent text-primary focus:ring-0">
                        <span class="font-label-mono text-[10px] uppercase opacity-60 group-hover:opacity-100 leading-relaxed">
                            I agree to the <a href="terms.php" class="text-secondary-fixed underline">Terms of Infiltration</a> and <a href="privacy.php" class="text-secondary-fixed underline">Privacy Protocol</a>.
                        </span>
                    </label>
                </div>

                <button type="submit" class="w-full py-4 bg-[#FF0033] text-white font-label-mono text-sm uppercase tracking-widest neon-glow-red hover:scale-[1.02] transition-transform">
                    Initialize Enrollment
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-surface-variant text-center">
                <p class="font-label-mono text-[10px] uppercase opacity-50">Already Verified? <a href="login.php" class="text-primary hover:underline">Access Portal</a></p>
            </div>
        </div>

        <div class="mt-12 flex justify-center gap-8 opacity-30 font-label-mono text-[10px] uppercase tracking-widest">
            <span>Sector 0: India Hub</span>
            <span>Security: Active</span>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>
