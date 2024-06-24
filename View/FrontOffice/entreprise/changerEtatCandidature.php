<?php
// Inclure le fichier contenant votre classe OffreC
include '../../../Controller/OffreC.php';

// Vérifier si les paramètres d'URL nécessaires sont présents
if (isset($_GET['idCandidature']) && isset($_GET['action'])) {
    // Récupérer l'identifiant de la candidature et l'action à effectuer depuis les paramètres d'URL
    $idCandidature = $_GET['idCandidature'];
    $action = $_GET['action'];

    // Créer une instance de votre classe OffreC
    $offreC = new OffreC();

    // Définir le nouvel état en fonction de l'action
    $nouvelEtat = ($action === "accepter") ? "accepté" : "refusé";

    // Appeler la méthode pour mettre à jour l'état de la candidature
    $offreC->mettreAJourEtatCandidature($idCandidature, $nouvelEtat);

    // Vérifier si $_SERVER['HTTP_REFERER'] est défini avant de rediriger
    if(isset($_SERVER['HTTP_REFERER'])) {
        // Rediriger l'utilisateur vers la page précédente
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        // Rediriger vers une page par défaut si $_SERVER['HTTP_REFERER'] n'est pas défini
        header("Location: afficherCand.php"); // Remplacez "index.php" par l'URL de la page par défaut
        exit;
    }
} else {
    // Paramètres d'URL manquants
    echo "Paramètres d'URL manquants.";
}
?>
