// actualites.js
function displayArticles(articles, filter = "") {
  const newsList = document.getElementById("news-list");
  newsList.innerHTML = ""; // Reset du conteneur

  // Filtre sur le titre, l'auteur et la date
  const filteredArticles = articles.filter(article =>
    article.titre.toLowerCase().includes(filter.toLowerCase()) ||
    article.auteur.toLowerCase().includes(filter.toLowerCase()) ||
    article.date.toLowerCase().includes(filter.toLowerCase())  // Ajout du filtre pour la date
  );

  if (filteredArticles.length === 0) {
    newsList.innerHTML = "<p>Aucun article trouvé.</p>";
    return;
  }

  filteredArticles.forEach(article => {
    const articleDiv = document.createElement("div");
    articleDiv.classList.add("article");

    articleDiv.innerHTML = `
            <h2>${article.titre}</h2>
            <p><strong>Auteur :</strong> ${article.auteur}</p>
            <p><strong>Date :</strong> ${article.date}</p>
            <p>${article.contenu}</p>
        `;

    newsList.appendChild(articleDiv);
  });
}

document.addEventListener("DOMContentLoaded", () => {
  // Chargement des articles à partir de `articles.js`
  displayArticles(articles);

  const searchInput = document.getElementById("search");
  const searchButton = document.getElementById("search-button");
  const resetButton = document.getElementById("reset-button"); // Bouton Retour

  // Recherche activée uniquement par le clic sur le bouton
  searchButton.addEventListener("click", () => {
    const filter = searchInput.value;
    displayArticles(articles, filter); // Applique le filtre sur les titres, auteurs et dates
  });

  // Réinitialisation de la recherche pour afficher tous les articles
  resetButton.addEventListener("click", () => {
    searchInput.value = ""; // Vide le champ de recherche
    displayArticles(articles); // Affiche tous les articles
  });
});
