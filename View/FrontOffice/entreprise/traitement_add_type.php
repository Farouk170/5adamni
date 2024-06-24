<?php
include_once '../../../Controller/EntretienController.php';
require_once __DIR__ . "/../../../Model/ClassEntretien.php";
include_once '../../../Controller/TypeController.php';
require_once __DIR__ . "/../../../Model/ClassType.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST["type"];
    $description = $_POST["description"];

    try {
        $typeController = new TypeController();
        $success = $typeController->addType($type, $description);
        
        if ($success) {
            header("Location: type_entretien.php");
            exit(); 
        } else {
            echo json_encode(array("success" => false, "message" => "Erreur lors de l'ajout du type."));
        }
    } catch (PDOException $e) {
        echo json_encode(array("success" => false, "message" => "Erreur PDO : " . $e->getMessage()));
    }
}
?>