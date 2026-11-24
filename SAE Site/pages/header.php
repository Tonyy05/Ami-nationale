<header>
  <img src="photos/logo.png" alt="Logo AMI" class="logo">
  <nav>
    <a href="index.php?section=accueil" class="<?= $section === 'accueil' ? 'active' : '' ?>">Accueil</a>
    <a href="index.php?section=actualites" class="<?= $section === 'actualites' ? 'active' : '' ?>">Actualités</a>
    <?php if(!isset($_SESSION['role'])):?>
      <a href="index.php?section=adherer" class="<?= $section === 'adherer' ? 'active' : '' ?>">Adhérer</a>
    <?php endif;?>
    <a href="index.php?section=contact" class="<?= $section === 'contact' ? 'active' : '' ?>">Contact</a>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] !== null && $_SESSION['role'] === 'user'): ?>
          <a href="index.php?section=sondage" class="<?= $section === 'sondage' ? 'active' : '' ?>">Sondage</a>
          <a href="pages/deconnexion.php" class="<?= $section === 'deconnexion' ? 'active' : '' ?>">Déconnexion</a>
      <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] !== null && $_SESSION['role'] === 'admin'): ?>
          <a href="pages/dashboard.php" class="<?= $section === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
          <a href="pages/deconnexion.php" class="<?= $section === 'deconnexion' ? 'active' : '' ?>">Déconnexion</a>
      <?php else: ?>
          <a href="index.php?section=connexion" class="<?= $section === 'connexion' ? 'active' : '' ?>">Connexion</a>
      <?php endif; ?>
  </nav>
  <div class="mobile-menu-toggle">
    <span class="menu-icon">☰</span>
  </div>
</header>
<script src="scripts/header.js"></script>
