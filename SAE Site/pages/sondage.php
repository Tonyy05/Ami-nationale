<?php
if (!session_id()) {
    session_start();
}
$_SESSION["current_page"] = "sondage";
?>
<main class="content-container">
    <div class="page-title">
        <h1>Formulaire de Sondage</h1>
    </div>
    <form action="pages/submit_formulaire.php" method="POST" class="survey-form">
        <fieldset>
            <legend>1. À propos de vous</legend>
            <!-- Activité pro -->
            <legend><strong>Activites professionelles ?</strong></legend>
            <label><input type="radio" name="emploi" value="Employé(e)">Employé(e)</label>
            <label><input type="radio" name="emploi" value="Cadre">Cadre</label>
            <label><input type="radio" name="emploi" value="Artisan">Artisan</label>
            <label><input type="radio" name="emploi" value="Profession libérale">Profession libérale</label>
            <label><input type="radio" name="emploi" value="Indépendant(e)">Indépendant(e)</label>
            <label><input type="radio" name="emploi" value="Retraité(e)">Retraité(e)</label>
            <label><input type="radio" name="emploi" value="Étudiant(e)">Étudiant(e)</label>
            <label><input type="radio" name="emploi" value="Sans emploi">Sans emploi</label>
            <label><input type="radio" name="emploi" value="Autre">Autre</label>

            <!-- Logement -->

            <legend><strong>Type d'habitat ?</strong> </legend>
            <label><input type="radio" name="habitat" value="Appartement">Appartement</label>
            <label><input type="radio" name="habitat" value="Maison individuelle">Maison individuelle</label>
            <label><input type="radio" name="habitat" value="Residence partage">Residence partagee</label>
            <label><input type="radio" name="habitat" value="Habitat collectif avec services">Habitat collectif avec services</label>
            <label><input type="radio" name="habitat" value="Mobil-home ou caravane">Mobil-home ou caravane</label>
            <label><input type="radio" name="habitat" value="Logement social">Logement social</label>
            <label><input type="radio" name="habitat" value="Logement adapté pour personnes en situation de handicap">Logement adapté pour personnes en situation de handicap</label>
            <label><input type="radio" name="habitat" value="Autre">Autre</label>




            <!-- Situation familiale -->
            <legend><strong> Situation familiale ?</strong></legend>
            <label><input type="radio" name="situation_familiale" value="En couple">En couple</label>
            <label><input type="radio" name="situation_familiale" value="Célibataire">Célibataire</label>
            <label><input type="radio" name="situation_familiale" value="Parents isolés">Parents isolés</label>
            <label><input type="radio" name="situation_familiale" value="Famille recomposée">Famille recomposée</label>
            <label><input type="radio" name="situation_familiale" value="Famille monoparentale">Famille monoparentale</label>
            <label><input type="radio" name="situation_familiale" value="En union libre">En union libre</label>
            <label><input type="radio" name="situation_familiale" value="Autre">Autre</label>
        </fieldset>
        <fieldset>
            <legend>2. Lieu et qualite de vie</legend>

            <!-- Département / Région -->

            <legend><strong>Dans quel département/region vivez-vous ?</strong></legend>
            <select id="department" name="department">
                <option value="">Sélectionner un département</option>
                <option value="Ain">Ain (01)</option>
                <option value="Aisne">Aisne (02)</option>
                <option value="Allier">Allier (03)</option>
                <option value="Alpes-de-Haute-Provence">Alpes-de-Haute-Provence (04)</option>
                <option value="Hautes-Alpes">Hautes-Alpes (05)</option>
                <option value="Alpes-Maritimes">Alpes-Maritimes (06)</option>
                <option value="Ardèche">Ardèche (07)</option>
                <option value="Ardennes">Ardennes (08)</option>
                <option value="Ariège">Ariège (09)</option>
                <option value="Aube">Aube (10)</option>
                <option value="Aude">Aude (11)</option>
                <option value="Aveyron">Aveyron (12)</option>
                <option value="Bouches-du-Rhône">Bouches-du-Rhône (13)</option>
                <option value="Calvados">Calvados (14)</option>
                <option value="Cantal">Cantal (15)</option>
                <option value="Charente">Charente (16)</option>
                <option value="Charente-Maritime">Charente-Maritime (17)</option>
                <option value="Cher">Cher (18)</option>
                <option value="Corrèze">Corrèze (19)</option>
                <option value="Côte-d'Or">Côte-d'Or (21)</option>
                <option value="Côtes-d'Armor">Côtes-d'Armor (22)</option>
                <option value="Creuse">Creuse (23)</option>
                <option value="Dordogne">Dordogne (24)</option>
                <option value="Doubs">Doubs (25)</option>
                <option value="Drôme">Drôme (26)</option>
                <option value="Eure">Eure (27)</option>
                <option value="Eure-et-Loir">Eure-et-Loir (28)</option>
                <option value="Finistère">Finistère (29)</option>
                <option value="Gard">Gard (30)</option>
                <option value="Haute-Garonne">Haute-Garonne (31)</option>
                <option value="Gers">Gers (32)</option>
                <option value="Gironde">Gironde (33)</option>
                <option value="Hérault">Hérault (34)</option>
                <option value="Ille-et-Vilaine">Ille-et-Vilaine (35)</option>
                <option value="Indre">Indre (36)</option>
                <option value="Indre-et-Loire">Indre-et-Loire (37)</option>
                <option value="Isère">Isère (38)</option>
                <option value="Jura">Jura (39)</option>
                <option value="Landes">Landes (40)</option>
                <option value="Loir-et-Cher">Loir-et-Cher (41)</option>
                <option value="Loire">Loire (42)</option>
                <option value="Haute-Loire">Haute-Loire (43)</option>
                <option value="Loire-Atlantique">Loire-Atlantique (44)</option>
                <option value="Loiret">Loiret (45)</option>
                <option value="Lot">Lot (46)</option>
                <option value="Lot-et-Garonne">Lot-et-Garonne (47)</option>
                <option value="Lozère">Lozère (48)</option>
                <option value="Maine-et-Loire">Maine-et-Loire (49)</option>
                <option value="Manche">Manche (50)</option>
                <option value="Marne">Marne (51)</option>
                <option value="Haute-Marne">Haute-Marne (52)</option>
                <option value="Mayenne">Mayenne (53)</option>
                <option value="Meurthe-et-Moselle">Meurthe-et-Moselle (54)</option>
                <option value="Meuse">Meuse (55)</option>
                <option value="Morbihan">Morbihan (56)</option>
                <option value="Moselle">Moselle (57)</option>
                <option value="Nièvre">Nièvre (58)</option>
                <option value="Nord">Nord (59)</option>
                <option value="Oise">Oise (60)</option>
                <option value="Orne">Orne (61)</option>
                <option value="Pas-de-Calais">Pas-de-Calais (62)</option>
                <option value="Puy-de-Dôme">Puy-de-Dôme (63)</option>
                <option value="Pyrénées-Atlantiques">Pyrénées-Atlantiques (64)</option>
                <option value="Hautes-Pyrénées">Hautes-Pyrénées (65)</option>
                <option value="Pyrénées-Orientales">Pyrénées-Orientales (66)</option>
                <option value="Bas-Rhin">Bas-Rhin (67)</option>
                <option value="Haut-Rhin">Haut-Rhin (68)</option>
                <option value="Rhône">Rhône (69)</option>
                <option value="Haute-Saône">Haute-Saône (70)</option>
                <option value="Saône-et-Loire">Saône-et-Loire (71)</option>
                <option value="Sarthe">Sarthe (72)</option>
                <option value="Savoie">Savoie (73)</option>
                <option value="Haute-Savoie">Haute-Savoie (74)</option>
                <option value="Paris">Paris (75)</option>
                <option value="Seine-Maritime">Seine-Maritime (76)</option>
                <option value="Seine-et-Marne">Seine-et-Marne (77)</option>
                <option value="Yvelines">Yvelines (78)</option>
                <option value="Deux-Sèvres">Deux-Sèvres (79)</option>
                <option value="Somme">Somme (80)</option>
                <option value="Tarn">Tarn (81)</option>
                <option value="Tarn-et-Garonne">Tarn-et-Garonne (82)</option>
                <option value="Var">Var (83)</option>
                <option value="Vaucluse">Vaucluse (84)</option>
                <option value="Vendée">Vendée (85)</option>
                <option value="Vienne">Vienne (86)</option>
                <option value="Haute-Vienne">Haute-Vienne (87)</option>
                <option value="Vosges">Vosges (88)</option>
                <option value="Yonne">Yonne (89)</option>
                <option value="Territoire de Belfort">Territoire de Belfort (90)</option>
                <option value="Essonne">Essonne (91)</option>
                <option value="Hauts-de-Seine">Hauts-de-Seine (92)</option>
                <option value="Seine-Saint-Denis">Seine-Saint-Denis (93)</option>
                <option value="Val-de-Marne">Val-de-Marne (94)</option>
                <option value="Val-d'Oise">Val-d'Oise (95)</option>
                <option value="Guadeloupe">Guadeloupe (971)</option>
                <option value="Martinique">Martinique (972)</option>
                <option value="Guyane">Guyane (973)</option>
                <option value="La Réunion">La Réunion (974)</option>
                <option value="Mayotte">Mayotte (976)</option>
            </select>


            <label>
                <strong>Qualité de vie ?</strong>
                <select name="living_situation" required>
                    <option value="bien">Tout va bien</option>
                    <option value="restriction_sociale">Restriction de la vie sociale</option>
                    <option value="souffrance_psy">Souffrance psychologique</option>
                    <option value="fatigue">Fatigue, épuisement</option>
                    <option value="reduction_pro">Réduction d’activité professionnelle</option>
                    <option value="couts_financiers">Coûts financiers importants</option>
                    <option value="impact_fratrie">Impact négatif sur la fratrie</option>
                    <option value="conflits_familiaux">Conflits familiaux</option>
                    <option value="maladie">Maladie</option>
                </select>
            </label>

            <legend><strong>Accès à la santé ?</strong></legend>
            <label><input type="radio" name="Sante" value="soins_reguliers" required>Soins réguliers auprès de professionnels de santé</label>
            <label><input type="radio" name="Sante" value="acces_limite">Accès limité aux soins médicaux</label>
            <label><input type="radio" name="Sante" value="consultation_necessite">Consultation uniquement en cas de nécessité</label>
            <label><input type="radio" name="Sante" value="pas_acces">Pas d’accès régulier aux soins</label>
            <label><input type="radio" name="Sante" value="intervention_domicile">Intervention ponctuelle d’un soignant à domicile</label>
            <label><input type="radio" name="Sante" value="autre">Autre</label>

            <legend><strong>Besoin de soutien ?</strong></legend>
            <label><input type="radio" name="soutien" value="autonome" required>La personne est totalement autonome</label>
            <label><input type="radio" name="soutien" value="soutien_autonomie">Un soutien à l’autonomie pour le logement, l’accès à la santé, les loisirs, les démarches administratives</label>
            <label><input type="radio" name="soutien" value="aide_complete">Une aide pour tous les actes de la vie quotidienne et présence d’un tiers-personne H24</label>
            <label><input type="radio" name="soutien" value="interventions_ponctuelles">Des interventions et stimulations ponctuelles (toilettes, sorties, repas, communication…)</label>


        </fieldset>
        <button type="submit" class="btn-submit">Envoyer</button>
    </form>
</main>

<a href="#" class="sp-scroll-up" aria-label="Scroll Up"><span class="fas fa-angle-up" aria-hidden="true"></span></a>
