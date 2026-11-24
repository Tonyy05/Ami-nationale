<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $config = include "./../config.php";
        // Connexion à la base de données avec PDO
        $pdo = new PDO(
            "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4",
            $config['db_user'],
            $config['db_pass']
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Récupérer les données envoyées par le formulaire
        $emploi = $_POST['emploi'] ?? '';
        $habitat = $_POST['habitat'] ?? '';
        $situationFamiliale = $_POST['situation_familiale'] ?? '';
        $department = $_POST['department'] ?? '';
        $livingSituation = $_POST['living_situation'] ?? '';
        $sante = $_POST['Sante'] ?? '';
        $soutien = $_POST['soutien'] ?? '';

        // Crée un tableau associatif des réponses
        $responses = [
            'emploi' => htmlspecialchars($emploi),
            'habitat' => htmlspecialchars($habitat),
            'situation_familiale' => htmlspecialchars($situationFamiliale),
            'department' => htmlspecialchars($department),
            'living_situation' => htmlspecialchars($livingSituation),
            'sante' => htmlspecialchars($sante),
            'soutien' => htmlspecialchars($soutien),
        ];

        // Convertir le tableau associatif en JSON
        $responsesJson = json_encode($responses, JSON_PRETTY_PRINT);

        // Préparation de la requête d'insertion
        $sql = "INSERT INTO responses (response) VALUES (:response)";
        $stmt = $pdo->prepare($sql);

        // Liaison du paramètre
        $stmt->bindParam(':response', $responsesJson);
        // Exécution de la requête
        $stmt->execute();

        // Rediriger l'utilisateur vers une page de confirmation
        require_once "success.php";
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}
?>
