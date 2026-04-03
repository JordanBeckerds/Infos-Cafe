<?php
// 1. INITIALIZATION
ob_start(); 
session_start();

// Database Connection
require_once __DIR__ . '/config/db.php';

// --- 2. LOGIN LOGIC (Processed before any HTML output) ---
$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['page']) && $_GET['page'] === 'login') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        // Search in Users Table
        $stmt = query("SELECT * FROM Users WHERE Email = ?", [$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['user_id']    = $user['Id'];
            $_SESSION['user_name']  = $user['FirstName'] . ' ' . $user['LastName'];
            $_SESSION['is_admin']   = false;
            header("Location: index.php?page=home");
            exit;
        } 
        
        // Search in Admins Table
        $stmtAdmin = query("SELECT * FROM Admins WHERE Email = ?", [$email]);
        $admin = $stmtAdmin->fetch();

        if ($admin && password_verify($password, $admin['Password'])) {
            $_SESSION['user_id']    = $admin['Id'];
            $_SESSION['user_name']  = $admin['Username']; 
            $_SESSION['is_admin']   = true;
            header("Location: index.php?page=dashboard");
            exit;
        } else {
            $login_error = "Email ou mot de passe incorrect.";
        }
    } else {
        $login_error = "Veuillez remplir tous les champs.";
    }
}

// --- 3. ROUTING ---

// 1. Get the page from the URL, but don't set a hard default yet
$page = $_GET['page'] ?? null;

// 2. Define our page maps
$public_pages = [
    'home'    => __DIR__ . '/includes/showcase/home.php',
    'lessons' => __DIR__ . '/includes/showcase/lessons.php',
    'repair'  => __DIR__ . '/includes/showcase/repair.php',
    'login'   => __DIR__ . '/includes/showcase/login.php',
    'verify'  => __DIR__ . '/includes/showcase/verify.php', // Verification logic
    '404'     => __DIR__ . '/includes/showcase/404.php',
];

$dashboard_pages = [
    'dashboard'     => __DIR__ . '/includes/dashboard/home.php',
    'admin_users'   => __DIR__ . '/includes/dashboard/admin_users.php',
    'edit_user'     => __DIR__ . '/includes/dashboard/edit_user.php',
    'admin_prices'  => __DIR__ . '/includes/dashboard/admin_prices.php',
    'admin_history' => __DIR__ . '/includes/dashboard/admin_history.php',
    'admin_staff'   => __DIR__ . '/includes/dashboard/admin_staff.php',
];

// --- 4. EXECUTION LOGIC ---

// A. Check if we are in "Dashboard Mode"
// We know we are in dashboard mode if the page starts with 'admin_', 'edit_', or is 'dashboard'
if ($page === 'dashboard' || str_starts_with($page, 'admin_') || str_starts_with($page, 'edit_')) {
    
    if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== true) {
        header('Location: index.php?page=login');
        exit;
    }

    include __DIR__ . '/includes/dashboard/header.php';
    
    // If the specific page doesn't exist in our array, default to 'dashboard'
    $content_file = $dashboard_pages[$page] ?? $dashboard_pages['dashboard'];
    
    include $content_file;
    include __DIR__ . '/includes/dashboard/footer.php';
    exit;
}

// B. Otherwise, we are in "Showcase Mode"
// If no page is specified at all, default to 'home'
$page = $page ?? 'home';

$content_file = $public_pages[$page] ?? $public_pages['404'];

// --- 5. PUBLIC SHOWCASE LAYOUT (Normal Top-to-Bottom) ---
$content_file = $public_pages[$page] ?? $public_pages['home'];
if (!file_exists($content_file)) {
    $content_file = $public_pages['404'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info-Café – Gestion & Services</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased flex flex-col min-h-screen">

    <?php include __DIR__ . '/includes/showcase/header.php'; ?>

    <main id="content" class="flex-grow">
        <?php 
            $error = $login_error; 
            include $content_file; 
        ?>
    </main>

    <?php include __DIR__ . '/includes/showcase/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>

</body>
</html>
<?php 
ob_end_flush(); 
?>