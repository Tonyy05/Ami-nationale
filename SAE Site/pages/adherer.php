<?php
if (!session_id()) {
    session_start();
}
$_SESSION["current_page"] = "adherer";
?>
<main>
    <div>
        <section class="presentation-container">
            <h2>L'A.M.I a besoin de vous</h2>
            <div class="divider"></div>
            <p class="description">
                Dans les départements où elle est implantée, des membres siègent au sein des différentes instances,
                comme
                les Commissions Départe­mentales pour l’Autonomie des Personnes Handicapées (CDAPH), les commissions
                d’accessibilité etc…
                Au niveau national, elle siège également au Conseil National Consultatif des Personnes Handicapées
                (CNCPH)
                Dans ces instances, elle intervient dans le but de faire évoluer la législation pour améliorer la vie
                quotidienne des personnes en situation de handicap.
                De nombreuses dispositions de la loi du 11 février 2005 ne répondent toujours pas aux besoins, aux
                attentes
                et aux aspirations des citoyens concernés.
                Depuis plus de 80 ans, nous avons établi des liens avec les organisations syndicales, de la CGT
                notamment,
                avec les militants sensibilisés par les questions de handicap et lancé chaque année un appel à soutien
                financier.
                Pour chaque adhésion, le journal Revivre est inclus !
            </p>
        </section>

        <section class="adhesion">
            <div class="steps">
                <div class="step active">Choix de l'adhésion</div>
                <div class="step">Adhérents</div>
                <div class="step">Identifiants de connexion</div>
                <div class="step">Récapitulatif</div>
            </div>
            <form action="pages/storeAdhesion.php" method="post">
                <section class="formulaire formulaire1">
                    <div class="adhesion-options">
                        <!-- Option 1 -->
                        <label class="option">
                            <input type="radio" name="adhesion" value="ordinaire" hidden>
                            <div class="content">
                                <h3>Adhésion Ordinaire</h3>
                                <p>Ressources supérieures au SMIC</p>
                                <span class="price">40€</span>
                            </div>
                        </label>

                        <!-- Option 2 -->
                        <label class="option">
                            <input type="radio" name="adhesion" value="reduite" hidden>
                            <div class="content">
                                <h3>Adhésion Réduite</h3>
                                <p>Ressources inférieures au SMIC</p>
                                <span class="price">20€</span>
                            </div>
                        </label>

                        <!-- Option 3 -->
                        <label class="option">
                            <input type="radio" id="cpl" name="adhesion" value="couple_sup" hidden>
                            <div class="content">
                                <h3>Adhésion Couple</h3>
                                <p>Ressources supérieures au SMIC</p>
                                <span class="price">50€</span>
                            </div>
                        </label>

                        <!-- Option 4 -->
                        <label class="option">
                            <input type="radio" id="cpl" name="adhesion" value="couple_inf" hidden>
                            <div class="content">
                                <h3>Adhésion Couple</h3>
                                <p>Ressources inférieures au SMIC</p>
                                <span class="price">30€</span>
                            </div>
                        </label>

                        <!-- Option 5 -->
                        <label class="option free-support">
                            <input type="radio" name="adhesion" value="soutien" hidden>
                            <div class="content">
                                <h3>Adhésion de Soutien</h3>
                                <p>Prix libre</p>
                                <input type="number" name="soutien_price" class="free-price" placeholder="€">
                            </div>
                        </label>
                    </div>
                    <div class="total">
                        <p>Montant à payer pour la durée de l'adhésion : <span id="total">0 €</span></p>
                        <button type="button" class="nav next first">Suivant</button>
                    </div>
                </section>
                <!-- Étape 2 -->

                <section class="formulaire2 formulaire ">
                    <div class="form-container">
                        <h3>Coordonnées Adhérents</h3>
                        <div class="rond">
                            <div class="form-group name-group">
                                <div class="form-field">
                                    <label for="nom">Nom : *</label>
                                    <input type="text" id="nom" name="nom" required>
                                </div>
                                <div class="form-field">
                                    <label for="prenom">Prénom : *</label>
                                    <input type="text" id="prenom" name="prenom" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse postale : *</label>
                            <input type="text" id="adresse" name="adresse" oninput="autocompleteAddress()" autocomplete="off" required>
                            <ul id="adresse-suggestions" class="suggestions"></ul>
                        </div>

                        <div class="form-group name-group">
                            <div class="form-field">
                                <label for="cde-postal">Code Postal : *</label>
                                <input type="text" id="cde-postal" name="cde-postal" required inputmode="numeric"
                                title ="Veuillez entrer uniquement des chiffres">
                            </div>
                            <div class="form-field">
                                <label for="ville">Ville : *</label>
                                <input type="text" id="ville" name="ville" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Numéro de téléphone : *</label>
                            <input type="tel" id="telephone" name="telephone"  required pattern="\d*" inputmode="numeric"
                                   title="Veuillez entrer uniquement des chiffres.">
                        </div>

                        <div class="form-group btn">
                            <button type="button" class="nav prev">< Retour</button>
                            <button type="button" class="nav second">Suivant ></button>
                        </div>
                </section>

                <!-- Étape 3 -->
                <section class="formulaire formulaire3">
                    <div class="form-container">
                        <h3>Identifiants de connexion</h3>
                        <div class="form-group">
                            <label for="email">Adresse email :</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe :</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirmation du mot de passe :</label>
                            <input type="password" id="confirm-password" name="confirm-password" required>
                        </div>
                        <div class="btn">
                            <button type="button" class="nav prev">< Retour</button>
                            <button type="button" class="nav recap">Suivant ></button>
                        </div>
                    </div>
                </section>

                <!-- Étape 4 -->
                <section class="formulaire formulaire4">
                    <div class="form-container">
                        <h3>Récapitulatif</h3>
                        <ul class="recap-list"></ul>
                        <div class="btn">
                            <button type="button" class="nav prev">< Retour</button>
                            <button type="submit" class="nav submit">Valider</button>
                        </div>
                    </div>
                </section>
            </form>
        </section>
        <script src="scripts/adherer.js"></script>
    </div>
</main>