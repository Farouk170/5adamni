<?php
require_once "../../../../config/connexion.php";
require_once __DIR__. "/../../../../Controller/CVC.php";
require_once "../../../../Controller/UserController.php";
session_start();
if(!isset($_SESSION['prenom'])) {
    
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
  if (isset($_GET['id_experience']) && !empty($_GET['id_experience'])) {
    $id_experience = $_GET['id_experience'];
    $poste = $_GET['poste'];
    $entreprise = $_GET['entreprise'];
    $date_exp = $_GET['date_exp'];
    $tache = $_GET['tache'];
  } else {
    echo "Error: Experience ID not found in URL.";
    exit;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
      $poste = $_POST['poste'];
      $entreprise = $_POST['entreprise'];
      $date_exp = $_POST['date_exp'] . "-01";
      $tache = $_POST['tache'];

      $experienceC = new experienceC();
      $experienceC->modifier_exp($id_experience, $poste, $entreprise, $date_exp, $tache);

      header('Location: experience-page.php');
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  if (!empty($date_exp)) {
    try {
      $dateObject = new DateTime($date_exp);
      $formatted_date = $dateObject->format('Y-m');
    } catch (Exception $e) {
      $formatted_date = "";
    }
  } else {
    $formatted_date = "";
  }

  try {
    $connDP = openDB();
    $queryDiplom = $connDP->prepare("SELECT * FROM type_diplom");
    $queryDiplom->execute();
    $resultDiplom = $queryDiplom->fetchAll();
    } catch (PDOException $e) {
        echo 'echec de connexion:' . $e->getMessage();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>5adamni</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="../../logo-mini.svg">
    
    <link rel="stylesheet" href="../../css/custom-bs.css">
    <link rel="stylesheet" href="../../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../../fonts/icomoon/style.css">
    <link rel="stylesheet" href="../../fonts/line-icons/style.css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/animate.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../../css/style.css">  
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
      .my-div{
        display: flex;
        align-items:center;
        justify-content: center;
      }
      .experienceform{
  display: block;
  align-items:center;
  justify-content: center;
  margin:auto;
  background-color: #fff;
  padding: 1rem;
  max-width: 900px;
  width: 900px;
  border-radius: 0.5rem;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      }
.form-row{
  display: flex;
  align-items:center;
  justify-content: center;
  background-color: #fff;
  padding: 1rem;
  max-width: 900px;
  width: 900px;
  border-radius: 0.5rem;
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
              <li><a href="../">Offres</a></li>
              <li class="has-children"><a href="#" class="nav-link active">Compétences</a>
                <ul class="dropdown">
                  <li>
                    <a href="education-page.php" style="display: flex; align-items: center;">
                      <img src="edu_svg.svg" style="width: 20px; height: 20px; margin-right: 5px;">
                      Educations
                    </a>
                  </li>
                  <li>
                    <a style="display: flex; align-items: center;">
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
                  <li><a href="../reclamationIndex.php">Consulter réclamations</a></li>
                </ul>
              </li>
              <li>
                <a href="../entretiens_c.php">Entretiens organisés</a>
              </li>
              <li><a href="../posts/">Forum</a></li>
            </ul>
          </nav>
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
          <?php require_once "../../../../Controller/chatbotFront.php";?>
            <div class="ml-auto">
                <div class="user_img" >
                <img class="image" src="data:image/png;base64,<?php if (isset($user['image'])){echo base64_encode($user['image']);} ?>" alt="Image de l'utilisateur">
                </div>
                <div class="dropdowns">
                  <a href="#" class="aaaaaa user" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
                  <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item profile-link" href="  ../profile.php">Profile</a></li>
                    <li><a class="dropdown-item logout-link" href="../../logout.php">Log Out</a></li>
                  </ul>
                  <span class="material-symbols-outlined span">arrow_drop_down</span>
                </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- HOME -->
    <section class="home-section section-hero overlay bg-image" style="background-image: url('../../images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
                            <!------------------------------------------------------------------>
            <br><br>
            <div class="my-div"></div>
            
    <form class="experienceform" id="experienceform" action="" method="POST" enctype="multipart/form-data">
    <h1 style="color: grey;">Modifier une Experience</h1>
    
            <label for="poste">Poste</label><br>
            <input type="text" name="poste" id="poste" value="<?php echo $poste;?>" ><br><br>
        
            <label for="entreprise">Entreprise</label><br>
            <input type="text" name="entreprise" id="entreprise" value="<?php echo $entreprise;?>"><br><br>
        
            <label for="date_exp">Date</label><br>
            <input type="month" name="date_exp" id="date_exp" value="<?php echo $formatted_date;?>"><br><br>
        
        <label for="tache">Details</label><br>
        <textarea id="tache" name="tache" rows="4" cols="50" placeholder="Veillez fournir des détails sur votre experience"><?php echo $tache;?></textarea><br><br>
    
    <input class="btn btn-primary rounded-pill m-2" type="submit" value="Mettre à jour"> <button type="button" class="btn btn-primary rounded-pill m-2" onclick="window.location.href='experience-page.php'" >Annuler</button><br>

    <div id="error-container" class="error-message"></div>
</form>

            
                            <!------------------------------------------------------------------>
            </div>
          </div>
        </div>
      </div>
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
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/isotope.pkgd.min.js"></script>
    <script src="../../js/stickyfill.min.js"></script>
    <script src="../../js/jquery.fancybox.min.js"></script>
    <script src="../../js/jquery.easing.1.3.js"></script>
    
    <script src="../../js/jquery.waypoints.min.js"></script>
    <script src="../../js/jquery.animateNumber.min.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    
    <script src="../../js/bootstrap-select.min.js"></script>
    
    <script src="../../js/custom.js"></script>
    <script>
    function openPDF() {
            window.open('pdf_export.php', '_blank');

    }
    document.addEventListener("DOMContentLoaded", function() {
        var experienceForm = document.getElementById("experienceform");
        var errorContainer = document.getElementById("error-container");

        experienceForm.addEventListener("submit", function(event) {
            var poste = document.getElementById("poste").value;
            var entreprise = document.getElementById("entreprise").value;
            var date_exp = document.getElementById("date_exp").value;
            var tache = document.getElementById("tache").value;

            errorContainer.innerHTML = "";

            if (poste.trim() === "") {
                displayError("Veuillez fournir votre poste");
                event.preventDefault(); 
            }
            if (entreprise.trim() === "") {
                displayError("Veuillez fournir l'entreprise");
                event.preventDefault(); 
            }
            if (date_exp.trim() === "") {
                displayError("Veuillez fournir une date");
                event.preventDefault(); 
            }
            if (tache.trim() === "") {
                displayError("Veuillez fournir des détails");
                event.preventDefault();
            }
        });
        experienceForm.addEventListener("button", function(event2){
            event2.preventDefault();
        });

        function displayError(message) {
            var errorMessage = document.createElement("p");
            errorMessage.textContent = message;
            errorMessage.style.color = "red";
            errorContainer.appendChild(errorMessage);
        }
    });
            document.addEventListener("DOMContentLoaded", function() {
        var today = new Date();
        var maxDate = new Date(today.getFullYear(), today.getMonth() + 0, 0); 
        var datePicker = document.getElementById("date_exp");

        datePicker.setAttribute("max", formatDate(maxDate)); 

        function formatDate(date) {
            var month = (date.getMonth() + 1 < 10 ? '0' : '') + (date.getMonth() + 1);
            return date.getFullYear() + '-' + month;
        }

        datePicker.addEventListener("change", function() {
            var selectedDate = new Date(this.value);
            if (selectedDate > maxDate) {
                alert("Veuillez sélectionner une date dans le mois précédent.");
                this.value = ''; 
            }
        });
    });
    </script>

     
  </body>
</html>