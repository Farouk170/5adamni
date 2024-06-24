<?php
// Inclure les fichiers nécessaires
include '../../../Controller/ReponseC.php';

// Vérifier si les paramètres sont fournis
if (isset($_GET['titleRec']) && isset($_GET['categorieRec'])) {
    $titleRec = $_GET['titleRec'];
    $categorieRec = $_GET['categorieRec'];
    
    // Obtenir les suggestions de réponses de la base de données
    $reponseC = new ReponseC();
    $suggestions = $reponseC->getSuggestionsByTitleAndCategory($titleRec, $categorieRec);
    
    // Renvoie les suggestions sous forme de JSON
    echo json_encode(['suggestions' => $suggestions]);
} else {
    echo json_encode(['suggestions' => []]);
}
?>
