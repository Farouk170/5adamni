<?php
require_once "../../../../config/connexion.php";

if(isset($_GET['id_type_diplom'])) {
    try {
        $conn = openDB();
        $stmt = $conn->prepare("DELETE FROM type_diplom WHERE id_type_diplom = :id_type_diplom");
        $stmt->bindParam(':id_type_diplom', $_GET['id_type_diplom']);
        $stmt->execute();
        header("Location: affichage_diplom.php");
        
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID parameter is missing.";
}
?>
