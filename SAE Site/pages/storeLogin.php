<?php
if (!session_id()) {
    session_start();
}
try {
    // Connexion à la base de données
    $config = include "./../config.php";
    $pdo = new PDO(
        "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4",
        $config['db_user'],
        $config['db_pass']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour récupérer l'utilisateur correspondant à l'email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification si l'utilisateur existe
    if ($user) {
        // Vérification du mot de passe
        if (password_verify($password, $user['password_hash'])) {
            // Connexion réussie
            $_SESSION["role"] = $user["role"];
            $_SESSION['user_id'] = $user['id']; // Stockage de l'ID de l'utilisateur si nécessaire
            $_SESSION['email'] = $user['email']; // Stockage de l'email si nécessaires
            require_once "success.php";
        } else {
            // Mot de passe incorrect
            $_SESSION['error'] = "Mot de passe incorrect.";
        }
    } else {
        // Email non trouvé
        $_SESSION['error'] = "Aucun utilisateur trouvé avec cet email.";
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Erreur lors de la connexion : " . $e->getMessage();
}


