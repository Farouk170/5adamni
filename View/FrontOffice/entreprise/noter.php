<?php

include "../../../Controller/NoteC.php";
include_once '../../../Model/Note.php';

$noteC = new NoteC();
if (isset($_POST["note"]))
   { 
  $idUser=4;
  $note = new Note(1,$_POST["note"],$_GET['id'],$idUser);
  $noteC->Noter($note);
  header("Location: listeReclamation.php");
}
?>