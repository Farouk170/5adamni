<?php
require_once "../../../../config/connexion.php";

try {
    $conn = openDB();
} catch(PDOException $e) {
    echo "Error connecting to database: " . $e->getMessage();
    exit();
}

if(!isset($_GET['id_education'])) {
    echo "ID is not provided";
    exit();
}

$id_education = $_GET['id_education'];
try {
    $stmt = $conn->prepare("SELECT diplom_jpg FROM education WHERE id_education = :id_education");
    $stmt->bindParam(':id_education', $id_education);
    $stmt->execute();
    $imageData = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$imageData) {
        echo "Image not found";
        exit();
    }
    
    header("Content-type: image/jpeg");
    echo $imageData['diplom_jpg'];
} catch(PDOException $e) {
    echo "Error executing query: " . $e->getMessage();
    exit();
}
?>
