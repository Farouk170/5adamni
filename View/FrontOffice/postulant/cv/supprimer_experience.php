<?php
require_once "../../../../config/connexion.php";

if(isset($_GET['id_experience'])) {
    try {
        $conn = openDB();
        $stmt = $conn->prepare("DELETE FROM experience WHERE id_experience = :id_experience");
        $stmt->bindParam(':id_experience', $_GET['id_experience']);
        $stmt->execute();
        header("Location: experience-page.php");
        
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID parameter is missing.";
}
?>
