$(function() {
    // Liste de villes tunisiennes pour l'autocomplétion
    var villesTunisiennes = [
        "Tunis", "Sfax", "Sousse", "Kairouan", "Bizerte", "Gabès", "Ariana", "Gafsa", "Monastir", "Ben Arous", 
        "Kasserine", "Nabeul", "La Marsa", "Médenine", "Beja", "Mahdia", "Zarzis", "El Mourouj", "Sidi Bouzid",
        "Tataouine", "Jendouba", "Douz", "Siliana", "Manouba", "Kebili", "La Goulette", "Rades", "Hammam-Lif",
        "Djerba", "Fériana", "Korba", "Oued Ellil", "Hammam Sousse", "Ksour Essaf", "Menzel Temime", "Chebba",
        "Zaghouan", "Jammel", "Menzel Bourguiba", "Kalâa Kebira", "Mateur", "Dahmani", "Menzel Jemil", "Aïn Draham",
        "Ghannouch", "Galaat el Andeless", "El Alia", "Amdoun", "Sakiet Sidi Youssef", "Sakiet Ezzit", "Menzel Kamel",
        "El Haouaria", "Akouda", "Séjnane", "Zaouiet Djedidi", "Ksibet el Mediouni", "Nadhour", "Sbikha", "Oueslatia",
        "Kalaat Senan", "Bir Mcherga", "Majaz al Bab", "Bou Arada", "Touza", "El Ksar", "Oued Meliz", "El Aroussa",
        "Menzel Abderhaman", "Menzel Fersi", "Nabeur", "Menzel Hayet", "Menzel Chaker", "Menzel Ennour", "Téboulba",
        "Menzel Salem", "Nasrallah", "Menzel El Khair", "Hajeb El Ayoun", "Chihia", "Menzel Bouzaiane", "Sanghé", 
        "Menzel Meherzi", "Menzel El Habib", "Ksibet el Aïdi", "Menzel Temime", "Ksibet Thrayet", "Menzel Jemil", 
        "Teboursouk", "Menzel Horr", "Bou Hajla", "Menzel Farsi", "Menzel Salem", "Menzel El Khair", "El Batan",
        "Menzel Bouzelfa", "Béni Khalled", "Ghar al Milh", "Sajnen", "Menzel Chamekh", "Foussana", "Hadjerat Ennous",
        "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime", "Sekhira", "Menzel El Amra",
        "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri", "La Sebala du Mornag",
        "Sakiet Eddaïer", "Mellouleche", "Menzel Jemil", "Foussana", "Hadjerat Ennous", "Tinja", "El Hencha",
        "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime", "Sekhira", "Menzel El Amra", "El Alâa",
        "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri", "La Sebala du Mornag", 
        "Sakiet Eddaïer", "Mellouleche", "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", 
        "Menzel Tmime", "Sekhira", "Menzel El Amra", "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker",
        "Dar Châabane El Fehri", "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Menzel El Habib", 
        "El Batan", "Menzel Bouzelfa", "Béni Khalled", "Ghar al Milh", "Sajnen", "Menzel Chamekh", "Foussana",
        "Hadjerat Ennous", "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime",
        "Sekhira", "Menzel El Amra", "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri", 
        "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", 
        "Joumine", "Menzel Tmime", "Sekhira", "Menzel El Amra", "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker",
        "Dar Châabane El Fehri", "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Menzel Chaker", "Dar Châabane El Fehri",
        "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Menzel El Habib", "El Batan", "Menzel Bouzelfa",
        "Béni Khalled", "Ghar al Milh", "Sajnen", "Menzel Chamekh", "Foussana", "Hadjerat Ennous", "Tinja",
        "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime", "Sekhira", "Menzel El Amra",
        "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri", "La Sebala du Mornag",
        "Sakiet Eddaïer", "Mellouleche", "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine",
        "Menzel Tmime", "Sekhira", "Menzel El Amra", "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker",
        "Dar Châabane El Fehri", "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Menzel El Habib", "El Batan",
        "Menzel Bouzelfa", "Béni Khalled", "Ghar al Milh", "Sajnen", "Menzel Chamekh", "Foussana", "Hadjerat Ennous",
        "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime", "Sekhira", "Menzel El Amra",
        "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri", "La Sebala du Mornag",
        "Sakiet Eddaïer", "Mellouleche", "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime",
        "Sekhira", "Menzel El Amra", "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri",
        "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Menzel Chaker", "Dar Châabane El Fehri", "La Sebala du Mornag",
        "Sakiet Eddaïer", "Mellouleche"
    ];

    // Activation de l'autocomplétion pour le champ de localisation
    $("#localOffre").autocomplete({
        source: villesTunisiennes
    });
});





