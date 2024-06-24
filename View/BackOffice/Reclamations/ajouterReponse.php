<?php
include '../../../Controller/ReclamationC.php';
include '../../../Model/reclamation.php';
include '../../../Controller/ReponseC.php';
include '../../../Model/reponse.php';

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
$s = 0;

if (
    isset($_POST['idRec']) &&
    isset($_POST['textRep'])

) {
    $idRec = $_POST['idRec'];
    $textRep = $_POST['textRep'];

    $reponse = new reponse(
        $idRec,
        $textRep,
        5

    );
    $s = 1;
}
if (isset($_POST['idRec'])) {
    $idRec = $_POST['idRec'];
}
if (isset($_POST['textRec'])) {
    $textRec = $_POST['textRec'];
}
if (isset($_POST['dateRec'])) {
    $dateRec = $_POST['dateRec'];
}
if (isset($_POST['titleRec'])) {
    $titleRec = $_POST['titleRec'];
}
if (isset($_POST['categorieRec'])) {
    $categorieRec = $_POST['categorieRec'];
}
if (isset($_POST['textRec'])) {
    $textRec = $_POST['textRec'];
}
if (isset($_POST['statRec'])) {
    $textRec = $_POST['statRec'];
}


$reponseC = new ReponseC();
$suggestions = $reponseC->getSuggestionsByTitleAndCategory(isset($titleRec) ? $titleRec : '', isset($categorieRec) ? $categorieRec : '');

?>
      <?php

