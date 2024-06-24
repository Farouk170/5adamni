<?php
// Assurez-vous d'inclure le fichier config.php
require_once "../../../config/connexion.php";
include '../../../Controller/ReclamationC.php';
include '../../../Model/reclamation.php';
// Récupération des valeurs du formulaire
$idRec = $_POST['idRec'];
$archiveRec = $_POST['archiveRec'];

// Instanciez la classe de votre gestionnaire de réclamation (par exemple, ReclamationC)
$reclamationC = new ReclamationC();

// Appelez la fonction pour modifier le statut de la réclamation
$reclamationC->modifierEtatArchive($idRec, $archiveRec);

// Redirigez l'utilisateur vers la page souhaitée (par exemple, page des réclamations)
header('Location: listeReclamation.php');
exit;
?>
