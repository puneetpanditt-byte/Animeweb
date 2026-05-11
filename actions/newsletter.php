<?php
require_once __DIR__ . '/../includes/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = cleanInput($_POST['email']);
    
    // In a real app, you'd save this to a newsletter table
    // For now, we'll just simulate success
    $_SESSION['success'] = "INTELLIGENCE_LINK_ESTABLISHED: You have joined the vanguard.";
    redirect('../index.php');
} else {
    redirect('../index.php');
}
?>
