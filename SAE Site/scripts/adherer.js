document.addEventListener("DOMContentLoaded", () => {
  // Récupération des éléments pour le calcul du total
  const totalElement = document.getElementById("total");
  const options = document.querySelectorAll(".option input[type='radio']");
  const freePriceInput = document.querySelector(".free-price");


  function calculateTotal() {
    let total = 0;

    options.forEach(option => {
      if (option.checked) {
        // Ajouter le prix de l'option sélectionnée
        const price = parseInt(option.closest('.option').querySelector(".price").textContent.replace("\u20ac", "") || 0);
        total += price;
      }

    });




    // Si une adhésion de soutien avec un prix libre est remplie
    const freePrice = parseFloat(freePriceInput.value || 0);
    total += freePrice;

    totalElement.textContent = `${total} €`;
  }



  // Écouter les changements d'option pour mettre à jour le total
  options.forEach(input => {
    input.addEventListener("change", calculateTotal); // Mise à jour dès qu'une option est sélectionnée
  });

  // Écouter les changements dans l'input du prix libre
  if (freePriceInput) {
    freePriceInput.addEventListener("change", calculateTotal); // Mise à jour dès que le prix libre est modifié
  }

  // Gestion du carrousel des étapes
  const steps = document.querySelectorAll(".step");
  const forms = document.querySelectorAll(".formulaire");
  let currentStep = 0;

  function showStep(index) {
    forms.forEach((form, i) => form.classList.toggle("active", i === index));
    steps.forEach((step, i) => step.classList.toggle("active", i === index));
  }

  // Fonction de validation des champs
  function validateFields(form) {
    const fields = form.querySelectorAll("input[required], select[required], textarea[required]");
    let isValid = true;

    fields.forEach(field => {
      // Vérification si le champ est vide ou si le format est incorrect
      if (!field.value.trim() || !field.checkValidity()) {
        field.classList.add("error"); // Ajout d'une classe d'erreur pour CSS
        isValid = false;
      } else {
        field.classList.remove("error"); // Retrait de la classe d'erreur si corrigé
      }
    });

    return isValid;
  }

  function isOptionSelected() {
    // Sélectionne tous les boutons radio avec le name "option"
    const options = document.querySelectorAll('input[type="radio"][name="option"]');

    // Retourne true si au moins un bouton radio est sélectionné, sinon false
    return Array.from(options).some(option => option.checked);
  }



  document.querySelectorAll(".next").forEach(button => {
    button.addEventListener("click", (e) => {
      if (currentStep < forms.length - 1) {
        currentStep++;
        showStep(currentStep);
      }
    });
  });
  document.querySelectorAll(".nav.second").forEach(button => {
    button.addEventListener("click", (e) => {
      const form = forms[currentStep]; // Récupérer le formulaire actuel
      const NumTel = document.getElementById("telephone").value;
      const CodePostal = document.getElementById("cde-postal").value;
      // Validation des champs du formulaire actuel
      if (!validateFields(form)) {
        alert('Veuillez remplir tous les champs obligatoires avec le bon format.');
        e.preventDefault(); // Empêche la navigation
      } else if (NumTel.length !== 10) {
          alert('Veuillez respecter le format du numéro de téléphone.');
          e.preventDefault();
        } else if (CodePostal.length !== 5 && CodePostal !== "99") {
            alert('Veuillez saisir 5 chiffres ou 99 pour étrangé.')
            e.preventDefault();
          }
      else if (currentStep < forms.length - 1) {
            currentStep++; // Si tous les champs sont valides, passe à l'étape suivante
            showStep(currentStep);
          }



    });
  });


  document.querySelectorAll(".prev").forEach(button => {
    button.addEventListener("click", () => {
        if (currentStep > 0) {
          currentStep--;
          showStep(currentStep);
        }
    });
  });



  // Initialiser la première étape
  showStep(currentStep);

  // Gestion du récapitulatif
  const recapButton = document.querySelector(".recap");
  recapButton?.addEventListener("click", (e) => {
    e.preventDefault();

    const recapList = document.querySelector(".recap-list");
    recapList.innerHTML = "";

    // Collecte des choix d'adhésion
    const adhesionChoice = Array.from(options).map(option => {
      if (option.checked) {
        return option.closest('.option').querySelector("h3").textContent;
      }
      return null;
    }).filter(Boolean).join(", ");

    // Collecte des détails de l'adhérent
    const adherentDetails = {
      "Nom": document.getElementById("nom")?.value,
      "Prenom": document.getElementById("prenom")?.value,
      "Adresse e-mail": document.getElementById("email")?.value,
      "Adresse postale": document.getElementById("adresse")?.value,
      "Code Postal": document.getElementById("cde-postal")?.value,
      "Ville": document.getElementById("ville")?.value,
      "Numéro de téléphone": document.getElementById("telephone")?.value
    };

    // Génération du récapitulatif
    recapList.innerHTML = `
      <li><strong>Choix d'adhésion :</strong> ${adhesionChoice || "Non sélectionné"}</li>
      <li><strong>Coordonnées Adhérent :</strong><br>${Object.entries(adherentDetails).map(([key, value]) => `${key} : ${value || "Non renseigné"}`).join("<br>")}</li>
    `;
    showStep(forms.length - 1); // Passer à l'étape récapitulatif
  });
});

function autocompleteAddress() {
  const query = document.getElementById('adresse').value;
  const suggestions = document.getElementById('adresse-suggestions');

  // Si moins de 3 caractères, on vide les suggestions
  if (query.length < 3) {
    suggestions.innerHTML = '';
    return;
  }

  // Requête à l'API Adresse.data.gouv.fr
  fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(query)}&limit=5`)
      .then(response => response.json())
      .then(data => {
        suggestions.innerHTML = ''; // Vide les suggestions précédentes

        // Ajoute chaque suggestion à la liste
        data.features.forEach(feature => {
          const li = document.createElement('li');
          li.textContent = feature.properties.label;
          li.className = 'suggestion-item';

          // Remplissage automatique des champs lors de la sélection
          li.onclick = () => {
            document.getElementById('adresse').value = feature.properties.name;
            document.getElementById('cde-postal').value = feature.properties.postcode;
            document.getElementById('ville').value = feature.properties.city;
            suggestions.innerHTML = ''; // Vide la liste après sélection
          };

          suggestions.appendChild(li);
        });
      })
      .catch(error => console.error('Erreur lors de la récupération des données :', error));
}












