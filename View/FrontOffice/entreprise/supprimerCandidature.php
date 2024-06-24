<?php

include '../../../Controller/OffreC.php';
include '../../../Model/offre.php';

$offrec=new OffreC();
$offrec->supprimerCandidature($_GET["idCandidature"]);

header('Location:afficherCand.php');

?>