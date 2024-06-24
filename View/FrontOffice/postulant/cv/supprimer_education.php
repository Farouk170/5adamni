<?php
require_once "../../../../config/connexion.php";

if(isset($_GET['id_education'])) {
    try {
        $conn = openDB();
        $stmt = $conn->prepare("DELETE FROM education WHERE id_education = :id_education");
        $stmt->bindParam(':id_education', $_GET['id_education']);
        $stmt->execute();
        header("Location: education-page.php");
        
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID parameter is missing.";
}
?>
