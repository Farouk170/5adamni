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
        session_start();
        if(isset($_SESSION['code'])){
            if(isset($_POST['code'])){
                if($_SESSION['code']==$_POST['code']){
                    unset($_SESSION['code']);
                    echo '<script>window.location.href = "confirm_pwd.php";</script>';
                }
                else{
                    echo '<script>alert("Code incorrect");</script>';
                }
            }
        }
        else{
            echo '<script>window.location.href = "reset_pass.php";</script>';
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
              <h2 class="mb-4">Insérer votre code</h2>
              <form onsubmit="return verif_coord();" action="" method="post"
                <div class="rounded p-4 p-sm-5 my-4 mx-3" style="border: 1px solid grey;">
                  <div class="form-floating mb-4">
                      <label for="floatingPassword">Code</label>
                      <input type="text" class="form-control" id="code" placeholder="Code" name="code">
                      <p id="err_code"></p>
                  </div>
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-4 btn_signup">Suivant</button>
                    <p class="text-center mb-0">J'ai déja un compte? <a href="login.php">Se connecter</a></p>
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
        function verif_code(){
        var req = document.getElementById('code');
        req.setAttribute('required', true);
        var st = document.getElementById('code').value;
        var cin = /^[0-9]+$/;
        if(st.length!=8){
        document.getElementById("code").style.borderColor = "red";
        document.getElementById("err_code").style.color = "red";
        document.getElementById("err_code").innerHTML = "Code must be of 8 characters";
        }
        else{
        document.getElementById("code").style.borderColor = "";
        document.getElementById("err_code").style.color = "";
        document.getElementById("err_code").innerHTML = "";
        return true;
        }
        return false;
    }
        function verif_coord(){
            return (verif_code());
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('code').addEventListener('keyup', verif_code);
        });
    </script>
   
   
     
  </body>
</html>