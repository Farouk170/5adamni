<?php
include '../../../Controller/OffreC.php';
include '../../../Model/Offre.php';
// Vérifie si la clé "idOffre" existe dans $_POST
$idOffre = isset($_POST['idOffre']) ? $_POST['idOffre'] : null;
$offrec = new OffreC();
$candidatures = $offrec->listeCandidatures($idOffre);

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



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <style>
         .card-header h3.mb-0 {
        color: black; /* Définir la couleur du texte en noir */
    }
        .card-body {
    background-color: grey; /* Couleur d'arrière-plan personnalisée */
    color: red; /* Couleur du texte */
    border: 1px solid black; /* Bordure noire */
}
.card-body, 
    .table td, 
    .table th {
        color: black; /* Définir la couleur du texte en noir */
    }
    </style>
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
                <a href="home.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><img src="../logo.svg"></h3>
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
                        <h6 class="mb-0 user">user</h6>
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
                <a href="home.html" class="navbar-brand d-flex d-lg-none me-4">
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
                            <span class="d-none d-lg-inline-flex user">user</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="../Users/profile.php" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


        
                <body>
                    <div class="container py-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h3 class="mb-0">Détails des candidatures pour l'offre d'emploi</h3>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID de la candidature</th>
                                                <th>Date de la candidature</th>
                                                <th>ID de l'offre associée</th>
                                                <th>CV</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($candidatures as $candidature) { ?>
                                            <tr>
                                                <td><?php echo $candidature['idCandidature']; ?></td>
                                                <td><?php echo $candidature['dateCandidature']; ?></td>
                                                <td><?php echo $candidature['idOffre']; ?></td>
                                                <td>
                                                    <div class="col-md-4 mb-3">
                                                        <a data-fancybox data-type="iframe" data-src="<?php echo 'data:application/pdf;base64,' . base64_encode($candidature['cvOffre']); ?>" href="javascript:;" class="btn btn-primary">Voir CV</a>
                                                    </div>
                                                </td>
                                           
                                                <td><button onclick="confirmerSuppression(<?php echo $candidature['idCandidature']; ?>)">Supprimer</button></td>
             
                                            </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-4">
                                    <a href="Offres.php" class="btn btn-primary">Retour</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
        
            <!-- 404 End -->


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
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Fancybox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
                    function confirmerSuppression(idCandidature) {
                        if (confirm("Êtes-vous sûr de vouloir supprimer cette candidature ?")) {
                            // Si l'utilisateur appuie sur OK, la suppression se fait
                            window.location.href = 'supprimerCandidature.php?idCandidature=' + idCandidature;
                        } else {
                            // Si l'utilisateur appuie sur Annuler, la suppression est annulée
                            alert("La suppression a été annulée.");
                        }
                    }
                </script>
</html>