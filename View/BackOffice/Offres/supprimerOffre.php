<?php

include '../../../Controller/OffreC.php';
include '../../../Model/offre.php';

$offrec=new OffreC();
$offrec->supprimerOffre($_GET["idOffre"]);

header('Location:ListeOffres.php');

?>