<?php
    // Enable error reporting and display errors
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Log errors to a file
    ini_set('log_errors', 1);
    ini_set('error_log', '/path/to/error.log');
    
    // Require necessary files
    require_once __DIR__ . '/../config/connexion.php';
    require_once __DIR__ . '/../Model/ClassUser.php';
    
    // Your other code goes here...
    
    class UserC{
        function AddUser(user $usr) {
            try {
                if(!empty($usr->get_cin()) && !empty($usr->get_nom()) && !empty($usr->get_prenom()) && !empty($usr->get_date()) && !empty($usr->get_email()) && !empty($usr->get_tel()) && !empty($usr->get_role()) && !empty($usr->get_pwd())) {
                    $pdo = openDB();
                    $hashed_pwd = password_hash($usr->get_pwd(), PASSWORD_BCRYPT);
                    echo "Original password: " . $usr->get_pwd() . "<br>";
                    echo "Hashed password: " . $hashed_pwd . "<br>";
                    $query = $pdo->prepare("INSERT into USERS(CIN,NOM,PRENOM,DATE_NAISSANCE,IMAGE,ROLE,EMAIL,TEL,PWD) VALUES(?,?,?,?,?,?,?,?,?)");
                    $query->bindValue(1, $usr->get_cin(), PDO::PARAM_INT);
                    $query->bindValue(2, $usr->get_nom(), PDO::PARAM_STR);
                    $query->bindValue(3, $usr->get_prenom(), PDO::PARAM_STR);
                    $query->bindValue(4, $usr->get_date(), PDO::PARAM_STR);
                    $image = $usr->get_image();
                    $query->bindValue(5, $image, PDO::PARAM_LOB);
                    $query->bindValue(6, $usr->get_role(), PDO::PARAM_STR);
                    $query->bindValue(7, $usr->get_email(), PDO::PARAM_STR);
                    $query->bindValue(8, $usr->get_tel(), PDO::PARAM_INT);
                    $query->bindValue(9, $hashed_pwd, PDO::PARAM_STR);
                    if($query->execute()) {
                        echo '<script>alert("Your account has been created successfully!!");</script>';
                        echo '<script>window.location.href = "login.php?' . $usr->get_pwd() . ' | ' . $hashed_pwd . '";</script>';
                    } else {
                        echo '<script>alert("User cannot be added!!");</script>';
                    }
                } else {
                    echo '<script>alert("Not set yet!!!");</script>';
                }
            } catch(PDOException $e) {
                echo "error: " . $e->getMessage();
            }
        }
        function ModifyUser($usr){
            $pdo=openDB();
            try{
                if(!empty($usr->get_cin()) && !empty($usr->get_nom()) && !empty($usr->get_prenom()) && !empty($usr->get_date()) && !empty($usr->get_email()) && !empty($usr->get_tel())){
                    $pdo=openDB();
                    $query=$pdo->prepare("UPDATE USERS set NOM=?,PRENOM=?,DATE_NAISSANCE=?,EMAIL=?,TEL=?,IMAGE=? where id=? ");
                    $query->bindValue(1, $usr->get_nom(), PDO::PARAM_STR);
                    $query->bindValue(2, $usr->get_prenom(), PDO::PARAM_STR);
                    $query->bindValue(3, $usr->get_date(), PDO::PARAM_STR);
                    $query->bindValue(4, $usr->get_email(), PDO::PARAM_STR);
                    $query->bindValue(5, $usr->get_tel(), PDO::PARAM_INT);
                    $image = $usr->get_image();
                    $query->bindValue(6, $image, PDO::PARAM_LOB);
                    $query->bindValue(7, $usr->get_id(), PDO::PARAM_INT);
                    if($query->execute()){
                        echo '<script>alert("Your account has been modified successsfully!!");</script>';
                        echo '<script>window.location.href = "index.php";</script>';
                    }
                    else{
                        echo '<script>alert("User can not be modified!!");</script>';
                    }
                }
                else{
                    echo '<script>alert("Not set yet!!!");</script>';
                }
            }
            catch(PDOException $e){
                echo "error: ". $e->getMessage();
            }
        }
        function DeleteUser($cin){
            if(isset($cin)){
                $pdo=openDB();
                if(UserC::SearchUser($cin)){
                    $query=$pdo->prepare("DELETE from USERS where cin=?");
                    $query->bindValue(1, $cin, PDO::PARAM_INT);
                    if($query->execute()){
                        echo '<script>alert("User deleted successfully ^_^ ");</script>';
                    }
                    echo '<script>window.location.href = "index.php";</script>';
                }
            }
            else{
                echo '<p>Error 404!!</p>';
            }
        }
        function SearchUser($cin){
            $pdo = openDB();
            $query = $pdo->prepare("SELECT * FROM USERS WHERE cin=?");
            $query->bindValue(1, $cin, PDO::PARAM_INT);
            $query->execute();
            if($query->rowCount() > 0){
                return true;
            }
            else{
                return false;
            }
        }
        function SearchUserByEmail($email){
            $pdo = openDB();
            $query = $pdo->prepare("SELECT * FROM USERS WHERE email=?");
            $query->bindValue(1, $email, PDO::PARAM_STR);
            $query->execute();
            if($query->rowCount() > 0){
                return true;
            }
            else{
                return false;
            }
        }
        function BanUser($cin,$duree){
            if(isset($cin)){
                $pdo=openDB();
                if(UserC::SearchUser($cin)){
                    $table=$pdo->prepare("SELECT ban FROM USERS WHERE cin=?");
                    $table->bindValue(1, $cin, PDO::PARAM_INT);
                    $table->execute();
                    if($rows=$table->fetch()){
                        $ban=$rows['ban'];
                        $query=$pdo->prepare("UPDATE USERS set BAN=? where cin=?");
                        $som=intval($duree)+$ban;
                        if($duree<0){
                            $som=$ban;
                        }
                        $query->bindValue(1, $som, PDO::PARAM_INT);
                        $query->bindValue(2, $cin, PDO::PARAM_INT);
                        if($query->execute()){
                            echo '<script>window.location.href = "index.php";</script>';
                            return true;
                        }
                        echo '<script>window.location.href = "../View/Users/index.php";</script>';
                    }
                }
            }
            return false;
        }
        function DecrementBans() {
            $pdo = openDB();
            $query = $pdo->prepare("UPDATE USERS SET ban = GREATEST(ban - 1, 0) WHERE ban > 0");
            $query->execute();
        }
        function login_backOffice($login, $pwd) {
            $pdo = openDB();
            $query = $pdo->prepare("SELECT * FROM USERS WHERE email=?");
            $query->bindValue(1, $login, PDO::PARAM_STR);
            $query->execute();
            $rows = $query->fetch();
            $hashed_pwd = $rows['pwd'];
            if(password_verify($pwd, $hashed_pwd)) {
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
            }
            else {
                session_start();
                $_SESSION['login_error'] = "Veuillez vérifier vos données";
                echo '<script>window.location.href = "../../View/FrontOffice/login.php";</script>';
                exit;
            }
        }
        function getImageById($id) {
            $pdo = openDB();
            $query = $pdo->prepare("SELECT image FROM USERS WHERE id=:id");
            $query->execute(['id'=> $id]);
            $rows=$query->fetch();
            return $rows['image'];
        }
        function getId_PrenomByEmail($email){
            $pdo = openDB();
            $query = $pdo->prepare("SELECT prenom,id FROM USERS WHERE email=:email");
            $query->execute(['email'=> $email]);
            return $query->fetch();
        }
        function getId_PrenomBynum($tel){
            $pdo = openDB();
            $query = $pdo->prepare("SELECT prenom,id FROM USERS WHERE tel=:tel");
            $query->execute(['tel'=> $tel]);
            return $query->fetch();
        }
        function setPwdbyId($id,$pwd){
            $pdo = openDB();
            $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT);
            $query = $pdo->prepare("UPDATE USERS set PWD=:PWD where id=:id");
            return $query->execute(['PWD'=> $hashed_pwd,'id'=>$id]);
        }
        function generateCode(){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = '';
            $length = 8;
        
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
        
            return $code;
        }
        function GetUserById($id){
            $pdo = openDB();
            try {
                $query = $pdo->prepare("SELECT * FROM USERS WHERE id=?");
                $query->bindValue(1, $id, PDO::PARAM_INT);
                $query->execute();
                $user = $query->fetch(PDO::FETCH_ASSOC);
                return $user ? $user : null;
            } catch (PDOException $e) {
                return null;
            }
        }    
        function GetUserByTel($tel){
            $pdo = openDB();
            try {
                $query = $pdo->prepare("SELECT * FROM USERS WHERE tel=?");
                $query->bindValue(1, $tel, PDO::PARAM_INT);
                $query->execute();
                $user = $query->fetch(PDO::FETCH_ASSOC);
                return $user ? $user : null;
            }
            catch (PDOException $e) {
                return null;
            }
        }
        function GetUserByEmail($email){
            $pdo = openDB();
            try {
                $query = $pdo->prepare("SELECT * FROM USERS WHERE email=?");
                $query->bindValue(1, $email, PDO::PARAM_STR);
                $query->execute();
                $user = $query->fetch(PDO::FETCH_ASSOC);
                return $user ? $user : null;
            }
            catch (PDOException $e) {
                return null;
            }
        } 
    }
?>