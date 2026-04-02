<?php
// index.php - Single entry point for Info-Café

// Start session early (for future dashboard / authentication)
session_start();

// Load config if needed (database, constants, etc.)
// require_once __DIR__ . '/config/db.php';  // Uncomment when ready

// Get requested page (secure default to 'home')
$page = $_GET['page'] ?? 'home';

// === PUBLIC PAGES (showcase / frontend) ===
$public_pages = [
    'home'          => __DIR__ . '/includes/showcase/home.php',
    'lessons'       => __DIR__ . '/includes/showcase/lessons.php',
    'repair'        => __DIR__ . '/includes/showcase/repair.php',
    'pc-build'      => __DIR__ . '/includes/showcase/pc-build.php',
    'about'         => __DIR__ . '/includes/showcase/about.php',
    'contact'       => __DIR__ . '/includes/showcase/contact.php',
    'booking_repair' => __DIR__ . '/includes/showcase/booking_repair.php',
    'booking_lessons' => __DIR__ . '/includes/showcase/booking_lessons.php',
    // Fallback 404 page
    '404'           => __DIR__ . '/includes/showcase/404.php',
];

// === DASHBOARD / ADMIN PAGES (protected) ===
$dashboard_pages = [
    'login'             => __DIR__ . '/includes/dashboard/login.php',
    'dashboard'         => __DIR__ . '/includes/dashboard/dash.php',
    // Add more later: e.g. 'admin_courses', 'admin_bookings', etc.
];

// === ROUTING LOGIC ===

// 1. Protected dashboard area
if (array_key_exists($page, $dashboard_pages)) {
    $content_file = $dashboard_pages[$page];

    // If already logged in and trying to access login → redirect to dashboard
    if ($page === 'login' && isset($_SESSION['user_id'])) {
        header('Location: /index.php?page=dashboard');
        exit;
    }

    // Protect all dashboard pages except login
    if ($page !== 'login' && !isset($_SESSION['user_id'])) {
        header('Location: /index.php?page=login');
        exit;
    }

    include __DIR__ . '/includes/dashboard/header.php';
    ?>
    <main id="dashboard-content" class="min-h-screen bg-gray-50">
        <?php
        if (file_exists($content_file)) {
            include $content_file;
        } else {
            echo '<div class="p-20 text-center text-3xl font-bold text-red-600">Page not found (404)</div>';
        }
        ?>
    </main>
    <?php
    include __DIR__ . '/includes/dashboard/footer.php';
    exit; // Stop here – don't load public layout
}

// 2. Public showcase site
$content_file = $public_pages[$page] ?? $public_pages['home'];

// Handle 404 gracefully
if (!file_exists($content_file)) {
    $content_file = $public_pages['404'] ?? __DIR__ . '/includes/showcase/404.php';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info-Café – Learn Digital at Your Own Pace</title>

    <!-- Tailwind CSS CDN (current recommended version) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Your custom CSS file if needed -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-gray-50 text-gray-900 antialiased flex flex-col">

    <?php include __DIR__ . '/includes/showcase/header.php'; ?>

    <main id="content">
        <?php include $content_file; ?>
    </main>

    <?php include __DIR__ . '/includes/showcase/footer.php'; ?>

    <!-- Mobile menu toggle script (shared across all showcase pages) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', () => menu.classList.toggle('hidden'));
            }
        });
    </script>

</body>
</html>