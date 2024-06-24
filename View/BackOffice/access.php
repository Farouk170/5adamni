<?php
    require_once "../../Controller/UserController.php";
    if(isset($_POST["email"]) && isset($_POST["pwd"])){
        $usrc = new UserC();
        $usrc->login_backOffice($_POST["email"],($_POST["pwd"]));
    }
?>