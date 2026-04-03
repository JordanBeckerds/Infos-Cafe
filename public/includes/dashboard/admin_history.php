<?php
// Handle New Entry
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int)$_POST['user_id'];
    $type = $_POST['type'];

    // Get current price snapshot
    $pStmt = query("SELECT Price FROM PriceChart WHERE Type = ?", [$type]);
    $price = $pStmt->fetchColumn();

    query("INSERT INTO FollowUp (UserId, Type, PriceAtTime) VALUES (?, ?, ?)", [$userId, $type, $price]);
    header("Location: index.php?page=admin_history");
    exit;
}

$users = query("SELECT Id, FirstName, LastName FROM Users ORDER BY LastName ASC")->fetchAll();
$services = query("SELECT Type FROM PriceChart WHERE IsActive = 1")->fetchAll();
$history = query("SELECT F.*, U.FirstName, U.LastName 
                  FROM FollowUp F 
                  JOIN Users U ON F.UserId = U.Id 
                  ORDER BY F.OccurredAt DESC")->fetchAll();
?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Suivi des Interventions (Follow-Up)</h1>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-8">
        <h2 class="font-bold text-gray-700 mb-4">Enregistrer une nouvelle action</h2>
        <form method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <select name="user_id" class="border p-2 rounded-lg" required>
                <option value="">Sélectionner l'Utilisateur</option>
                <?php foreach($users as $u): ?>
                    <option value="<?= $u['Id'] ?>"><?= htmlspecialchars($u['FirstName'].' '.$u['LastName']) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="type" class="border p-2 rounded-lg" required>
                <option value="">Type de Service</option>
                <?php foreach($services as $s): ?>
                    <option value="<?= $s['Type'] ?>"><?= htmlspecialchars($s['Type']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="bg-gray-900 text-white font-bold py-2 px-4 rounded-lg hover:bg-black transition">Ajouter au log</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Utilisateur</th>
                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Service</th>
                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Prix (au moment de l'acte)</th>
                    <th class="p-4 text-xs font-bold text-gray-500 uppercase">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($history as $h): ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-medium text-gray-800"><?= htmlspecialchars($h['FirstName'].' '.$h['LastName']) ?></td>
                    <td class="p-4"><span class="bg-gray-100 px-2 py-1 rounded text-sm"><?= htmlspecialchars($h['Type']) ?></span></td>
                    <td class="p-4 font-bold text-blue-600"><?= number_format($h['PriceAtTime'], 2) ?> €</td>
                    <td class="p-4 text-gray-400 text-sm"><?= $h['OccurredAt'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>