    // Fonction de validation du formulaire
    function validateForm() {
        // Récupération de la valeur du champ titreOffre
        var titreOffre = document.getElementById("titreOffre").value;
        // Récupération de la valeur du champ descriptionOffre
        var descriptionOffre = document.getElementById("descOffre").value;
        var salaire = document.getElementById("salaireOffre").value;
        var localOffre = document.getElementById("localOffre").value;
        var dateExOffre = document.getElementById("dateEx_offre").value;
        var compOffre = document.getElementById("compOffre").value;
        var nbPostes = document.getElementById("nbPostes").value;
        var langOffre = document.getElementById("langOffre").value;
        var cleOffre = document.getElementById("cleOffre").value;
        var today = new Date(); // Date d'aujourd'hui


        // Expression régulière pour vérifier si le titre contient uniquement des lettres
        var letters = /^[A-Za-z ]+$/;
        var numbersOnly = /^[0-9]+$/;

        // Validation du titre de l'offre
        if (titreOffre.trim() === "") {
            alert("Le titre de l'offre est requis.");
            return false;
        } else if (!titreOffre.match(letters)) {
            alert("Le titre de l'offre doit contenir uniquement des lettres.");
            return false;
        }

        // Validation de la description de l'offre
        if (descriptionOffre.trim() === "") {
            alert("La description de l'offre est requise.");
            return false;
        }
        else if (!descriptionOffre.match(letters)) {
            alert("La description de l'offre doit contenir uniquement des lettres.");
            return false;
        }

        if (parseFloat(salaire) <= 0 || isNaN(parseFloat(salaire))) {
            alert("Le salaire proposé doit être un nombre positif.");
            return false;
        }

              // Validation de la localisation de l'offre
              if (localOffre.trim() === "") {
            alert("La localisation de l'offre est requise.");
            return false;
        }
        else if (!localOffre.match(letters)) {
            alert("La localisation de l'offre doit contenir uniquement des lettres.");
            return false;
        }
                // Validation de la date d'expiration
                if (dateExOffre.trim() === "") {
            alert("La date d'expiration de l'offre est requise.");
            return false;
        }


                // Validation de la date d'expiration
                var dateEx = new Date(dateExOffre); // Convertir la date d'expiration en objet Date
        if (dateEx <= today) {
            alert("La date d'expiration doit être ultérieure à la date d'aujourd'hui.");
            return false;
        }


            // Validation des compétences requises
            if (compOffre.trim() === "") {
            alert("Les compétences requises sont requises.");
            return false;
        }
        else if (!compOffre.match(letters)) {
            alert("competence(s) de l'offre doit contenir uniquement des lettres.");
            return false;
        }
        // Validation du nombre de postes (doit être un nombre positif)
        if (isNaN(nbPostes) || nbPostes <= 0) {
            alert("Le nombre de postes doit être un nombre positif.");
            return false;
        }

          // Validation de la langue (doit contenir des chaînes séparées par des virgules et ne doit pas être vide)
          if (langOffre.trim() === "") {
            alert("La langue de l'offre est requise.");
            return false;
        }
              // Validation du champ langue (doit contenir des chaînes de caractères et des virgules)
    if (langOffre.trim() !== "" && !/^[a-zA-Z\s,]*$/.test(langOffre)) {
        alert("Le champ langue doit contenir uniquement des lettres, des espaces et des virgules.");
        return false;
    }

        // Validation du champ clé de l'offre (ne doit pas être vide)
        if (cleOffre.trim() === "") {
        alert("La clé de l'offre est requise.");
        return false;
    }else if (!cleOffre.match(letters)) {
            alert("cle de l'offre doit contenir uniquement des lettres.");
            return false;
        }
        // Si toutes les validations réussissent, retourne true
        return true;
    }

    // Ajout d'un gestionnaire d'événement pour le formulaire
    document.getElementById("offreForm").addEventListener("submit", function(event) {
        // Empêche la soumission du formulaire si la validation échoue
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    // Liste des suggestions de clés d'offre
    var suggestions = [
    "Assistant administratif",
    "Assistant de direction",
    "Chargé de clientèle",
    "Chef de projet",
    "Commercial",
    "Community manager",
    "Conseiller financier",
    "Consultant en gestion",
    "Développeur web",
    "Directeur des ventes",
    "Expert comptable",
    "Graphiste",
    "Ingénieur informatique",
    "Juriste",
    "Marketing manager",
    "Responsable des ressources humaines",
    "Secrétaire médical",
    "Technicien de maintenance",
    "Traducteur",
    "Vendeur",
    "Web designer"
];


// Fonction pour afficher les suggestions
function showSuggestions() {
    var input = document.getElementById("cleOffre");
    var keyword = input.value.toLowerCase();
    var suggestionList = document.getElementById("suggestionList");
    suggestionList.innerHTML = "";
    suggestions.forEach(function(suggestion) {
        if (suggestion.toLowerCase().startsWith(keyword)) {
            var suggestionItem = document.createElement("li");
            suggestionItem.textContent = suggestion;
            suggestionItem.addEventListener("click", function() {
                input.value = suggestion;
                suggestionList.innerHTML = "";
            });
            suggestionList.appendChild(suggestionItem);
        }
    });
}

// Ajout d'un gestionnaire d'événement pour le champ "clé de l'offre"
document.getElementById("cleOffre").addEventListener("input", showSuggestions);
