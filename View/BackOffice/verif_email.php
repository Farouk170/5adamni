<?php
require_once "../../Controller/UserController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["email"])) {
        $email = $_POST["email"];
        $userController = new UserC();
        $user = $userController->SearchUserByEmail($email);
        echo json_encode($user);
    }
    else {
        echo json_encode(["error" => "Email parameter is missing"]);
    }
}
else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
