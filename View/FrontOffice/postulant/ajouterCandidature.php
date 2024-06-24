<?php 
include '../../../Controller/OffreC.php';
include '../../../Model/offre.php';
include '../../../Model/candidature.php';
session_start();
include '../../../Controller/UserController.php';
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
    

$s = 0;

if (
    isset($_POST['idOffre']) &&
    isset($_FILES["cvOffre"]) &&
    isset($_POST['dateCandidature'])
) {
    $idOffre = $_POST['idOffre'];
    $fileTmpPath = $_FILES["cvOffre"]["tmp_name"];
    $fileContent = file_get_contents($fileTmpPath);
    $idUser=4;//insert the uder id here
    $candidature = new candidature(
        $_POST['dateCandidature'],
        $fileContent,
        $idOffre,
        $_SESSION['id']
    );
    $s = 1;
}
if(isset($_POST['idOffre'])) {
    $idOffre = $_POST['idOffre'];
    // Debugging statement
    //echo "Received ID: " . $idOffre;
} else {
    echo "ID not received!";
}
?>


<?php
// Check if the form is submitted and process accordingly
if($s == 1) {
    $offrec = new OffreC();
    $offrec->ajouterCandidature($candidature);
    $offrec->incrementerScoreOffre($_POST['idOffre']);
    //$offrec->listeOffres();
    header('Location:afficherCand.php');
    exit;
}
?>


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
    <link rel="stylesheet" href="../fonts/line-icons/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/animate.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">  
    <style>
  form {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  }
  h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
  }
  input[type="text"],
  input[type="number"],
  textarea,
  select {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
      margin-bottom: 20px;
      font-size: 16px;
  }
  input[type="file"] {
      width: calc(100% - 24px);
  }
  textarea {
      resize: vertical;
      min-height: 100px;
  }
  input[type="submit"],
  input[type="reset"] {
      width: 48%;
      padding: 15px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s;
      margin-right: 2%;
  }
  input[type="reset"] {
      background-color: #f44336; /* Rouge */
  }
 
  input[type="submit"]:hover,
  input[type="reset"]:hover {
      background-color: #45a049;
  }
  .form-group {
      margin-bottom: 20px;
  }
  .form-group label {
      font-weight: bold;
  }
  .form-group input[type="file"] {
      margin-top: 6px;
  }
  .form-group select {
      width: 100%;
      padding: 10px;
  }
  .form-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
  }
  .form-row .form-group {
      width: calc(48% - 10px);
  }
  #statutOffre{
      border-color: green;
      border-width: 2px; /* Épaisseur de la bordure */
      border-style: solid; /* Style de la bordure */
      background-color: grey;
  }
  #dateP_offre {
      border-color: green;
      border-width: 2px; /* Épaisseur de la bordure */
      border-style: solid; /* Style de la bordure */
      background-color: grey;
  }
  .erreur-input {
      border-color: red !important; /* Couleur de la bordure en rouge */
      /* Autres styles pour les inputs en erreur */
  }
  .error-message {
color: red;
font-size: 14px;
margin-top: 5px;
}
.user-wrapper {
        display: flex;
        align-items: center;
        position: relative;
      }

      .user-dropdown {
        position: absolute;
        top: calc(100% + 5px);
        right: -40px;
        top: 10px;
        z-index: 1;
        text-decoration: none;
        color: #fff;
      }
      .user-wrapper:hover .user-dropdown {
        display: block;
        background-color: #be9d9d;
        text-decoration: none;
      }
      .userImg {
        max-width: 60px;
        max-height: 60px;
        padding-right: 10px;
      }
      .user-dropdown a {
        color: #ffffff80;
        text-decoration: none;
      }
      .user-dropdown a:hover{
        color: #fff;
        text-decoration: none;
      }
      .user-dropdown .profile-link,
      .user-dropdown .logout-link {
          color: #000;
          text-decoration: none;
      }
      .user-dropdown .profile-link:hover,
      .user-dropdown .logout-link:hover {
          color: black;
      }.user-dropdown .profile-link:active,
      .user-dropdown .logout-link:active {
          color: white;
      }
      .user-dropdown .dropdown-menu{
        width: 120px;
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

          <nav class="mx-auto site-navigation col-6">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="index.php" class="nav-link active">Offres</a></li>
              <li class="has-children"><a class="nav-link">Compétences</a>
                <ul class="dropdown">
                  <li>
                    <a href="cv/education-page.php" style="display: flex; align-items: center;">
                      <img src="edu_svg.svg" style="width: 20px; height: 20px; margin-right: 5px;">
                      Educations
                    </a>
                  </li>
                  <li>
                    <a href="cv/experience-page.php" style="display: flex; align-items: center;">
                      <img src="exp_svg.svg" style="width: 20px; height: 20px; margin-right: 5px;">
                      Experiences
                    </a>
                  </li>
                  <li>
                    <a onclick="openPDF()" style="display: flex; align-items: center;">
                      <img src="pdf_svg.svg" style="width: 20px; height: 20px; margin-right: 5px;">
                      CV vers PDF
                    </a>
                  </li>
                    <script>
                      function openPDF() {
                        window.open('cv/pdf_export.php', '_blank');
                      }
                    </script>
                </ul>
              </li>
              <li class="has-children">
                <a>Réclamations</a>
                <ul class="dropdown">
                  <li><a href="reclamationIndex.php">Consulter réclamations</a></li>
                </ul>
              </li>
              <li>
                <a href="entretiens_c.php">Entretiens organisés</a>
              </li>
              <li><a href="../posts/">Forum</a></li>
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
              <h1 class="text-white font-weight-bold">La meilleure façon de décrocher le job de vos rêves</h1>
              <p>Bienvenue sur un site de recherche d'emploi que vous admirerez.</p>
            </div>
          </div>
        </div>
      </div>

      <a href="#next" class="scroll-button smoothscroll">
        <span class=" icon-keyboard_arrow_down"></span>
      </a>

    </section>
    
    <section class="py-5 bg-image overlay-primary fixed overlay" id="next" style="background-image: url('../images/hero_1.jpg');">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2 text-white">Statistiques de notre Site</h2>
            <p class="lead text-white">Veuillez trouver les détails ci-dessous.</p>
          </div>
        </div>
        <div class="row pb-0 block__19738 section-counter">

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="50">0</strong>
            </div>
            <span class="caption">Candidats</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
            <strong class="number" data-number="100">0</strong>
            </div>
            <span class="caption">Offres déposées</span>
          </div>
          

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="50">0</strong>
            </div>
            <span class="caption">Offres Remplies</span>
          </div>

          <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
            <div class="d-flex align-items-center justify-content-center mb-2">
              <strong class="number" data-number="100">0</strong>
            </div>
            <span class="caption">Entreprises</span>
          </div>
        </div>
      </div>
    </section>
    <section class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-2">Bonjour Monsieur <?php echo $_SESSION['prenom']?></h2>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-6">
                <a href="index.php"  class="btn btn-block btn-light btn-md" style="border: 1px solid #000;"><span class="icon-open_in_new mr-2"></span>liste </a>
              </div>
            </div>
          </div>
        </div>
        <ul class="job-listings mb-5">
            <form id="candidatureForm" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <h1>Déposer votre caandidature   </h1>
                <div class="form-group">
                    <label for="cvOffre">cvOffre (PDF uniquement)</label>
                    <input type="file" id="cvOffre" name="cvOffre" accept=".pdf" onchange="document.getElementById('cvError').innerText = '';">
                    <span id="cvError" style="color: red;" class="error-message"></span>
                </div>
                <div class="form-row">
                    <div class="form-group">
                      <input type="text" name="idOffre" id="idOffre" value="<?php echo isset($idOffre) ? $idOffre : ''; ?>" readonly hidden>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" name="dateCandidature" id="dateCandidature" readonly value="<?php echo date('Y-m-d'); ?>" hidden>
                    </div>
                </div>
                <div class="form-row">
                    <input type="submit" value="Submit">
                    <input type="reset" value="Reset">
                </div>
            </form>
            
            
            
          

          
        </ul>

      

      </div>
    </section>

    <section class="py-5 bg-image overlay-primary fixed overlay" style="background-image: url('../images/hero_1.jpg');">
      <div class="container">
        <div class="row align-items-center">
        </div>
      </div>
    </section>

    
    <section class="site-section py-4">
      <div class="container">
  
        <div class="row align-items-center">
          <div class="col-12 text-center mt-4 mb-5">
            <div class="row justify-content-center">
              <div class="col-md-7">
                <h2 class="section-title mb-2">Entreprises populaires dans notre site</h2>
                <p class="lead">Nous sommes honorés de présenter nos clients fréquents</p>
              </div>
            </div>
            
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="../images/logo_mailchimp.svg" alt="Image" class="img-fluid logo-1">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="../images/logo_paypal.svg" alt="Image" class="img-fluid logo-2">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="../images/logo_stripe.svg" alt="Image" class="img-fluid logo-3">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="../images/logo_visa.svg" alt="Image" class="img-fluid logo-4">
          </div>

          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="../images/logo_apple.svg" alt="Image" class="img-fluid logo-5">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="../images/logo_tinder.svg" alt="Image" class="img-fluid logo-6">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="../images/logo_sony.svg" alt="Image" class="img-fluid logo-7">
          </div>
          <div class="col-6 col-lg-3 col-md-6 text-center">
            <img src="../images/logo_airbnb.svg" alt="Image" class="img-fluid logo-8">
          </div>
        </div>
      </div>
    </section>


    <section class="bg-light pt-5 testimony-full">
        
        <div class="owl-carousel single-carousel">

        
          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p> 5adamni a révolutionné ma façon de chercher du travail ! Grâce à leur plateforme conviviale et efficace, j'ai rapidement trouvé l'emploi parfait pour moi. Merci de m'avoir permis de faire vivre ma famille ! </p>
                  <p><cite> &mdash; Corey Woods, @Microsoft</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="../images/person_transparent_2.png" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-lg-6 align-self-center text-center text-lg-left">
                <blockquote>
                  <p> Je suis reconnaissant envers 5adamni pour m'avoir aidé à trouver un travail qui me passionne vraiment. Leur site est facile à utiliser et m'a permis de me connecter avec des employeurs qui apprécient mes compétences. Merci pour cette opportunité unique ! </p>
                  <p><cite> &mdash; Chris Peters, @Google</cite></p>
                </blockquote>
              </div>
              <div class="col-lg-6 align-self-end text-center text-lg-right">
                <img src="../images/person_transparent.png" alt="Image" class="img-fluid mb-0">
              </div>
            </div>
          </div>

      </div>

    </section>

    <section class="pt-5 bg-image overlay-primary fixed overlay" style="background-image: url('../images/hero_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-md-6 align-self-center text-center text-md-left mb-5 mb-md-0">
            <h2 class="text-white">Contactez-nous</h2>
            <p class="mb-5 lead text-white">Contactez-nous en un seul clic.</p>
            <p class="mb-0">
              <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-apple mr-3"></span>App Store</a>
              <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-android mr-3"></span>Play Store</a>
            </p>
          </div>
          <div class="col-md-6 ml-auto align-self-end">
            <img src="../images/app.png" alt="Free Website Template by Free-Template.co" class="img-fluid">
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
            <h3>Contactez-nous</h3>
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

     
  </body>

  <script>
    // Fonction pour valider le formulaire avant la soumission
    function validateForm() {
        var cvOffre = document.getElementById('cvOffre').files[0];
        var cvError = document.getElementById('cvError');

        // Vérifier si le champ du fichier est vide
        if (!cvOffre) {
            cvError.innerText = "Veuillez sélectionner un fichier CV.";
            return false; // Empêcher la soumission du formulaire
        }
        return true; // Autoriser la soumission du formulaire si tout est valide
    }
</script>
</html>