$(function() {
// Validation du formulaire lors de la soumission
$("#offreForm").submit(function(event) {
    // Appel des fonctions de validation pour chaque champ
    var titreValide = validerTitre();
    var logoValide = validerLogo();
    var descValide = validerDescription();
    var salaireValide = validerSalaire();
   var  localValide = validerLocalisation();
   var dateExVAlide =validerDateExpiration();
   var nbPostesValide = validerNbPostes();
   var motCleValide = validerMotCle();
   var competenceVAlide = validerCompetences();
    // Ajoutez d'autres fonctions de validation pour les autres champs

    // Vérification globale
    if (!titreValide || !logoValide || !descValide || !salaireValide || !localValide || !dateExVAlide || !nbPostesValide || !motCleValide || !competenceVAlide) {
        // Empêcher la soumission du formulaire si un champ est invalide
        event.preventDefault();
    }
});

// Fonction de validation du titre
function validerTitre() {
var titreInput = $("#titreOffre");
var erreurTitre = $("#titreOffreError");
var regex = /^[A-Za-z\s]+$/; // Expression régulière pour les chaînes de caractères

if (titreInput.val().trim() === "") {
    erreurTitre.html("<span style='color:red'>Le titre est requis</span>");
    titreInput.addClass("erreur-input"); // Ajouter la classe en cas d'erreur
    return false;
} else if (!regex.test(titreInput.val())) {
    erreurTitre.html("<span style='color:red'>Le titre ne doit contenir que des lettres</span>");
    titreInput.addClass("erreur-input"); // Ajouter la classe en cas d'erreur
    return false;
} else {
    erreurTitre.html("");
    titreInput.removeClass("erreur-input"); // Retirer la classe si tout est valide
    return true;
}
}




// Fonction de validation du logo
function validerLogo() {
    var logoInput = $("#logo").val();
    var erreurLogo = $("#logoError");

    if (logoInput === "") {
        erreurLogo.html("<span style='color:red'> logo est requis</span>");
        return false;
    } else {
        erreurLogo.html("");
        return true;
    }
}

// Fonction de validation de la description
function validerDescription() {
var descInput = $("#descOffre").val();
var erreurDesc = $("#descOffreError");

// Séparer la description en mots
var mots = descInput.split(/\s+/); // Sépare la chaîne en mots (utilisez un espace comme séparateur)

if (descInput.trim() === "") {
    erreurDesc.html("<span style='color:red'>La description est requise</span>");
    return false;
} else if (mots.length < 30) {
    erreurDesc.html("<span style='color:red'>La description doit contenir au moins 30 mots</span>");
    return false;
} else {
    erreurDesc.html("");
    return true;
}
}


// Fonction de validation du salaire
function validerSalaire() {
var salaireInput = parseFloat($("#salaireOffre").val()); // Convertir la valeur du salaire en nombre flottant
var erreurSalaire = $("#salaireOffreError");

if (isNaN(salaireInput)) {
    erreurSalaire.html("<span style='color:red'>Le salaire doit être un nombre</span>");
    return false;
} else if (salaireInput <= 0) {
    erreurSalaire.html("<span style='color:red'>Le salaire doit être positif</span>");
    return false;
} else {
    erreurSalaire.html("");
    return true;
}
}
function validerLocalisation() {
var localisationInput = $("#localOffre").val();
var erreurLocalisation = $("#localOffreError");

if (localisationInput.trim() === "") {
    erreurLocalisation.html("<span style='color:red'>La localisation est requise</span>");
    return false;
} else if (!/^[A-Za-z\s]+$/.test(localisationInput)) {
    erreurLocalisation.html("<span style='color:red'>La localisation ne doit contenir que des lettres et des espaces</span>");
    return false;
} else {
    erreurLocalisation.html("");
    return true;
}
}


function validerDateExpiration() {
var dateExpirationInput = $("#dateEx_offre").val();
var erreurDateExpiration = $("#dateEx_offreError");

if (dateExpirationInput.trim() === "") {
    erreurDateExpiration.html("<span style='color:red'>La date d'expiration est requise</span>");
    return false;
}

// Convertir la date d'expiration en objet Date
var dateExpiration = new Date(dateExpirationInput);

// Obtenir la date d'aujourd'hui
var dateAujourdhui = new Date();

if (dateExpiration <= dateAujourdhui) {
    erreurDateExpiration.html("<span style='color:red'>La date d'expiration doit être ultérieure à la date d'aujourd'hui</span>");
    return false;
} else {
    erreurDateExpiration.html("");
    return true;
}
}

function validerNbPostes() {
var nbPostesInput = $("#nbPostes").val();
var erreurNbPostes = $("#nbPostesError");

if (nbPostesInput.trim() === "") {
    erreurNbPostes.html("<span style='color:red'>Le nombre de postes est requis</span>");
    return false;
} else if (parseInt(nbPostesInput) <= 0) {
    erreurNbPostes.html("<span style='color:red'>Le nombre de postes doit être positif</span>");
    return false;
} else {
    erreurNbPostes.html("");
    return true;
}
}

function validerMotCle() {
var motCleInput = $("#cleOffre").val();
var erreurMotCle = $("#cleOffreError");

if (motCleInput.trim() === "") {
    erreurMotCle.html("<span style='color:red'>Le champ mot-clé est requis</span>");
    return false;
} else if (!/^[A-Za-z]+$/.test(motCleInput)) {
    erreurMotCle.html("<span style='color:red'>Le mot-clé ne doit contenir que des lettres</span>");
    return false;
} else {
    erreurMotCle.html("");
    return true;
}
}

function validerCompetences() {
var competencesInput = $("#compOffre");
var erreurCompetences = $("#compOffreError");
var regex = /^[A-Za-z\s]+$/; // Expression régulière pour les chaînes de caractères

if (competencesInput.val().trim() === "") {
    erreurCompetences.html("<span style='color:red'>Les compétences sont requises</span>");
    competencesInput.addClass("erreur-input"); // Ajouter la classe en cas d'erreur
    return false;
} else if (!regex.test(competencesInput.val())) {
    erreurCompetences.html("<span style='color:red'>Les compétences ne doivent contenir que des lettres</span>");
    competencesInput.addClass("erreur-input"); // Ajouter la classe en cas d'erreur
    return false;
} else {
    erreurCompetences.html("");
    competencesInput.removeClass("erreur-input"); // Retirer la classe si tout est valide
    return true;
}
}




// Ajoutez d'autres fonctions de validation pour les autres champs ici
});