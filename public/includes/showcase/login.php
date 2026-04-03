<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        // 1. Tenter de trouver l'utilisateur dans la table `Users`
        $stmt = query("SELECT * FROM Users WHERE Email = ?", [$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['user_id']    = $user['Id'];
            $_SESSION['user_email'] = $user['Email'];
            $_SESSION['user_name']  = $user['FirstName'] . ' ' . $user['LastName'];
            $_SESSION['is_admin']   = false;

            header("Location: index.php?page=dashboard");
            exit;
        } 
        
        // 2. Si non trouvé, tenter de trouver dans la table `Admins`
        $stmtAdmin = query("SELECT * FROM Admins WHERE Email = ?", [$email]);
        $admin = $stmtAdmin->fetch();

        if ($admin && password_verify($password, $admin['Password'])) {
            $_SESSION['user_id']    = $admin['Id'];
            $_SESSION['user_email'] = $admin['Email'];
            // La table Admins utilise 'Username' au lieu de FirstName/LastName
            $_SESSION['user_name']  = $admin['Username']; 
            $_SESSION['is_admin']   = true;

            header("Location: index.php?page=dashboard");
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    }
}

?>

<section class="min-h-[85vh] w-[100vw] flex justify-center items-center">
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
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 min-h-[4vh]
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" name="password" id="password" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 min-h-[4vh]">
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
</section>