<?php
    require_once "../../Controller/UserController.php";
    $usrc = new UserC();
    $usrc->DecrementBans();
?>