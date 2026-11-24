<?php
if(!session_id()){
    session_start();
}
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A.M.I Nationale</title>
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/footer.css">
    <?php
    $section = isset($_GET['section']) ? $_GET['section'] : 'accueil';
    $allowed_sections = ['accueil', 'actualites', 'adherer', 'contact', 'connexion','sondage'];
    if (in_array($section, $allowed_sections)) {
        echo '<link rel = "stylesheet" href = "styles/'.$section.'.css">';
    } else {
        echo '<link rel = "stylesheet" href ="styles/accueil.css">';
    }
    ?>

</head>
<body>
<?php if ($section === 'connexion' && isset($_SESSION['error'])): ?>
    <p class="error"><?= htmlspecialchars($_SESSION['error']); ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
<?php
require_once 'pages/header.php';
if (in_array($section, $allowed_sections)) {
    require_once 'pages/'.$section . '.php';
} else {
    require_once 'pages/accueil.php';
}
require_once 'pages/footer.php';
?>
</body>
</html>

