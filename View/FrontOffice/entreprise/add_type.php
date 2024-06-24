<!doctype html>
<html lang="en">
  <head>
    <title>5adamni</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="../logo-mini.svg">
    
    <link rel="stylesheet" href="../css/custom-bs.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="../fonts/line-icons/style.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/animate.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <?php
      session_start();
      include '../../../Controller/OffreC.php';
      include '../../../Controller/UserController.php';
      include '../../../Model/offre.php';
      if(isset($_SESSION['idOffre'])){
        unset($_SESSION['idOffre']);
      }
      if(!isset($_SESSION['id'])) {
          header("location: ../login.php");
          exit;
      }
      else{
          $usrc=new UserC();
          $user=$usrc->GetUserById($_SESSION['id']);
          echo '<script>';
          echo 'document.addEventListener("DOMContentLoaded", function() {';
          echo '    var prenom = "' . htmlspecialchars($_SESSION['prenom']) . '";';
          echo '    var users = document.getElementsByClassName("user");';
          echo '    for (var i = 0; i < users.length; i++) {';
          echo '        users[i].textContent = prenom;';
          echo '    }';
          echo '});';
          echo '</script>';
      }
    ?>
    <style>
      .sticky-top {
        position: -webkit-sticky;
        position: sticky;
        left: 95%;
        top: 85%;
        width: 50px;
        height: 50px;
        background-color: #EB1616;
        text-align: center;
        border-radius: 50%;
      }
      .sticky-top a{
        padding: 10px 0 0 0;
        color: rgb(255, 255, 255);
      }
      .sticky-top a:hover{
        color: #be9d9d;
      }
      .sticky-robot {
        position: -webkit-sticky;
        position: sticky;
        left: 91%;
        top: 85%;
        width: 50px;
        height: 50px;
        background-color: #EB1616;
        text-align: center;
        border-radius: 50%;
      }
      .sticky-robot a{
        padding: 10px 0 0 0;
        color: rgb(255, 255, 255);
      }
      .sticky-robot a:hover{
        color: #be9d9d;
      }
      .table-container {
        margin-top: 100px; 
        margin-bottom: 100px;
      }
      .btn.btn-outline-cancelled {
        background: #FFC300;
        border-width: 2px;
        border-color: #fff;
        color: black; 
        border-radius: 5px;
      }
      
      .btn.btn-outline-cancelled:hover {
        background: #FFC300;
        color: white; }

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
    </div> 
    <!-- .site-mobile-menu -->

    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.php"><img src="logo.svg"></a></div>
          <nav class="mx-auto site-navigation col-6">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a></a></li>
              <li><a href="">Offres</a></li>
              <li><a></a></li>
              <li class="has-children">
                <a>Réclamations</a>
                <ul class="dropdown">
                  <li><a href="reclamationIndex.php">Consulter réclamations</a></li>
                </ul>
              </li>
              <li><a></a></li>
              <li class="has-children">
                <a href="entretiens_c.php" class="nav-link active">Entretiens</a>
                <ul class="dropdown">
                  <li><a href="entretiens_e.php">Entretiens organisés</a></li>
                  <li><a href="type_entretien.php">Types entretiens</a></li>
                </ul>
              </li>
              <li><a></a></li>
            </ul>
          </nav>
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
          <?php require_once "../../../Controller/chatbotFront.php";?>
            <div class="ml-auto">
                <div class="user_img" >
                  <img class="image" src="data:image/png;base64,<?php if (isset($user['image'])){echo base64_encode($user['image']);} ?>" alt="Image de l'utilisateur">
                </div>
                <div class="dropdowns">
                  <a href="#" class="aaaaaa user" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
                  <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item profile-link" href="  profile.php">Profile</a></li>
                    <li><a class="dropdown-item logout-link" href="../logout.php">Log Out</a></li>
                  </ul>
                  <span class="material-symbols-outlined span">arrow_drop_down</span>
                </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- HOME -->
    <section class="home-section section-hero overlay bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-12">
        <div class="mb-5 text-center">

        <!-- Sale & Revenue Start -->

        <div class="container-fluid pt-4 px-4">
            <div class="bg-white text-center rounded p-4">
              <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">Ajouter un type</h4>
              </div>
              <div class="table-responsive">
                <div class="bg-white rounded h-100 p-4">
                  <form method="POST" action="traitement_add_type.php" onsubmit="return validateForm()">
                    <div class="mb-3">
                      <label for="date_heure" class="form-label">Nom du nouveau type</label>
                      <input type="text" class="form-control center-input" id="type" name="type" maxlength="50" placeholder="Entretien RH">
                    </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">Description du type</label>
                      <input type="text" class="form-control center-input" id="description" name="description" placeholder="Phase finale de candidature" maxlength="255">
                      <div id="description_help" class="form-text">Note : Attention à la longueur (max 255).</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <button type="button" class="btn btn-outline-cancelled" onclick="annuler()">Annuler</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    <!--footer-->

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
            <p class="copyright"><small>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Developed by <a href="https://ByteQuest.tn" target="_blank" >ByteQuest</a></small></p>
          </div>
        </div>
      </div>
    </footer>
  
  </div>

    <!-- SCRIPTS -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/isotope.pkgd.min.js"></script>
    <script src="../js/stickyfill.min.js"></script>
    <script src="../js/jquery.fancybox.min.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    
    <script src="../js/jquery.waypoints.min.js"></script>
    <script src="../js/jquery.animateNumber.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    
    <script src="../js/bootstrap-select.min.js"></script>
    
    <script src="../js/custom.js"></script>
    <script>
      function annuler() {
        window.location.href = "type_entretien.php"; 
      }

      function validateForm() {
        var typeInput = document.getElementById('type');
        var descriptionInput = document.getElementById('description');
        
        //condition1
        if (typeInput.value.trim() === '' || descriptionInput.value.trim() === '') {
            alert("Tous les champs doivent être remplis.");
            return false;
        }

        // condition2 même si le html s'en occupe déjà
        if (typeInput.value.trim().length > 50) {
            alert("Le champ 'Type' ne doit pas dépasser 50 caractères.");
            return false;
        }

        //condition3 idem
        if (descriptionInput.value.trim().length > 255) {
            alert("Le champ 'Description' ne doit pas dépasser 255 caractères.");
            return false;
        }

        return true;
      }


      function getCurrentDateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = (now.getMonth() + 1).toString().padStart(2, '0'); 
        var day = now.getDate().toString().padStart(2, '0'); 
        var hours = now.getHours().toString().padStart(2, '0'); 
        var minutes = now.getMinutes().toString().padStart(2, '0'); 
        var formattedDateTime = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
        // Retourne la date et l'heure 
        return formattedDateTime;
      }

      // Préremplir l'entrée datetime-local avec les bons infos
      document.getElementById('date_heure').value = getCurrentDateTime();
      </script>
     
  </body>
</html>