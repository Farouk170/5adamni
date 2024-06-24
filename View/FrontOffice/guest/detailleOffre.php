<?php
include '../../../Controller/OffreC.php';
include '../../../Model/offre.php';

$offrec = new OffreC();
$Offre = $offrec->details($_POST['idOffre']);
$scoreIncremented = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['scoreIncremented'])) {
        $offrec->incrementerScoreOffre($_POST['idOffre']);
        $_SESSION['scoreIncremented'] = true;
        $scoreIncremented = true;
    }
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
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/animate.min.css">
    <link rel="stylesheet" href="../css/quill.snow.css">
   

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">   
    <style>
       .card-body{
        background-color: #E3DBDB;
       }
        .logo-img {
            max-width: 150px;
            max-height: 150px;
        }
        .btn-back {
            background-color: red;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #0056b3;
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
          <div class="site-logo col-6"><a href="index.html"><img src="../logo.svg"></a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="../login.php">Offres</a></li>
              <li class="has-children">
                <a href="../login.php">Réclamations</a>
                <ul class="dropdown">
                  <li><a href="../login.php">Consulter réclamations</a></li>
                  <li><a href="../login.php">Réponses</a></li>
                </ul>
              </li>
              <li class="has-children">
                <a href="">Entretiens</a>
              </li>
              <li><a href="../login.php">Forum</a></li>
              <li class="d-lg-none"><a href="signup.php"><span class="mr-2"></span> Sign Up</a></li>
              <li class="d-lg-none"><a href="../login.php">Log In</a></li>
            </ul>
          </nav>
          
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
              <a href="signup.php" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"><span class="mr-2 bi-person-plus  "></span>Sign Up</a>
              <a href="login.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
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
          <div class="col-lg-4">
           
          </div>
        </div>

        <div id="map-container">
    <div id="map"></div>
    <div id="location-input">
        <input type="text" id="location" placeholder="Entrer une localisation" value="<?php echo htmlspecialchars($Offre['localOffre'] . ', Tunisie'); ?>">
        <button onclick="searchLocation()">Afficher sur la carte</button>
    </div>
      </div>
        <div class="row mb-5">
          <div class="col-lg-12">
          <div class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Détails de l'offre d'emploi</h3>
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
    <form id="keywordSearchForm" action="../index.php" method="GET" style="display: inline;">
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
                    <a href="../index.php" class="btn btn-primary border-width-2 d-none d-lg-inline-block">Retour</a>
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