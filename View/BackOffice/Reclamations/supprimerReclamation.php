<?php

include '../../../Controller/ReclamationC.php';
include '../../../Model/reclamation.php';

$reclamationc=new ReclamationC();
$reclamationc->supprimerReclamation($_GET["idRec"]);

header('Location:reclamations.php');

?>