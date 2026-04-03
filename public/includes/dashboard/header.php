<?php
// 1. Determine the current page for highlighting
$current_page = $_GET['page'] ?? 'dashboard';

/**
 * Helper function to apply active classes to the sidebar links
 * @param string $pageName The page key defined in index.php
 * @param string $current_page The current active page from GET
 */
function isActive($pageName, $current_page) {
    if ($pageName === $current_page) {
        return 'bg-gray-800 text-blue-400 border-blue-500';
    }
    return 'text-gray-400 border-transparent hover:bg-gray-800 hover:text-white hover:border-blue-400';
}

// 2. Clean up the title for the top bar display
$display_title = str_replace(['admin_', 'edit_', 'dashboard'], ['', 'Modification ', 'Accueil'], $current_page);
$display_title = ucfirst($display_title);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel – Info-Café</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Smooth transition for mobile sidebar slide */
        #sidebar { transition: transform 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen relative overflow-x-hidden">
    
    <aside id="sidebar" class="w-64 bg-gray-900 text-white flex-shrink-0 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 md:relative md:block z-50 shadow-xl">
        <div class="p-6 text-2xl font-bold border-b border-gray-800 flex justify-between items-center">
            <span>Admin <span class="text-blue-400">Café</span></span>
            <button onclick="toggleSidebar()" class="md:hidden text-gray-400 hover:text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <nav class="mt-6">
            <div class="px-6 text-xs uppercase text-gray-500 font-bold mb-2">Principal</div>
            
            <a href="index.php?page=dashboard" 
               class="block py-3 px-6 transition border-l-4 <?= isActive('dashboard', $current_page) ?>">
               Tableau de bord
            </a>
            
            <a href="index.php?page=admin_users" 
               class="block py-3 px-6 transition border-l-4 <?= isActive('admin_users', $current_page) ?>">
               Clients / Utilisateurs
            </a>
            
            <a href="index.php?page=admin_prices" 
               class="block py-3 px-6 transition border-l-4 <?= isActive('admin_prices', $current_page) ?>">
               Grille Tarifaire
            </a>
            
            <a href="index.php?page=admin_history" 
               class="block py-3 px-6 transition border-l-4 <?= isActive('admin_history', $current_page) ?>">
               Historique & Logs
            </a>

            <div class="mt-10 px-6 text-xs uppercase text-gray-500 font-bold mb-2">Gestion Interne</div>
            
            <a href="index.php?page=admin_staff" 
               class="block py-3 px-6 transition border-l-4 <?= isActive('admin_staff', $current_page) ?>">
               Équipe Admin
            </a>
            
            <div class="mt-10 px-6 text-xs uppercase text-gray-500 font-bold mb-2">Session</div>
            
            <a href="logout.php" class="block py-3 px-6 text-red-400 hover:bg-gray-800 transition border-l-4 border-transparent">
                Déconnexion
            </a>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">
        
        <header class="bg-white shadow-sm h-16 flex items-center justify-between px-4 md:px-8 flex-shrink-0 z-40">
            <div class="flex items-center">
                <button onclick="toggleSidebar()" class="md:hidden mr-4 text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight">
                    <?= $display_title ?>
                </h2>
            </div>

            <div class="flex items-center space-x-3">
                <div class="hidden sm:flex flex-col text-right mr-2">
                    <span class="text-sm font-bold text-gray-900"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?></span>
                    <span class="text-xs text-blue-600 font-medium">Administrateur</span>
                </div>
                <a href="index.php?page=home" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-semibold transition">
                    Voir le site
                </a>
            </div>
        </header>

        <main class="p-4 md:p-8 flex-grow">