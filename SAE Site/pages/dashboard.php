<?php
// Connexion à la base de données
try {
    $config = include "./../config.php";
    // Connexion à la base de données avec PDO
    $pdo = new PDO(
        "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4",
        $config['db_user'],
        $config['db_pass']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}

// Récupérer le nombre total d'adhérents
$stmt = $pdo->query("SELECT COUNT(*) AS total_adherents FROM adherents");
$totalAdherents = $stmt->fetch(PDO::FETCH_ASSOC)['total_adherents'];

// Récupérer le montant total des adhésions
$stmt = $pdo->query("SELECT SUM(montant) AS total_adhesions FROM adhesions");
$totalAdhesions = $stmt->fetch(PDO::FETCH_ASSOC)['total_adhesions'];

// Récupérer le nombre d'adhérents par type d'adhésion
$stmt = $pdo->query("SELECT type_adhesion, COUNT(*) AS count FROM adhesions GROUP BY type_adhesion");
$adhesionTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organiser les données pour le graphique
$adhesionTypesData = [];
foreach ($adhesionTypes as $adhesion) {
    $adhesionTypesData[] = ['type' => $adhesion['type_adhesion'], 'count' => $adhesion['count']];
}

// Récupérer les messages (contacts)
$stmt = $pdo->query("SELECT COUNT(*) AS total_messages FROM Contact");
$totalMessages = $stmt->fetch(PDO::FETCH_ASSOC)['total_messages'];

// Récupérer les statistiques de la table 'responses'
$stmt = $pdo->query("SELECT COUNT(*) AS total_responses FROM responses");
$totalResponses = $stmt->fetch(PDO::FETCH_ASSOC)['total_responses'];

// Récupérer les différents champs du JSON et les organiser en catégories
$fields = ['emploi', 'habitat', 'situation_familiale', 'department', 'living_situation', 'sante', 'soutien'];

$responseTypesData = [];

foreach ($fields as $field) {
    $stmt = $pdo->query("SELECT JSON_UNQUOTE(JSON_EXTRACT(response, '$.$field')) AS $field, COUNT(*) AS count 
                         FROM responses GROUP BY $field");
    $responseData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $fieldData = [];
    foreach ($responseData as $data) {
        $fieldData[] = ['type' => $data[$field] ?? 'Non spécifié', 'count' => $data['count']];
    }
    $responseTypesData[$field] = $fieldData;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Statistiques</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Style simple pour le dashboard */
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { display: flex; justify-content: space-between; }
        .card { border: 1px solid #ccc; padding: 20px; width: 30%; text-align: center; }
        canvas { width: 100%; max-width: 500px; margin: 20px auto; }
        .retour{border: 3px solid #007bff; padding : 10px; border-radius:10px; text-decoration: none; font-weight:bold;  }
        .retour:hover{color: white; background-color: #007bff}
    </style>
</head>
<body>
<a href = "./../index.php" class ="retour">RETOUR</a>
<h1>Dashboard des Statistiques</h1>

<div class="container">
    <!-- Statistiques -->
    <div class="card">
        <h3>Total Adhérents</h3>
        <p><?php echo $totalAdherents; ?></p>
    </div>
    <div class="card">
        <h3>Total des Adhésions (€)</h3>
        <p><?php echo number_format($totalAdhesions, 2, ',', ' '); ?></p>
    </div>
    <div class="card">
        <h3>Total Messages</h3>
        <p><?php echo $totalMessages; ?></p>
    </div>
</div>

<!-- Graphiques -->
<h2>Répartition des Types d'Adhésion</h2>
<canvas id="adhesionChart"></canvas>

<h1>Sondage</h1>

<div class="container">
    <!-- Statistiques -->
    <div class="card">
        <h3>Total Réponses</h3>
        <p><?php echo $totalResponses; ?></p>
    </div>
</div>

<!-- Graphiques -->
<h2>Répartition des Réponses (Emploi)</h2>
<canvas id="emploiChart"></canvas>

<h2>Répartition des Réponses (Habitat)</h2>
<canvas id="habitatChart"></canvas>

<h2>Répartition des Réponses (Situation Familiale)</h2>
<canvas id="situationFamilialeChart"></canvas>

<h2>Répartition des Réponses (Department)</h2>
<canvas id="departmentChart"></canvas>

<h2>Répartition des Réponses (Living Situation)</h2>
<canvas id="livingSituationChart"></canvas>

<h2>Répartition des Réponses (Santé)</h2>
<canvas id="santeChart"></canvas>

<h2>Répartition des Réponses (Soutien)</h2>
<canvas id="soutienChart"></canvas>

<script>
    var adhesionData = <?php echo json_encode($adhesionTypesData); ?>;

    var ctx = document.getElementById('adhesionChart').getContext('2d');
    var adhesionChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: adhesionData.map(item => item.type),
            datasets: [{
                label: 'Nombre d\'adhérents par type d\'adhésion',
                data: adhesionData.map(item => item.count),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var responseTypesData = <?php echo json_encode($responseTypesData); ?>;

    // Fonction pour générer un graphique en barres
    function createBarChart(ctx, data, label) {
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(item => item.type),
                datasets: [{
                    label: label,
                    data: data.map(item => item.count),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Fonction pour générer un diagramme circulaire
    function createPieChart(ctx, data, label) {
        return new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.map(item => item.type),
                datasets: [{
                    label: label,
                    data: data.map(item => item.count),
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    }

    // Créer les graphiques pour chaque champ
    createBarChart(document.getElementById('emploiChart').getContext('2d'), responseTypesData['emploi'], 'Répartition des réponses (Emploi)');
    createBarChart(document.getElementById('habitatChart').getContext('2d'), responseTypesData['habitat'], 'Répartition des réponses (Habitat)');
    createBarChart(document.getElementById('situationFamilialeChart').getContext('2d'), responseTypesData['situation_familiale'], 'Répartition des réponses (Situation Familiale)');
    createBarChart(document.getElementById('departmentChart').getContext('2d'), responseTypesData['department'], 'Répartition des réponses (Department)');
    createBarChart(document.getElementById('livingSituationChart').getContext('2d'), responseTypesData['living_situation'], 'Répartition des réponses (Living Situation)');
    createPieChart(document.getElementById('santeChart').getContext('2d'), responseTypesData['sante'], 'Répartition des réponses (Santé)');
    createPieChart(document.getElementById('soutienChart').getContext('2d'), responseTypesData['soutien'], 'Répartition des réponses (Soutien)');
</script>

</body>
</html>
