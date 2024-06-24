<?php
    session_start();
    unset($_SESSION['prenom']);
    session_destroy();
    header("location: login.php");
    exit;
?>