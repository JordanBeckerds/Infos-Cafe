<?php
// Handle Edit/Update
$edit_price = null;
if (isset($_GET['edit_id'])) {
    $edit_price = query("SELECT * FROM PriceChart WHERE Id = ?", [$_GET['edit_id']])->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_price'])) {
    $id = $_POST['price_id'] ?? null;
    $type = trim($_POST['type']);
    $price = $_POST['price'];

    if ($id) {
        query("UPDATE PriceChart SET Type=?, Price=? WHERE Id=?", [$type, $price, $id]);
    } else {
        query("INSERT INTO PriceChart (Type, Price) VALUES (?, ?)", [$type, $price]);
    }
    header("Location: index.php?page=admin_prices");
    exit;
}

$prices = query("SELECT * FROM PriceChart")->fetchAll();
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 h-fit">
        <h2 class="font-bold mb-4"><?= $edit_price ? 'Modifier' : 'Ajouter' ?> un Tarif</h2>
        <form method="POST" class="space-y-4">
            <input type="hidden" name="price_id" value="<?= $edit_price['Id'] ?? '' ?>">
            <input type="text" name="type" value="<?= $edit_price['Type'] ?? '' ?>" placeholder="Nom du service" class="w-full border p-2 rounded">
            <input type="number" step="0.01" name="price" value="<?= $edit_price['Price'] ?? '' ?>" placeholder="Prix €" class="w-full border p-2 rounded">
            <button type="submit" name="save_price" class="w-full bg-blue-600 text-white py-2 rounded font-bold">Enregistrer</button>
            <?php if($edit_price): ?><a href="index.php?page=admin_prices" class="block text-center text-sm text-gray-500 mt-2">Annuler</a><?php endif; ?>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50"><tr><th class="p-4">Service</th><th class="p-4">Prix</th><th class="p-4">Action</th></tr></thead>
            <tbody class="divide-y">
                <?php foreach($prices as $p): ?>
                <tr>
                    <td class="p-4 font-mono text-sm"><?= $p['Type'] ?></td>
                    <td class="p-4 font-bold"><?= number_format($p['Price'], 2) ?> €</td>
                    <td class="p-4"><a href="index.php?page=admin_prices&edit_id=<?= $p['Id'] ?>" class="text-blue-500">Modifier</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>