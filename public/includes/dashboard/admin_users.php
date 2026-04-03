<?php
require_once 'config/mailer.php';

// Handle Create User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) {
    $email = trim($_POST['email']);
    $token = bin2hex(random_bytes(32));
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    query("INSERT INTO Users (FirstName, LastName, Email, Password, Phone, PostalCode, Address, Token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", 
          [$_POST['fname'], $_POST['lname'], $email, $pass, $_POST['phone'], $_POST['zip'], $_POST['address'], $token]);
    
    sendVerificationEmail($email, $token);
    header("Location: index.php?page=admin_users&msg=created");
    exit;
}

$users = query("SELECT * FROM Users ORDER BY CreatedAt DESC")->fetchAll();
?>

<div class="space-y-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <h2 class="text-lg font-bold mb-4">Créer un Nouvel Utilisateur (Envoyer Mail de Validation)</h2>
        <form method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" name="fname" placeholder="Prénom" class="border p-2 rounded" required>
            <input type="text" name="lname" placeholder="Nom" class="border p-2 rounded" required>
            <input type="email" name="email" placeholder="Email" class="border p-2 rounded" required>
            <input type="password" name="password" placeholder="Mot de passe" class="border p-2 rounded" required>
            <input type="text" name="phone" placeholder="Téléphone" class="border p-2 rounded">
            <input type="text" name="zip" placeholder="Code Postal" class="border p-2 rounded">
            <input type="text" name="address" placeholder="Adresse" class="border p-2 rounded col-span-1 md:col-span-2">
            <button type="submit" name="create_user" class="bg-blue-600 text-white rounded font-bold hover:bg-blue-700">Créer & Valider</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b text-xs uppercase text-gray-500 font-bold">
                <tr>
                    <th class="p-4">Client</th>
                    <th class="p-4">Statut</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <?php foreach($users as $u): ?>
                <tr>
                    <td class="p-4">
                        <div class="font-bold"><?= $u['FirstName'] ?> <?= $u['LastName'] ?></div>
                        <div class="text-sm text-gray-500"><?= $u['Email'] ?></div>
                    </td>
                    <td class="p-4">
                        <span class="px-2 py-1 rounded-full text-xs font-bold <?= $u['is_verified'] ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?>">
                            <?= $u['is_verified'] ? 'Vérifié' : 'En attente' ?>
                        </span>
                    </td>
                    <td class="p-4 text-right">
                        <a href="index.php?page=edit_user&id=<?= $u['Id'] ?>" class="text-blue-600 mr-3">Modifier</a>
                        <a href="index.php?page=admin_users&delete_id=<?= $u['Id'] ?>" class="text-red-500">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>