<?php
/**
 * NEO-SHOGUN Authentication Protocol
 */
require_once __DIR__ . '/../includes/init.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'register':
        handleRegistration();
        break;
    case 'login':
        handleLogin();
        break;
    case 'logout':
        handleLogout();
        break;
    default:
        redirect('../login.php');
}

function handleRegistration() {
    global $pdo;
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !verifyCSRF($_POST['csrf_token'])) {
        $_SESSION['error'] = "SECURITY_BREACH: Invalid CSRF Token.";
        redirect('../register.php');
    }
    
    $first_name = cleanInput($_POST['first_name']);
    $last_name = cleanInput($_POST['last_name']);
    $email = cleanInput($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "ACCESS_KEY_MISMATCH: Passwords do not match.";
        redirect('../register.php');
    }
    
    if (strlen($password) < 8) {
        $_SESSION['error'] = "SECURITY_BREACH: Password must be at least 8 characters.";
        redirect('../register.php');
    }
    
    // Check if email exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = "IDENTITY_CONFLICT: Email already registered.";
        redirect('../register.php');
    }
    
    // Create user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $username = strtolower($first_name . $last_name . rand(100, 999));
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);
        
        $_SESSION['success'] = "IDENTITY_ESTABLISHED: You may now access the portal.";
        redirect('../login.php');
    } catch (PDOException $e) {
        $_SESSION['error'] = "SYSTEM_ERROR: Identity enrollment failed.";
        redirect('../register.php');
    }
}

function handleLogin() {
    global $pdo;
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !verifyCSRF($_POST['csrf_token'])) {
        $_SESSION['error'] = "SECURITY_BREACH: Invalid CSRF Token.";
        redirect('../login.php');
    }
    
    $email = cleanInput($_POST['email']);
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        // Login success
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = (bool)$user['is_admin']; // Assuming is_admin exists
        
        redirect('../profile.php');
    } else {
        $_SESSION['error'] = "VERIFICATION_FAILED: Invalid credentials.";
        redirect('../login.php');
    }
}

function handleLogout() {
    session_destroy();
    redirect('../login.php');
}
?>
