<?php
include_once '../../../Controller/EntretienController.php';
require_once __DIR__ . "/../../../Model/ClassEntretien.php";
include_once '../../../Controller/TypeController.php';
require_once __DIR__ . "/../../../Model/ClassType.php";


if(isset($_GET['date'])) {

    $inputDate = $_GET['date'];

    require_once __DIR__ . "/../../../Controller/EntretienController.php";


    $entretienController = new EntretienController();

    $entretiens = $entretienController->searchEntretiensByDate2($inputDate);

 
    echo json_encode($entretiens);
} 


if(isset($_GET['searchTerm'])) {

    $searchTerm = $_GET['searchTerm'];

    $entretienController = new EntretienController();

    $entretiens = $entretienController->filterEntretiensByOffreEntrepriseCandidat($searchTerm);
  
    echo json_encode($entretiens);
} 


if(isset($_GET['type'])) {

    $type = $_GET['type'];

    $entretienController = new EntretienController();

    $entretiens = $entretienController->filterEntretiensByType($type);

    echo json_encode($entretiens);
}



if (isset($_GET['statut'])) {
    $statut = $_GET['statut'];

    $entretienController = new EntretienController();

    if ($statut === "en_cours") {
        $entretiens = $entretienController->searchEntretiensByDate(date("Y-m-d"));
    } elseif ($statut === "effectue") {
        $entretiens = $entretienController->searchEntretiensByDate(date("Y-m-d"), true);
    }

    echo json_encode($entretiens);
}


?>
