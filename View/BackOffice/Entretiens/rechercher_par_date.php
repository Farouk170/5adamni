<?php
include_once '../../../Controller/EntretienController.php';
require_once __DIR__ . "/../../../Model/ClassEntretien.php";
include_once '../../../Controller/TypeController.php';
require_once __DIR__ . "/../../../Model/ClassType.php";


// Vérifier si la date est fournie dans la requête
if(isset($_GET['date'])) {
    // Récupérer la date fournie
    $inputDate = $_GET['date'];

    // Inclure le fichier EntretienController
    require_once __DIR__ . "/../../../Controller/EntretienController.php";

    // Créer une instance de EntretienController
    $entretienController = new EntretienController();

    // Effectuer la recherche des entretiens par date
    $entretiens = $entretienController->searchEntretiensByDate2($inputDate);

    // Renvoyer le résultat de la requête SQL au format JSON
    echo json_encode($entretiens);
}

if(isset($_GET['searchTerm'])) {
    // Récupérer le terme de recherche fourni
    $searchTerm = $_GET['searchTerm'];

    // Créer une instance de EntretienController
    $entretienController = new EntretienController();

    // Effectuer la recherche des entretiens par entreprise ou candidat
    $entretiens = $entretienController->filterEntretiensByOffreEntrepriseCandidat($searchTerm);

    // Renvoyer le résultat de la requête SQL au format JSON
    echo json_encode($entretiens);
} 

if(isset($_GET['type'])) {

    $type = $_GET['type'];

    $entretienController = new EntretienController();

    $entretiens = $entretienController->filterEntretiensByType($type);

    echo json_encode($entretiens);
}
?>
