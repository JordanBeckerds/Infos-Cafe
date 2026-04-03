<?php
// Fetch counts for the stats cards
$userCount = query("SELECT COUNT(*) FROM Users")->fetchColumn();
$priceCount = query("SELECT COUNT(*) FROM PriceChart")->fetchColumn();
$recentActivity = query("SELECT F.*, U.FirstName, U.LastName 
                         FROM FollowUp F 
                         JOIN Users U ON F.UserId = U.Id 
                         ORDER BY F.OccurredAt DESC LIMIT 5")->fetchAll();
?>

<div class="p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Statistiques Générales</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <p class="text-sm text-gray-500 uppercase font-bold">Utilisateurs Inscrits</p>
            <p class="text-4xl font-extrabold text-blue-600 mt-2"><?= $userCount ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <p class="text-sm text-gray-500 uppercase font-bold">Services Actifs</p>
            <p class="text-4xl font-extrabold text-green-600 mt-2"><?= $priceCount ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <p class="text-sm text-gray-500 uppercase font-bold">Dernière Activité</p>
            <p class="text-lg font-medium text-gray-800 mt-2">Suivi mis à jour</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-gray-700">Activités Récentes (FollowUp)</h3>
            <a href="index.php?page=admin_history" class="text-blue-500 text-sm hover:underline">Voir tout</a>
        </div>
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="p-4">Utilisateur</th>
                    <th class="p-4">Type</th>
                    <th class="p-4">Prix</th>
                    <th class="p-4">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($recentActivity as $row): ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-4"><?= htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']) ?></td>
                    <td class="p-4">
                        <span class="px-2 py-1 bg-gray-100 rounded text-xs"><?= htmlspecialchars($row['Type']) ?></span>
                    </td>
                    <td class="p-4 font-semibold"><?= number_format($row['PriceAtTime'], 2) ?> €</td>
                    <td class="p-4 text-gray-500 text-sm"><?= $row['OccurredAt'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>