<?php
if (!session_id()) {
    session_start();
}
$_SESSION["current_page"] = "contact";
?>
<main>
    <section class="contact-form">
        <h1>Contactez-nous</h1>
        <form action ="pages/storeContact.php" method="post">
            <div class="form-group">
                <div>
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div>
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone *</label>
                <input type="tel" id="telephone" name="telephone" required pattern="\d*" inputmode="numeric"
                       title="Veuillez entrer uniquement des chiffres.">
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="objet">Objet</label>
                <input type="text" id="objet" name="objet">
            </div>
            <div class="form-group">
                <label for="message">Votre message</label>
                <textarea id="message" name="message" rows="5"></textarea>
            </div>
            <button type="submit">Envoyer ></button>
        </form>
    </section>
</main>
