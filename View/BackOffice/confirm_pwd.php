<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="logo-mini.svg" rel="icon">
    <title>5adamni</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <?php
        require_once "../../Controller/UserController.php";
        session_start();
        if(isset($_SESSION['id'])){
            if(isset($_POST['pwd']) && isset($_POST['conf_pwd'])){
                if($_POST['pwd']==$_POST['conf_pwd']){
                    $usrc=new UserC();
                    if($usrc->setPwdbyId($_SESSION['id'],$_POST['pwd'])){
                        //echo "pwd updated successfully";
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);
                        $alertMessage = "Your password was successfully modified ^_^";
                        echo '<script>alert("' . $alertMessage . '");</script>';
                        unset($_SESSION['id']);
                        echo '<script>window.location.href = "login.php";</script>';
                        exit;
                    }
                    else{
                        echo "Error 404 !!";
                    }
                }
                else{
                    echo "Please verify your passwords";
                }
            }
        }
        else{
            echo '<script>window.location.href = "verify_code.php";</script>';
        }
    ?>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Log In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <form onsubmit="return verif_coord();" action="" method="post">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="../../FrontOffice/View/home.php" class="">
                                    <h3 class="text-primary"><img src="logo.svg"></h3>
                                </a>
                                <h5>Insert your password</h5>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="pwd" placeholder="" name="pwd">
                                <label for="floatingPassword">Password</label>
                                <p id="err_pwd"></p>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="conf_pwd" placeholder="" name="conf_pwd">
                                <label for="floatingPassword">Confirm Password</label>
                                <p id="err_conf_pwd"></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="showPassword">
                                    <label class="form-check-label" for="exampleCheck1">Show password</label>
                                </div>
                                <a href="reset_pass.php">Forget Password</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Change password</button>
                            <p class="text-center mb-0">Want to log in with password? <a href="login.php">Log In</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Log In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        function verif_pwd(){
            var req = document.getElementById('pwd');
            req.setAttribute('required', true);
            var st = document.getElementById('pwd').value;
            var pwd = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
            if(st.length<8){
            document.getElementById("pwd").style.borderColor = "red";
            document.getElementById("err_pwd").style.color = "red";
            document.getElementById("err_pwd").innerHTML = "Password must contain more than 8 characters";
            }
            else if(!st.match(pwd)){
            document.getElementById("pwd").style.borderColor = "red";
            document.getElementById("err_pwd").style.color = "red";
            document.getElementById("err_pwd").innerHTML = "Password must contain at least one upper caracter, one number and one lower caracter ";
            }
            else{
            document.getElementById("pwd").style.borderColor = "green";
            document.getElementById("err_pwd").style.color = "green";
            document.getElementById("err_pwd").innerHTML = "Correct";
            return true;
            }
            return false;
        }
        function verif_conf_pwd(){
            var req = document.getElementById('conf_pwd');
            req.setAttribute('required', true);
            var st = document.getElementById('conf_pwd').value;
            var pwd = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
            if(st.length<8){
            document.getElementById("conf_pwd").style.borderColor = "red";
            document.getElementById("err_conf_pwd").style.color = "red";
            document.getElementById("err_conf_pwd").innerHTML = "Password must contain more than 8 characters";
            }
            else if(!st.match(pwd)){
            document.getElementById("conf_pwd").style.borderColor = "red";
            document.getElementById("err_conf_pwd").style.color = "red";
            document.getElementById("err_conf_pwd").innerHTML = "Password must contain at least one upper caracter, one number and one lower caracter ";
            }
            else{
            document.getElementById("conf_pwd").style.borderColor = "green";
            document.getElementById("err_conf_pwd").style.color = "green";
            document.getElementById("err_conf_pwd").innerHTML = "Correct";
            return true;
            }
            return false;
        }
        function verif_coord(){
            return (verif_pwd() && verif_conf_pwd());
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('pwd').addEventListener('keyup', verif_pwd);
            document.getElementById('conf_pwd').addEventListener('keyup', verif_conf_pwd);
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('showPassword').addEventListener('change', function() {
                var passwordInput = document.getElementById('pwd');
                var conf_passwordInput = document.getElementById('conf_pwd');
                if (this.checked) {
                    passwordInput.type = 'text';
                    conf_passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                    conf_passwordInput.type = 'password';
                }
            });
        });
    </script>
</body>

</html>