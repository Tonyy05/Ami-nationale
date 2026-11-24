<?php
if (!session_id()) {
    session_start();
}
$_SESSION["current_page"] = "connexion";
?>
<main>
  <section class="connexion-form">
    <h1>Connectez-vous</h1>
    <form action="pages/storeLogin.php" method="post">
      <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe *</label>
        <input type="password" id="password" name="password" required>
        <button type="button" id="togglePassword">Afficher</button>
      </div>
      <button type="submit">Se connecter ></button>
    </form>
  </section>
</main>
<script src="scripts/connexion.js"></script>
