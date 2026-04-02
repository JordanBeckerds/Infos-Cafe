<?php
// login.php – Page de connexion sécurisée

require_once __DIR__ . '/db.php';

session_start();

// Messages d'erreur/succès
$error   = '';
$success = '';

// Traitement du formulaire POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        // Recherche de l'utilisateur
        $stmt = query("SELECT * FROM Users WHERE Email = ?", [$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['Password'])) {
            // Connexion réussie
            $_SESSION['user_id']    = $user['Id'];
            $_SESSION['user_email'] = $user['Email'];
            $_SESSION['user_name']  = $user['FirstName'] . ' ' . $user['LastName'];

            // Redirection après login (change selon ton besoin)
            header("Location: index.php?page=home");
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion – Info-Café</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white p-8 rounded-2xl shadow-xl max-w-md w-full">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
      Connexion à votre compte
    </h1>

    <?php if ($error): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-6">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" name="password" id="password" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
      </div>

      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg transition shadow-md">
        Se connecter
      </button>
    </form>

    <p class="mt-6 text-center text-gray-600 text-sm">
      Pas encore de compte ? 
      <a href="pay.php" class="text-blue-600 hover:underline font-medium">
        Créer un compte (paiement requis)
      </a>
    </p>
  </div>
</body>
</html>