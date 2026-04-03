<?php
$userId = $_GET['id'] ?? null;
if (!$userId) { header("Location: index.php?page=admin_users"); exit; }

// 1. Handle Update Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname   = $_POST['firstname'];
    $lname   = $_POST['lastname'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];
    $zip     = $_POST['postal_code'];
    $ai      = isset($_POST['ai']) ? 1 : 0;
    $maint   = isset($_POST['maint']) ? 1 : 0;
    $verify  = isset($_POST['is_verified']) ? 1 : 0;

    // Check if password was provided to update it
    if (!empty($_POST['new_password'])) {
        $hashedPass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        query("UPDATE Users SET FirstName=?, LastName=?, Email=?, Phone=?, Address=?, PostalCode=?, SubscribedToAI=?, SubscribedToMaintenance=?, is_verified=?, Password=? WHERE Id=?", 
              [$fname, $lname, $email, $phone, $address, $zip, $ai, $maint, $verify, $hashedPass, $userId]);
    } else {
        query("UPDATE Users SET FirstName=?, LastName=?, Email=?, Phone=?, Address=?, PostalCode=?, SubscribedToAI=?, SubscribedToMaintenance=?, is_verified=? WHERE Id=?", 
              [$fname, $lname, $email, $phone, $address, $zip, $ai, $maint, $verify, $userId]);
    }
    
    header("Location: index.php?page=admin_users&updated=1");
    exit;
}

// 2. Fetch current user data
$user = query("SELECT * FROM Users WHERE Id = ?", [$userId])->fetch();
if (!$user) { die("Utilisateur introuvable."); }
?>

<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Modifier le profil client</h2>
        <span class="text-xs text-gray-400 font-mono">ID: #<?= $user['Id'] ?></span>
    </div>
    
    <form method="POST" class="space-y-5">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-600 uppercase">Prénom</label>
                <input type="text" name="firstname" value="<?= htmlspecialchars($user['FirstName']) ?>" class="w-full border p-2 rounded mt-1 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 uppercase">Nom</label>
                <input type="text" name="lastname" value="<?= htmlspecialchars($user['LastName']) ?>" class="w-full border p-2 rounded mt-1 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-600 uppercase">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['Email']) ?>" class="w-full border p-2 rounded mt-1 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 uppercase">Téléphone</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($user['Phone']) ?>" class="w-full border p-2 rounded mt-1 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-600 uppercase">Adresse</label>
                <input type="text" name="address" value="<?= htmlspecialchars($user['Address']) ?>" class="w-full border p-2 rounded mt-1 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 uppercase">Code Postal</label>
                <input type="text" name="postal_code" value="<?= htmlspecialchars($user['PostalCode']) ?>" class="w-full border p-2 rounded mt-1 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
        </div>

        <hr class="border-gray-100">

        <div>
            <label class="block text-sm font-semibold text-gray-600 uppercase">Changer le mot de passe</label>
            <input type="password" name="new_password" placeholder="Laisser vide pour ne pas changer" class="w-full border p-2 rounded mt-1 bg-gray-50 focus:bg-white outline-none">
        </div>

        <div class="bg-gray-50 p-4 rounded-lg grid grid-cols-1 sm:grid-cols-3 gap-4">
            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" name="is_verified" <?= $user['is_verified'] ? 'checked' : '' ?> class="w-5 h-5 text-blue-600 rounded border-gray-300">
                <span class="text-sm font-medium text-gray-700">Compte Vérifié</span>
            </label>
            
            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" name="ai" <?= $user['SubscribedToAI'] ? 'checked' : '' ?> class="w-5 h-5 text-blue-600 rounded border-gray-300">
                <span class="text-sm font-medium text-gray-700">Abonnement AI</span>
            </label>

            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" name="maint" <?= $user['SubscribedToMaintenance'] ? 'checked' : '' ?> class="w-5 h-5 text-blue-600 rounded border-gray-300">
                <span class="text-sm font-medium text-gray-700">Abonnement Maint.</span>
            </label>
        </div>

        <div class="flex justify-between items-center pt-6">
            <a href="index.php?page=admin_users" class="text-gray-500 font-medium hover:text-gray-700 transition">
                &larr; Retour à la liste
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-blue-200 transition transform active:scale-95">
                Mettre à jour le client
            </button>
        </div>
    </form>
</div>