<?php
try {
    $config = include "./../config.php";
    // Connexion à la base de données avec PDO
    $pdo = new PDO(
        "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4",
        $config['db_user'],
        $config['db_pass']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $objet = $_POST['objet'] ?? null; // Objet peut être vide
    $message = $_POST['message'] ?? null; // Message peut être vide

    // Préparation de la requête d'insertion
    $sql = "INSERT INTO contact (nom, prenom, telephone, email, objet, message) 
            VALUES (:nom, :prenom, :telephone, :email, :objet, :message)";
    $stmt = $pdo->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':objet', $objet);
    $stmt->bindParam(':message', $message);

    // Exécution de la requête
    $stmt->execute();

    // Redirection ou message de succès
    require_once "success.php";
} catch (PDOException $e) {
    // Gestion des erreurs
    echo "Erreur : " . $e->getMessage();
}
?>