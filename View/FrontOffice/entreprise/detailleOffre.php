<?php
include '../../../Controller/OffreC.php';
include '../../../Model/offre.php';
session_start();
$offrec = new OffreC();
if(!isset($_SESSION["idOffre"])){
  $_SESSION["idOffre"] = isset($_POST['idOffre']) ? $_POST['idOffre'] : null;
}
$Offre = $offrec->details($_SESSION["idOffre"]);

?>
<!doctype html>
<html lang="en">
  <head>
    <title>5adamni</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="logo-mini.svg">
    
    
    <link rel="stylesheet" href="../css/custom-bs.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">
    <link rel="stylesheet" href="../fonts/line-icons/style.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/animate.min.css">
    <link rel="stylesheet" href="../css/quill.snow.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">   
    <?php
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
    ?>
    <style>
       .card-body{
        background-color: #fff;
       }
        .logo-img {
            max-width: 150px;
            max-height: 150px;
        }

        #map-container {
            position: relative;
            height: 400px; /* Ajuster la hauteur de la carte */
            width: 100%;
        }
        #map {
            height: 100%; /* Utiliser toute la hauteur disponible */
            width: 100%;
        }
        #location-input {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 999;
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
    
    <title>Carte des offres</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdhJsXjE5SLK_YQNFlODMTKwyhbwvNg2g&libraries=places"></script>
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
              <li><a href="" class="nav-link active">Offres</a></li>
              <li class="has-children">
                <a>Réclamations</a>
                <ul class="dropdown">
                  <li><a href="reclamationIndex.php">Consulter réclamations</a></li>
                </ul>
              </li>
              <li class="has-children">
                <a href="entretiens_c.php" class="nav-link active">Entretiens</a>
                <ul class="dropdown">
                  <li><a href="entretiens_e.php">Entretiens organisés</a></li>
                  <li><a href="type_entretien.php">Types entretiens</a></li>
                </ul>
              </li>
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
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Details offre</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Details offre</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container">

        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
              
              </div>
            </div>
          </div>
          
          <div id="map-container">
    <div id="map"></div>
    <div id="location-input">
        <input type="text" id="location" placeholder="Entrer une localisation" value="<?php echo htmlspecialchars($Offre['localOffre'] . ', Tunisie'); ?>">
        <button onclick="searchLocation()">Afficher sur la carte</button>
    </div>

          <div class="col-lg-4">
            <div class="row">
              <div class="col-6">
               
              </div>
              <div class="col-6">
            
              </div>
            </div>
          </div>
        </div>
        
        <div class="row mb-5">
          <div class="col-lg-12">
          <div class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0" style="color: #fff;">Détails de l'offre d'emploi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="data:image/png;base64,<?php echo base64_encode($Offre['logo']); ?>" alt="Logo de l'offre" class="img-fluid logo-img">
                    </div>
                    <div class="col-md-8">
                        <ul class="list-unstyled">
                            <li><strong>Titre de l'offre:</strong> <?php echo $Offre['titreOffre']; ?></li>
                            <li><strong>Description:</strong> <?php echo $Offre['descOffre']; ?></li>
                            <li><strong>Salaire:</strong> <?php echo $Offre['salaireOffre']; ?></li>
                            <li><strong>Type de contrat:</strong> <?php echo $Offre['typeContrat']; ?></li>
                            <li><strong>Localisation:</strong> <?php echo $Offre['localOffre']; ?></li>
                            <li><strong>Date de publication:</strong> <?php echo $Offre['dateP_offre']; ?></li>
                            <li><strong>Date d'expiration:</strong> <?php echo $Offre['dateEx_offre']; ?></li>
                            <li><strong>Compétences demandées:</strong> <?php echo $Offre['compOffre']; ?></li>
                            <li><strong>Niveau d'étude requis:</strong> <?php echo $Offre['nvEttude']; ?></li>
                            <li><strong>Expérience demandée:</strong> <?php echo $Offre['expOffre']; ?></li>
                            <li><strong>Catégorie de l'offre:</strong> <?php echo $Offre['catgOffre']; ?></li>
                            <li><strong>Statut de l'offre:</strong> <?php echo $Offre['statutOffre']; ?></li>
                            <li><strong>Nombre de postes disponibles:</strong> <?php echo $Offre['nbPostes']; ?></li>
                            <li><strong>Langues demandées:</strong> <?php echo $Offre['langOffre']; ?></li>
                            <li><strong>Mot clé:</strong>
    <form id="keywordSearchForm" action="index.php" method="GET" style="display: inline;">
        <input type="hidden" name="tri" value="<?php echo isset($_GET['tri']) ? htmlspecialchars($_GET['tri']) : ''; ?>">
        <input type="text" name="search" id="search" style="display: none;"> <!-- Input caché pour le mot clé -->
        <a href="#" onclick="submitKeywordSearchForm('<?php echo htmlspecialchars($Offre['cleOffre']); ?>'); return false;" style="text-decoration: none;"><?php echo htmlspecialchars($Offre['cleOffre']); ?></a>
    </form>
</li>
<script>
    function submitKeywordSearchForm(keyword) {
        document.getElementById('search').value = keyword; // Remplir la valeur de l'input avec le mot clé
        document.getElementById('keywordSearchForm').submit(); // Soumettre le formulaire
    }
</script>
                        </ul>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block">Retour</a>
                </div>
            </div>
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
    <script src="../js/quill.min.js"></script>
    
    
    <script src="../js/bootstrap-select.min.js"></script>
    
    <script src="../js/custom.js"></script>
   
    <script>
        // Fonction pour effectuer la recherche de la localisation et afficher sur la carte
        function searchLocation() {
            var location = document.getElementById('location').value;

            // Effectuer une requête de recherche avec Nominatim
            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + location)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        var result = data[0];
                        var latitude = result.lat;
                        var longitude = result.lon;

                        // Appeler la fonction pour afficher la localisation sur la carte
                        showLocationOnMap(latitude, longitude);
                    } else {
                        alert('Aucune localisation trouvée pour : ' + location);
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la recherche de localisation :', error);
                    alert('Une erreur s\'est produite lors de la recherche de localisation.');
                });
        }

        // Fonction pour afficher la localisation sur la carte
        function showLocationOnMap(latitude, longitude) {
            // Créer une carte Google Maps centrée sur la localisation fournie
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10, // Niveau de zoom initial
                center: { lat: parseFloat(latitude), lng: parseFloat(longitude) } // Centrer la carte sur la localisation
            });

            // Ajouter un marqueur à la position de la localisation
            var marker = new google.maps.Marker({
                position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
                map: map, // Afficher le marqueur sur la carte
                title: 'Localisation de l\'offre' // Titre du marqueur (optionnel)
            });
        }

        // Appeler la fonction pour afficher la localisation lorsque la page est chargée
        window.onload = function() {
            // Récupérer les valeurs de latitude et de longitude de l'offre depuis PHP (stockées dans la variable $Offre)
            var latitude = <?php echo $Offre['latitude']; ?>;
            var longitude = <?php echo $Offre['longitude']; ?>;

            // Appeler la fonction pour afficher la localisation sur la carte
            showLocationOnMap(latitude, longitude);
        };
    </script>
     
  </body>
</html>