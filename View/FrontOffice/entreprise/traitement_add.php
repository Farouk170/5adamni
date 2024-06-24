<?php
require '../../../Controller/EntretienController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $date_heure = $_POST["date_heure"];
    $lien = $_POST["lien"];
    $offre_id = $_POST["idCandidature"];
    $id_te = $_POST["type_entretien"];

    $connexion = new PDO('mysql:host=localhost;dbname=5adamni', 'root', '');
    $requete2 = $connexion->prepare("SELECT * FROM candidature WHERE idCandidature = :idCandidature");
    $requete2->execute(array('idCandidature' => $offre_id));
    $candidature = $requete2->fetch(PDO::FETCH_ASSOC);

    // Vérifiez si la candidature a été trouvée
    if ($candidature) {
        $idUser = $candidature['idUser'];
        // Créez une instance du contrôleur d'entretien
        $entretienController = new EntretienController();

        // Appelez la méthode addEntretien pour ajouter l'entretien
        $result = $entretienController->addEntretien($date_heure, $lien, $offre_id, $id_te, $idUser, $_SESSION['id']);

        // Gérez le résultat en fonction de vos besoins
        if ($result) {
            // Succès
            header("Location: entretiens_e.php");
            exit();
        } else {
            // Erreur
            echo "Erreur lors de l'ajout de l'entretien.";
        }
    } else {
        // Candidature non trouvée
        echo "Candidature non trouvée.";
    }
}
?>
