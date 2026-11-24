<?php
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
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $codePostal = $_POST['cde-postal'];
    $ville = $_POST['ville'];
    $telephone = $_POST['telephone'];
    $typeAdhesion = $_POST['adhesion'] ?? null;
    $montantSoutien = isset($_POST['soutien_price']) ? $_POST['soutien_price'] : null;
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Insertion des données dans la table `adherents`
    $stmt = $pdo->prepare("INSERT INTO adherents (nom, prenom, email, adresse, code_postal, ville, telephone) 
                            VALUES (:nom, :prenom, :email, :adresse, :code_postal, :ville, :telephone)");
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':adresse' => $adresse,
        ':code_postal' => $codePostal,
        ':ville' => $ville,
        ':telephone' => $telephone
    ]);

    $idUtilisateur = $pdo->lastInsertId();

    // Enregistrement dans la table `users` avec le rôle par défaut "user"
    $stmt = $pdo->prepare("INSERT INTO users (id, email, password_hash, role) 
                            VALUES (:id, :email, :password_hash, 'user')");
    $stmt->execute([
        ':id' => $idUtilisateur,
        ':email' => $email,
        ':password_hash' => $password
    ]);

    // Vérification du type d'adhésion et traitement du montant
    $typesAdhesion = [
        'ordinaire' => 40,
        'reduite' => 20,
        'couple_sup' => 50,
        'couple_inf' => 30,
        'soutien' => $montantSoutien // Le montant libre pour l'adhésion de soutien
    ];

    if ($typeAdhesion && array_key_exists($typeAdhesion, $typesAdhesion)) {
        $montant = $typesAdhesion[$typeAdhesion];

        // Si c'est une adhésion de soutien, le montant est libre
        if ($typeAdhesion == 'soutien' && $montantSoutien !== null) {
            $montant = (float) $montantSoutien;
        }

        // Insertion dans la table `adhesions`
        $stmt = $pdo->prepare("INSERT INTO adhesions (adherent_id, type_adhesion, montant)
                               VALUES (:adherent_id, :type_adhesion, :montant)");
        $stmt->execute([
            ':adherent_id' => $idUtilisateur,
            ':type_adhesion' => $typeAdhesion,
            ':montant' => $montant
        ]);
    }
    // Rediriger vers la page de succès après insertion
    require_once "success.php";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