if ($s == 1) {
    $reclamationc = new ReclamationC();
    $reclamationc->ajouterReponse($reponse);
    //$reclamationc->listeReclamations();
    header('Location:reclamations.php');
    exit;
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- Favicon -->
    <link href="../logo-mini.svg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="./backend_rec.css" />
    <style>
        /* Form styles */
        form#offreForm {
            width: 800px;
            /* Limitez la largeur de .offer pour laisser de l'espace pour le right-panel */
            /* 280px = largeur du right-panel (250px) + marge (10px pour chaque côté) + padding (10px) */
            background-color: #191c24;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            position: relative;
            /* Permet de positionner les boutons à trois points correctement */
        }

        /* Reclamation details styles */
        .reclamation-details {
            margin-bottom: 20px;
            /* Marge inférieure */
        }

        .reclamation-details p {
            color: #666;
            /* Couleur du texte */
            font-size: 14px;
            /* Taille de la police */
        }

        /* Form row styles */
        .form-row {
            margin-bottom: 10px;
            /* Marge inférieure */
        }

        .form-row textarea {
            width: 100%;
            /* Largeur totale */
            padding: 10px;
            /* Espacement interne */
            border-radius: 5px;
            /* Bords arrondis */
            border: 1px solid #ccc;
            /* Bordure grise */
            resize: none;
            /* Désactiver le redimensionnement */
            background-color: #191c24;
            color: grey;
        }

        .form-row input[type="submit"],
        .form-row input[type="reset"] {
            background-color: red;
            /* Couleur de fond bleue */
            color: white;
            /* Couleur du texte blanche */
            border: none;
            /* Pas de bordure */
            padding: 10px 15px;
            /* Espacement interne */
            border-radius: 5px;
            /* Bords arrondis */
            cursor: pointer;
            /* Pointeur en forme de main */
        }

        .form-row input[type="submit"]:hover,
        .form-row input[type="reset"]:hover {
            background-color: #0056b3;
            /* Couleur de fond bleue plus foncée au survol */
        }

        .hidden {
            display: none;
        }

        .repp {

            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            /* Hauteur de la fenêtre d'affichage */
            
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
    
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="../index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><img src="../logo.svg"></h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <?php
                            $imageData = $usrc->getImageById($_SESSION['id']);
                            $imageSource = $imageData ? 'data:image/png;base64,' . base64_encode($imageData) : '../img/user.jpg';                                
                        ?>
                        <img class="rounded-circle me-lg-2" src="<?php echo $imageSource; ?>" alt="Image de l'utilisateur" style="width: 40px; height: 40px;">
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
                    <br>
                    <a href="../index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="../users.php" class="nav-item nav-link"><i class="fa bi-people-fill me-2"></i>Users</a>
                    <a href="../offres/offres.php" class="nav-item nav-link"><i class="fa bi-megaphone-fill me-2"></i>Offres</a>
                    <a class="nav-item nav-link"><i class="fa bi-calendar-event-fill me-2"></i>Entretiens</a>
                    <a href="../Postes/postes.php" class="nav-item nav-link"><i class="fa bi-pen-fill me-2"></i>Postes</a>
                    <a href="reclamations.php" class="nav-item nav-link active"><i class="fa bi-exclamation-octagon-fill me-2"></i>Reclamations</a>
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
                            <span class="d-none d-lg-inline-flex">User</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <div class="repp">
                <!-- 404 Start -->
                <form id="offreForm" method="POST" enctype="multipart/form-data">
                    <div class="reclamation-details">
                        <h3 style="color: red;">Réclamation:</h3>
                        <input type="hidden" name="idRec" id="idRec" value="<?php echo isset($idRec) ? $idRec : ''; ?>"
                            readonly>
                        <div>Date: <?php echo isset($dateRec) ? $dateRec : ''; ?></div>
                        <h5 style="color: red;"><?php echo isset($titleRec) ? $titleRec : ''; ?></h5>
                        <div>Catégorie: <?php echo isset($categorieRec) ? $categorieRec : ''; ?></div>
                        <div>Réclamation: <?php echo isset($textRec) ? $textRec : ''; ?></div>
                    </div>
                    <input type="hidden" id="titleRec" value="<?php echo isset($titleRec) ? $titleRec : ''; ?>"
                        readonly>
                    <input type="hidden" id="categorieRec"
                        value="<?php echo isset($categorieRec) ? $categorieRec : ''; ?>" readonly>

                    <h3 style="color: red;">Réponse:</h3>
                    <div class="form-row">
                        <textarea class="ask-block-child" id="textRep" placeholder="Écrire votre réponse" rows="5"
                            name="textRep" onfocus="showSuggestions()" onblur="hideSuggestions()"></textarea>
                        <div class="error" id="errorTextQuestion"></div>
                    </div>

                    <div class="form-row hidden" id="suggestionsContainer">
                        <select id="suggestionsDropdown" class="select2" style="width: 100%;">
                            <option value="">Sélectionner une suggestion</option>
                            <?php
                            if (!empty($suggestions)) {
                                foreach ($suggestions as $suggestion) {
                                    echo '<option value="' . htmlspecialchars($suggestion['textRep']) . '">' . htmlspecialchars($suggestion['textRep']) . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="statRec" id="newStatut" value="">
                    <div class="form-row">
                        <input type="submit" value="Clôturer"
                            onclick="document.getElementById('newStatut').value = 'Résolue';">
                        <input type="submit" value="Envoyer"
                            onclick="document.getElementById('newStatut').value = 'En cours de traitement';">
                        <input type="reset" value="Reset">
                    </div>
                </form>

          
            </div>
            <!-- 404 End -->
            <div class="right-panel">
                <div class="right-panel-inner">
                    <img class="frame-inner" loading="lazy" alt="" src="./public/rectangle-1@2x.png" />
                </div>
                <div class="golanginya-wrapper">
                    <b class="golanginya">@Golanginya</b>
                </div>
                <div class="right-panel-child"></div>
                <div class="right-panel-inner1">
                    <div class="award-parent">
                        <img class="award-icon" loading="lazy" alt="" src="./public/award.svg" />

                        <div class="wrapper">
                            <div class="div3">125 [ 8 ]</div>
                        </div>
                    </div>
                </div>
                <div class="right-panel-item"></div>
                <div class="right-panel-inner2">
                    <div class="github-parent">
                        <img class="github-icon" loading="lazy" alt="" src="./public/github.svg" />

                        <img class="instagram-icon" loading="lazy" alt="" src="./public/instagram.svg" />

                        <img class="facebook-icon" loading="lazy" alt="" src="./public/facebook.svg" />
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script>
        function validateTextRec() {
            var textRecInput = document.querySelector('.ask-block-child');
            var textRecValue = textRecInput.value.trim();

            if (textRecValue.length < 30) {
                document.getElementById("errorTextQuestion").textContent = "* La réponse doit contenir au moins 30 caractères";
                textRecInput.style.backgroundColor = "pink";
                return false;
            } else if (textRecValue.length > 500) {
                document.getElementById("errorTextQuestion").textContent = "* La réponse doit contenir au maximum 500 caractères";
                textRecInput.style.backgroundColor = "pink";
                return false;
            } else {
                document.getElementById("errorTextQuestion").textContent = "";
                textRecInput.style.backgroundColor = "";
                return true;
            }
        }

        // Événement lors de la soumission du formulaire
        document.getElementById("offreForm").addEventListener("submit", function (event) {
            var formIsValid = true;

            if (!validateTextRec()) {
                formIsValid = false;
            }

            if (!formIsValid) {
                event.preventDefault();
            }
        });

        $(document).ready(function () {
            // Initialiser Select2
            $('#suggestionsDropdown').select2({
                placeholder: "Sélectionner une suggestion",
                allowClear: true
            });

            // Événement lors de la sélection d'une suggestion
            $('#suggestionsDropdown').on('change', function () {
                const selectedSuggestion = $(this).val();
                $('#textRep').val(selectedSuggestion);
            });
        });

        // Afficher les suggestions lorsque le textarea reçoit le focus
        function showSuggestions() {
            $('#suggestionsContainer').removeClass('hidden');
        }

        // Masquer les suggestions lorsque le textarea perd le focus
        function hideSuggestions() {
            setTimeout(function () {
                $('#suggestionsContainer').addClass('hidden');
            }, 100);
        }

        function setStatutAndSubmit(statut) {
            // Obtenir le champ caché newStatut dans le formulaire
            const newStatutField = document.getElementById('newStatut');

            // Définir la valeur du champ caché à la valeur de statut spécifiée
            newStatutField.value = statut;

            // Soumettre le formulaire
            document.getElementById('offreForm').submit();
        }

        // Attacher des écouteurs d'événements aux boutons Clôturer et Envoyer
        document.addEventListener('DOMContentLoaded', function () {
            // Bouton "Clôturer"
            const btnCloturer = document.querySelector('input[value="Clôturer"]');
            if (btnCloturer) {
                btnCloturer.addEventListener('click', function () {
                    // Définir le statut sur "Résolue" et soumettre le formulaire
                    setStatutAndSubmit('Résolue');
                });
            }

            // Bouton "Envoyer"
            const btnEnvoyer = document.querySelector('input[value="Envoyer"]');
            if (btnEnvoyer) {
                btnEnvoyer.addEventListener('click', function () {
                    // Définir le statut sur "En cours de traitement" et soumettre le formulaire
                    setStatutAndSubmit('En cours de traitement');
                });
            }
        });
        document.getElementById('offreForm').addEventListener('submit', function (event) {
            event.preventDefault(); 

         
            const formData = new FormData(this);

           
            fetch('traitement.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json()) // Analyser la réponse JSON
                .then(data => {
                    
                    console.log(data);

                    
                    window.location.href = 'reclamations.php';
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
        });

    </script>
</body>

</html>