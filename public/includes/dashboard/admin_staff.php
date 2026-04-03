<?php
$edit_admin = null;
if (isset($_GET['edit_id'])) {
    $edit_admin = query("SELECT * FROM Admins WHERE Id = ?", [$_GET['edit_id']])->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_admin'])) {
    $id = $_POST['admin_id'] ?? null;
    $user = trim($_POST['username']);
    $email = trim($_POST['email']);

    if ($id) {
        if (!empty($_POST['password'])) {
            $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            query("UPDATE Admins SET Username=?, Email=?, Password=? WHERE Id=?", [$user, $email, $pass, $id]);
        } else {
            query("UPDATE Admins SET Username=?, Email=? WHERE Id=?", [$user, $email, $id]);
        }
    } else {
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        query("INSERT INTO Admins (Username, Email, Password) VALUES (?, ?, ?)", [$user, $email, $pass]);
    }
    header("Location: index.php?page=admin_staff");
    exit;
}

$admins = query("SELECT * FROM Admins")->fetchAll();
?>

<div class="space-y-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <h2 class="text-lg font-bold mb-4"><?= $edit_admin ? 'Modifier' : 'Ajouter' ?> un Admin</h2>
        <form method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <input type="hidden" name="admin_id" value="<?= $edit_admin['Id'] ?? '' ?>">
            <input type="text" name="username" value="<?= $edit_admin['Username'] ?? '' ?>" placeholder="Nom" class="border p-2 rounded" required>
            <input type="email" name="email" value="<?= $edit_admin['Email'] ?? '' ?>" placeholder="Email" class="border p-2 rounded" required>
            <input type="password" name="password" placeholder="<?= $edit_admin ? 'Laisser vide pour garder' : 'Mot de passe' ?>" class="border p-2 rounded">
            <button type="submit" name="save_admin" class="bg-blue-600 text-white rounded font-bold">Enregistrer</button>
            <?php if($edit_admin): ?><a href="index.php?page=admin_staff" class="text-center p-2 text-gray-500">Annuler</a><?php endif; ?>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <table class="w-full text-left"><tbody class="divide-y">
            <?php foreach($admins as $a): ?>
            <tr>
                <td class="p-4 font-bold"><?= $a['Username'] ?></td>
                <td class="p-4"><?= $a['Email'] ?></td>
                <td class="p-4 text-right">
                    <a href="index.php?page=admin_staff&edit_id=<?= $a['Id'] ?>" class="text-blue-500 mr-4">Modifier</a>
                    <a href="index.php?page=admin_staff&delete_id=<?= $a['Id'] ?>" class="text-red-500">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody></table>
    </div>
</div>