<?php
if (!session_id()) {
    session_start();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message envoyé avec succès</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        .success {
            color: green;
            font-size: 1.5rem;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        img {
            height: 50vh;
            width: auto;
        }
    </style>
</head>
<body>

<img src="../photos/success.png">
<?php
// Vérifier la page actuelle et afficher un message différent
if (isset($_SESSION["current_page"])) {
    switch ($_SESSION["current_page"]) {
        case "sondage":
            echo '<h1 class="success">Votre sondage a été envoyé avec succès !</h1>';
            break;
        case "contact":
            echo '<h1 class="success">Votre message de contact a été envoyé avec succès !</h1>';
            break;
        case "connexion":
            echo '<h1 class="success">Vous êtes connecté !</h1>';
            break;
        case "deconnexion":
            echo '<h1 class="success">Vous êtes déconnecté !</h1>';
            break;
        case "adherer":
            echo '<h1 class="success">Votre adhésion a été effectuée avec succès !</h1>';
            break;
        default:
            echo '<h1 class="success">Votre démarche a été effectuée avec succès !</h1>';
            break;
    }
} else {
    // Si la page n'est pas définie, message générique
    echo '<h1 class="success">Votre démarche a été effectuée avec succès !</h1>';
}
?>
<a href="./../index.php">Retourner à la page d\'accueil</a>

</body>
