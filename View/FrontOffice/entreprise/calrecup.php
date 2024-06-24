<?php
// Inclure les fichiers nécessaires et la classe EntretienController
include_once '../../../Controller/EntretienController.php';
require_once __DIR__ . "/../../../Model/ClassEntretien.php";
include_once '../../../Controller/TypeController.php';
require_once __DIR__ . "/../../../Model/ClassType.php";
$entretienController = new EntretienController();
$entretiens = $entretienController->getAllEntretiens();
$events = array();
foreach ($entretiens as $entretien) {
    $date = date('Y-m-d', strtotime($entretien['date_heure']));
    $heure = date('H :i', strtotime($entretien['date_heure']));
    $event = '<u style="text-decoration:none;">Heure: </u>  ' . $heure . '<br>' . '<u style="text-decoration:none;">Type:</u>  ' . $entretien['type_entretien'] . '<br>' . '<u style="text-decoration:none;">Candidat:</u>  ' . $entretien['nom'] . '<br>' . '<u style="text-decoration:none;">Offre:</u>  ' . $entretien['titreOffre'];
    $events[$date][] = $event;
}
echo json_encode($events);

?>
