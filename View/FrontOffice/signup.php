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
        $roles = [
            'Postulant' => 'Postulant',
            'Entreprise' => 'Entreprise',
            'Non-entreprise' => 'Non-entreprise'
        ];
        if(isset($_POST['cin']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date_naissance']) && isset($_POST['email']) && isset($_POST['tel']) && isset($_FILES['image']) && isset($_POST['role']) && isset($_POST['pwd']) && isset($_POST['conf_pwd'])){
            $cin = $_POST['cin'];
            $nom = $_POST['nom'];
            $pren = $_POST['prenom'];
            $date = $_POST['date_naissance'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $role = $_POST['role'];
            $pwd = $_POST['pwd'];
            $conf_pwd = $_POST['conf_pwd'];

            $fileTmpPath = $_FILES["image"]["tmp_name"];
            $fileContent = file_get_contents($fileTmpPath);
            if(!empty($cin) && !empty($nom) && !empty($pren) && !empty($date) && !empty($fileContent)  && !empty($email) && !empty($tel) && !empty($role) && !empty($pwd) && !empty($conf_pwd)){
                if($pwd!=$conf_pwd){
                    echo '<script>alert("Mot de passe ne correspond pas");</script>';
                }
                else{
                   
                    $usr = new user(null,$cin,$nom,$pren,$date,$email,$fileContent,$role,$tel,$pwd);
                    $usrc = new UserC();
                    $usrc->AddUser($usr);
                }
                
            }
            else
            echo "champ vide";
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
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">S'inscrire</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>S'inscrire</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5">
            <div class="block">
              <h2 class="mb-4">S'inscrire</h2>
              <form action="" onsubmit="return (executeRecaptcha(event) && valider_verif());" method="POST" enctype="multipart/form-data">
                  <div class="rounded p-4 p-sm-5 my-4 mx-3" style="border: 1px solid grey;">
                      <div class="form-floating mb-3">
                          <label for="floatingText">CIN</label>
                          <input type="number" class="form-control" id="cin" name="cin" placeholder="">
                          <p id="err_cin"></p>
                      </div>
                      <div class="form-floating mb-3">
                          <label for="floatingText">Nom</label>
                          <input type="text" class="form-control" id="nom" name="nom" placeholder="">
                          <p id="err_nom"></p>
                      </div>
                      <div class="form-floating mb-3">
                          <label for="floatingText">Prenom</label>
                          <input type="text" class="form-control" id="prenom" name="prenom" placeholder="">
                          <p id="err_prenom"></p>
                      </div>
                      <div class="form-floating mb-3">
                          <label for="floatingText">Date de naissance</label>
                          <input type="date" class="form-control" id="date_naissance" name="date_naissance" placeholder="">
                          <p id="err_date"></p>
                      </div>
                      <br>
                      <div class="form-floating mb-3">
                          <label for="image">Image</label>
                          <input type="file" class="" id="image" name="image" accept="image/*"  >
                      </div>
                      <label for="">Role</label>
                      <div class="form-floating mb-3" style="border: white;width:100px;">
                          <select id="role" name="role">
                              <?php foreach ($roles as $key => $value): ?>
                                  <option style="background-color: black;" class="form-control" value="<?php echo htmlspecialchars($key); ?>" <?php if(isset($_POST['role']) && $_POST['role'] == $key) echo 'selected'; ?>>
                                      <?php echo htmlspecialchars($value); ?>
                                  </option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                      <div class="form-floating mb-3">
                          <label for="floatingInput">Email address</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="">
                          <p id="err_email"></p>
                      </div>
                      <div class="form-floating mb-3">
                          <label for="floatingInput">Numero du Telephone</label>
                          <input type="number" class="form-control" id="tel" name="tel" placeholder="">
                          <p id="err_tel"></p>
                      </div>
                      <div class="form-floating mb-4">
                          <label for="floatingPassword">Mot de passe</label>
                          <input type="password" class="form-control" id="pwd" name="pwd" placeholder="">
                          <p id="err_pwd"></p>
                      </div>
                      <div class="form-floating mb-4">
                          <label for="floatingPassword">Confirmer le mot de passe</label>
                          <input type="password" class="form-control" id="conf_pwd" name="conf_pwd" placeholder="">
                          <p id="err_conf_pwd"></p>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-4">
                          <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="showPassword">
                              <label class="form-check-label" for="exampleCheck1">Voir mot de passe</label>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary py-3 w-100 mb-4 btn_signup">S'inscrire</button>
                      <p class="text-center mb-0">J'ai déja un compte ? <a href="login.php" style="text-decoration: none;">Se connecter</a></p>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <footer class="site-footer">

      <a href="#top" class="smoothscroll scroll-top">
        <span class="icon-keyboard_arrow_up"></span>
      </a>

      <div class="container">
        <div class="row mb-5">
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Search Trending</h3>
            <ul class="list-unstyled">
              <li><a href="#">Web Design</a></li>
              <li><a href="#">Graphic Design</a></li>
              <li><a href="#">Web Developers</a></li>
              <li><a href="#">Python</a></li>
              <li><a href="#">HTML5</a></li>
              <li><a href="#">CSS3</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Company</h3>
            <ul class="list-unstyled">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Career</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Resources</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Support</h3>
            <ul class="list-unstyled">
              <li><a href="#">Support</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-3 mb-4 mb-md-0">
            <h3>Contact Us</h3>
            <div class="footer-social">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-instagram"></span></a>
              <a href="#"><span class="icon-linkedin"></span></a>
            </div>
          </div>
        </div>

        <div class="row text-center">
          <div class="col-12">
            <p class="copyright"><small>Copyright ©<script>document.write(new Date().getFullYear());</script> All rights reserved | Developed by <a href="https://ByteQuest.tn" target="_blank">ByteQuest</a></small></p>
          </div>
        </div>
      </div>
    </footer>
  
  </div>

    <!-- SCRIPTS -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LfMFeMpAAAAAOJBsYMDD2t7zKVvi8cRflfJKPBc" async defer></script>
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
    <script src="signup.js"></script>
    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            document.getElementById("fileName").innerText = fileName;
        }
    </script>
    
    <script type="text/javascript">
      function executeRecaptcha(event) {
        event.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6LfMFeMpAAAAAOJBsYMDD2t7zKVvi8cRflfJKPBc', { action: 'login' }).then(function(token) {
            // Add the token to the form
            var recaptchaResponse = document.createElement('input');
            recaptchaResponse.setAttribute('type', 'hidden');
            recaptchaResponse.setAttribute('name', 'g-recaptcha-response');
            recaptchaResponse.setAttribute('value', token);
            document.getElementById('login-form').appendChild(recaptchaResponse);

            // Submit the form
            document.getElementById('login-form').submit();
          });
        });
      }
    </script>
   
   
     
  </body>
</html>