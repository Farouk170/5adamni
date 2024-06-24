<!doctype html>
<html lang="en">
  <head>
    <link href="logo-mini.svg" rel="icon">
    <title>5adamni</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">   
    <?php
        require_once "../../Controller/UserController.php";
        session_start();
        if(isset($_SESSION['id'])){
            if(isset($_POST['pwd']) && isset($_POST['conf_pwd'])){
                if($_POST['pwd']==$_POST['conf_pwd']){
                    $usrc=new UserC();
                    if($usrc->setPwdbyId($_SESSION['id'],$_POST['pwd'])){
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
  <body id="top">

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
    

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    

    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.php"><img src="logo.svg"></a></div>
        </div>
      </div>
    </header>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <div class="block">
              <h2 class="mb-4">Changer votre mot de passe</h2>
              <form onsubmit="return verif_coord();" action="" method="post"
              <div class="rounded p-4 p-sm-5 my-4 mx-3" style="border: 1px solid grey;">
                  <div class="form-floating mb-4">
                      <label for="floatingPassword">Mot de passe</label>
                      <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Mot de passe">
                      <p id="err_pwd"></p>
                  </div>
                  <div class="form-floating mb-4">
                      <label for="floatingPassword">Confirmer votre mot de passe</label>
                      <input type="password" class="form-control" id="conf_pwd" name="conf_pwd" placeholder="Confirmer votre mot de passe">
                      <p id="err_conf_pwd"></p>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="showPassword">
                          <label class="form-check-label" for="exampleCheck1">Voir mot de passe</label>
                      </div>
                  </div>
                  <button type="submit" class="btn btn-primary py-3 w-100 mb-4 btn_signup">Changer le mot de passe</button>
                  <p class="text-center mb-0">Pas de compte? <a href="signup.php" style="text-decoration: none;">S'inscrire</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    
  
  </div>

    <!-- SCRIPTS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/stickyfill.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/quill.min.js"></script>
    
    
    <script src="js/bootstrap-select.min.js"></script>
    
    <script src="js/custom.js"></script>
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