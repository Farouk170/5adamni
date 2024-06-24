<?php
require_once "../../../Controller/UserController.php";

try {
    $tel = $_COOKIE["tel"];
    $usrc = new UserC();
    $user = $usrc->GetUserByTel($tel);
} catch(PDOException $e) {
    echo 'error'.$e->getMessage();
}
$imageData = base64_encode($user['image']);
$imageUrl = 'data:image/jpeg;base64,'.$imageData;

$response = array(
    'prenom' => $user['prenom'],
    'nom' => $user['nom'],
    'tel' => $user['tel'],
    'role' => $user['role'],
    'image' => $imageUrl,
);

echo json_encode($response);
?>