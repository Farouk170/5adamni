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
        require_once "../../Controller/MailSender.php";
        session_start();
        $usrc = new UserC();
        $mailsender = new MailSender();
        if (isset($_POST["email"])) {
            if ($rows = $usrc->getId_PrenomByEmail($_POST["email"])) {
                $usrc=new UserC();
                $code = $usrc->generateCode();
                $_SESSION['code'] = $code;
                $_SESSION['id'] = $rows['id'];
                $date = new DateTime();
                $mailsender->ResetPassword($_POST["email"], $rows['prenom'], $date->format('Y-m-d H:i:s'), $code);
                echo '<script>window.location.href = "verify_code.php";</script>';
            } else {
                echo "<script>alert('User doesn\'t match any account!!');</script>";
            }
        }
    ?>
    <style>
        input[type="checkbox"]:checked {
            background-color: red;
            border-color: red;
            accent-color: red;
        }
    </style>
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
              <h2 class="mb-4">Choisir une méthode de vérification</h2>
                <div class="rounded p-4 p-sm-5 my-4 mx-3" style="border: 1px solid grey;">
                    <div class="form-floating mb-4">
                        <input type="checkbox" id="smsCheckbox" name="sms" placeholder="SMS">
                        <label for="smsCheckbox">SMS</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="checkbox" id="emailCheckbox" name="email" placeholder="Email">
                        <label for="emailCheckbox">Email</label>
                    </div>
                    <button id="nextButton" class="btn btn-primary py-3 w-100 mb-4 btn_signup" onclick="redirectToNext()">Suivant</button>
                    <p class="text-center mb-0">J'ai déja un compte? <a href="login.php" style="text-decoration: none;">Se connecter</a></p>
                </div>
                <script>
                    document.getElementById('nextButton').addEventListener('click', function(event) {
                        var smsCheckbox = document.getElementById('smsCheckbox');
                        var emailCheckbox = document.getElementById('emailCheckbox');
                        
                        if (smsCheckbox.checked && !emailCheckbox.checked) {
                            window.location.href = 'smsreset.php';
                        } else if (!smsCheckbox.checked && emailCheckbox.checked) {
                            window.location.href = 'reset_pass.php';
                        } else {
                            alert('Please choose a method.');
                            event.preventDefault(); 
                        }
                    });
                    const smsCheckbox = document.getElementById('smsCheckbox');
                    const emailCheckbox = document.getElementById('emailCheckbox');
                    smsCheckbox.addEventListener('change', function() {
                        if (this.checked) {
                            emailCheckbox.checked = false;
                        }
                    });

                    emailCheckbox.addEventListener('change', function() {
                        if (this.checked) {
                            smsCheckbox.checked = false;
                        }
                    });
                </script>
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
    <script src="login.js"></script>
   
   
     
  </body>
</html>