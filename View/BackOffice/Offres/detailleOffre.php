<?php
include '../../../Controller/OffreC.php';
include '../../../Model/offre.php';

$offrec = new OffreC();
$Offre = $offrec->details($_POST['idOffre']);
require_once "../../../config/connexion.php";
require_once "../../../Controller/UserController.php";
session_start();
if(!isset($_SESSION['id'])) {
    header("location: login.php");
    exit;
}
else {
    $usrc=new UserC();
    $user=$usrc->GetUserById($_SESSION['id']);
    if($user['role']=="Admin"){
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
    else{
        if($user['role']=="Postulant"){
            header("location: ../../FrontOffice/Postulant/");
        }
        else{
            header("location: ../../FrontOffice/Entreprise/");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>5adamni</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

<!-- Favicon -->
<link href="../logo-mini.svg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <style>
.card-body {
    background-color: #222; /* Couleur de fond sombre */
    color: #fff; /* Blanc pour le texte */
   
    padding: 20px; /* Espacement intérieur */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Ombre */
}

        .logo-img {
            max-width: 150px;
            max-height: 150px;
        }
        .btn-back {
    background-color: #ff0000; /* Rouge */
    color: #fff; /* Blanc pour le texte */
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    text-decoration: none;
}
.btn-back:hover {
    background-color: #cc0000; /* Rouge légèrement plus foncé au survol */
}

    /* ID de l'offre */
    li.offre-id strong {
            color: #dc3545; /* Red text color for strong */
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

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="../index.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><img src="../logo.svg" style="width: 200px; height: 70px;"></h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                            <?php
                                $imageData = $usrc->getImageById($_SESSION['id']);
                                $imageSource = $imageData ? 'data:image/png;base64,' . base64_encode($imageData) : '../img/user.jpg';                                
                            ?>
                            <img class="rounded-circle me-lg-2" src="<?php echo $imageSource; ?>" alt="Image de l'utilisateur" style="width: 40px; height: 40px;">
                            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 user">User</h6>
                        <span>Admin</span>  
                    </div>
                </div>
                <div class="navbar-nav w-100">  
                    <div class="ms-3">
                        <span>Navigation</span>
                    </div>
                    <a href="../Offre.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="../users.php" class="nav-item nav-link"><i class="fa bi-people-fill me-2"></i>Users</a>
                    <a href="offres.php" class="nav-item nav-link active"><i class="fa bi-megaphone-fill me-2"></i>Offres</a>
                    <a href="../entretiens/entretiens.php" class="nav-item nav-link"><i class="fa bi-calendar-event-fill me-2"></i>Entretiens</a>
                    <a href="../Postes/postes.php" class="nav-item nav-link"><i class="fa bi-pen-fill me-2"></i>Postes</a>
                    <a href="../competences/userscv.php" class="nav-item nav-link"><i class="fa bi-file-text-fill me-2"></i>Compétences</a>
                    <a href="../reclamations/reclamations.php" class="nav-item nav-link"><i class="fa bi-exclamation-octagon-fill me-2"></i>Reclamations</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="../index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <?php
                                $imageData = $usrc->getImageById($_SESSION['id']);
                                $imageSource = $imageData ? 'data:image/png;base64,' . base64_encode($imageData) : '../img/user.jpg';                                
                            ?>
                            <img class="rounded-circle me-lg-2" src="<?php echo $imageSource; ?>" alt="Image de l'utilisateur" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex user">User</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="../Users/profile.php" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <div id="map-container">
    <div id="map"></div>
    <div id="location-input">
        <input type="text" id="location" placeholder="Entrer une localisation" value="<?php echo htmlspecialchars($Offre['localOffre'] . ', Tunisie'); ?>">
        <button onclick="searchLocation()">Afficher sur la carte</button>
    </div>

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

                            <li class="offre-id"><strong>Titre de l'offre:</strong> <?php echo $Offre['titreOffre']; ?> </li>
                            <li class="offre-id"><strong>Description:</strong> <?php echo $Offre['descOffre']; ?></li>
                            <li class="offre-id"><strong>Salaire:</strong> <?php echo $Offre['salaireOffre']; ?></li>
                            <li class="offre-id"><strong>Type de contrat:</strong> <?php echo $Offre['typeContrat']; ?></li>
                            <li class="offre-id"><strong>Localisation:</strong> <?php echo $Offre['localOffre']; ?></li>
                            <li class="offre-id"><strong>Date de publication:</strong> <?php echo $Offre['dateP_offre']; ?></li>
                            <li class="offre-id"><strong>Date d'expiration:</strong> <?php echo $Offre['dateEx_offre']; ?></li>
                            <li class="offre-id"><strong>Compétences demandées:</strong> <?php echo $Offre['compOffre']; ?></li>
                            <li class="offre-id"><strong>Niveau d'étude requis:</strong> <?php echo $Offre['nvEttude']; ?></li>
                            <li class="offre-id"><strong>Expérience demandée:</strong> <?php echo $Offre['expOffre']; ?></li>
                            <li class="offre-id"><strong>Catégorie de l'offre:</strong> <?php echo $Offre['catgOffre']; ?></li>
                            <li class="offre-id"><strong>Statut de l'offre:</strong> <?php echo $Offre['statutOffre']; ?></li>
                            <li class="offre-id"><strong>Nombre de postes disponibles:</strong> <?php echo $Offre['nbPostes']; ?></li>
                            <li class="offre-id"><strong>Langues demandées:</strong> <?php echo $Offre['langOffre']; ?></li>
                            <li><strong>Mot clé:</strong>
    <form id="keywordSearchForm" action="Offres.php" method="GET" style="display: inline;">
        <input type="hidden" name="tri" value="<?php echo isset($_GET['tri']) ? htmlspecialchars($_GET['tri']) : ''; ?>">
        <input type="text" name="search" id="search" style="display: none;"> <!-- Input caché pour le mot clé -->
        <a href="#" onclick="submitKeywordSearchForm('<?php echo htmlspecialchars($Offre['cleOffre']); ?>'); return false;" style="color:aquamarine;"><?php echo htmlspecialchars($Offre['cleOffre']); ?></a>
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
                    <a href="Offres.php" class="btn-back">Retour</a>
                </div>
            </div>
        </div>
    </div>
            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">5adamni</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Developed By <a href="https://ByteQuest.tn">ByteQuest</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/chart/chart.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>

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