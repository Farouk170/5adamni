<?php
    require_once "../../config/connexion.php";
    $pdo = openDB();
    $login = $_GET["gmail"];
    $query = $pdo->prepare("SELECT * FROM USERS WHERE email=?");
    $query->bindValue(1, $login, PDO::PARAM_STR);
    $query->execute();
    $rows = $query->fetch();
    $hashed_pwd = $rows['pwd'];
    if($rows['ban'] != 0) {
        session_start();
        $_SESSION['login_error'] = "Tu as été banni pour " . $rows['ban'] . " Jours !!!";
        echo '<script>window.location.href = "login.php";</script>';
    } else {
        session_start();
        $_SESSION['prenom'] = $rows['prenom'];
        $_SESSION['id'] = $rows['id'];
        if($rows['role'] == "Admin") {
            echo '<script>window.location.href = "../BackOffice/index.php";</script>';
            exit;
        } else {
            if($rows['role'] == "Postulant") {
                echo '<script>window.location.href = "../../View/FrontOffice/postulant";</script>';
                exit;
            } else {
                echo '<script>window.location.href = "../../View/FrontOffice/entreprise";</script>';
                exit;
            }
        }
    }
?>