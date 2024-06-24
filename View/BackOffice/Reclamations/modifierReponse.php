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
    <?php
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
    <style>
        .limited-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .imageModal {
            display: none;

            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);

            justify-content: center;
            align-items: center;
        }


        .imageModal img {
            max-width: 80%;

            max-height: 80%;
        }


        .showImageButton {
            position: absolute;

            bottom: 10px;

            right: 0%;

            transform: translateX(-50%);

            background-color: red;

            color: #FFF;

            border: none;

            border-radius: 5px;

            cursor: pointer;

            height: 30px;
            width: 70px;
        }


        .showImageButton:hover {
            background-color: #0056b3;

        }

        .reply-box {
            display: none;
        }

        .stat {

            padding-left: 50px;
        }

        .reponses-section {
            /* Ajoutez vos styles ici */
            padding-left: 30px;
            /* Ajoute un espace au-dessus de la section */

        }

        /* Style global */
        body {
            font-family: Arial, sans-serif;
            background-color: #191c24;
            margin: 0;
            padding: 0;
        }

        /* Conteneur principal */
        .reclamation-details,
        #modifyForm {
            width: 80%;
            margin: 20px auto;
            padding: 15px;
            border-radius: 8px;
            background-color: #191c24;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Titre de la réclamation */
        .reclamation-details h2 {
            color: red;
            margin-bottom: 10px;
        }

        /* Date de la réclamation */
        .reclamation-details p {

            color: gray;
            margin: 5px 0;
        }

        /* Texte de la réclamation */
        .reclamation-details p:first-of-type {
            margin-top: 0;
        }

        /* Formulaire de modification */
        #modifyForm {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Champ de texte */
        textarea[name="textRep"] {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
            font-size: 14px;
            color: white;
            background-color: #191c24;
        }

        /* Boutons */
        input[type="submit"] {
            width: 100px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: red;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: black;
        }

        /* Champs cachés */
        input[type="hidden"] {
            display: none;
        }

        .repons {
            color: red;
        }
        .error{
            color: red; 
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
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
                        <h6 class="mb-0">User</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <div class="ms-3">
                        <span>Navigation</span>
                    </div>
                    <br>
                    <a href="../index.php" class="nav-item nav-link"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="../users/" class="nav-item nav-link"><i class="fa bi-people-fill me-2"></i>Users</a>
                    <a href="../offres/offres.php" class="nav-item nav-link"><i
                            class="fa bi-megaphone-fill me-2"></i>Offres</a>
                    <a href="../Entretiens/entretiens.php" class="nav-item nav-link"><i class="fa bi-calendar-event-fill me-2"></i>Entretiens</a>
                    <a href="../Postes/postes.php" class="nav-item nav-link"><i
                            class="fa bi-pen-fill me-2"></i>Postes</a>
                    <a class="nav-item nav-link active"><i
                            class="fa bi-exclamation-octagon-fill me-2"></i>Reclamations</a>
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

            <!-- 404 Start -->
            <?php
            include '../../../Controller/ReclamationC.php';
            include '../../../Model/reclamation.php';
            include '../../../Controller/ReponseC.php';
            include '../../../Model/reponse.php';

            // Récupération de l'ID de la réclamation de l'URL
            $idRec = isset($_GET['idRec']) ? $_GET['idRec'] : null;

            if ($idRec) {
                // Instanciation des contrôleurs
                $reponseC = new ReponseC();
                $reclamationC = new ReclamationC();

                // Récupérer les détails de la réponse et de la réclamation
                $reponse = $reponseC->recupererDetailsReponse($idRec);
                $reclamation = $reclamationC->recupererReclamationParId($idRec);

                if ($reponse && $reclamation) {
                    // Récupération des données
                    $idRep = $reponse['idRep'];
                    $textRep = $reponse['textRep'];
                    $titleRec = $reclamation['titleRec'];
                    $dateRec = $reclamation['dateRec'];
                    $textRec = $reclamation['textRec'];

                    ?>

                    <!-- Affichage des détails de la réclamation -->
                    <div class="reclamation-details">
                        <h2>Réclamation:</h2>
                        <h4><?php echo $titleRec; ?></h4>
                        <p>Date : <?php echo $dateRec; ?></p>
                        <p>Texte de la réclamation : <?php echo $textRec; ?></p>
                    </div>

                    <!-- Formulaire de modification -->
                    <form id="modifyForm" method="POST">
                        <h2 class="repons">Réponse:</h2>
                        <textarea class="ask-block-child" name="textRep"><?php echo htmlspecialchars($textRep); ?></textarea>
                        <div class="error" id="errorTextQuestion"></div>
                        <input type="hidden" name="idRep" value="<?php echo htmlspecialchars($idRep); ?>">
                        <input type="hidden" name="idRec" value="<?php echo htmlspecialchars($idRec); ?>">
                        <input type="hidden" name="statRec" id="newStatut" value="">
                        <div class="form-row">
                            <input type="submit" name="cloturer" value="Clôturer" onclick="setStatutAndSubmit('Résolue');">
                            <input type="submit" name="modifier" value="Modifier"
                                onclick="setStatutAndSubmit('En cours de traitement');">
                        </div>
                    </form>
                    <?php
                } else {
                    echo "Aucune réponse ou réclamation trouvée pour cet ID.";
                }
            } else {
                echo "ID de réclamation non fourni.";
            }

            // Traitement de la modification de la réponse
            if (isset($_POST['modifier']) || isset($_POST['cloturer'])) {
                $idRep = $_POST['idRep'];
                $textRep = $_POST['textRep'];
                $statRec = $_POST['statRec'];
                // Instanciez à nouveau la classe ReponseC, si nécessaire
                $reponseC = new ReponseC();
                $reclamationC = new ReclamationC();
                // Modifier la réponse
                $modificationReussie = $reponseC->modifierReponse($idRep, $textRep);

                // Afficher un message de succès ou d'échec et rediriger
                if ($modificationReussie) {
                    // Modifier le statut de la réclamation
                    $reclamationC->modifierStatutReclamation($idRec, $statRec);
                    echo "<script>alert('La modification a été effectuée avec succès.'); window.location.href='reclamations.php';</script>";
                } else {
                    echo "<script>alert('Échec de la modification.');</script>";
                }
            }
            ?>



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

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script>
        function toggleActions(icon) {
            const actions = icon.nextElementSibling;
            actions.style.display = (actions.style.display === 'block') ? 'none' : 'block';
        }
        function toggleReplyBox(offer) {
            var replyBox = offer.querySelector('.reply-box');

            if (replyBox.style.display === 'none' || replyBox.style.display === '') {
                replyBox.style.display = 'block';
            } else {
                replyBox.style.display = 'none';
            }
        }



        function sendReply(offer) {
            toggleReplyBox(offer);
            alert('La réponse a été envoyée !');
        }

        document.addEventListener('DOMContentLoaded', function () {
            let selectedOffer = null;


            const offers = document.querySelectorAll('.offer');


            offers.forEach(function (offer) {

                offer.addEventListener('click', function (event) {

                    if (selectedOffer !== null) {
                        selectedOffer.style.backgroundColor = '#191c24';
                    }


                    offer.style.backgroundColor = '#2c2f37';


                    selectedOffer = offer;


                    event.stopPropagation();
                });


                document.addEventListener('click', function (event) {

                    if (!offer.contains(event.target)) {

                        offer.style.backgroundColor = '#191c24';

                        selectedOffer = null;
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const offers = document.querySelectorAll('.offer');
            const rightPanel = document.querySelector('.right-panel');


            offers.forEach(function (offer) {
                offer.addEventListener('click', function (event) {

                    rightPanel.style.display = 'block';

                    event.stopPropagation();
                });
            });


            document.addEventListener('click', function (event) {

                if (!rightPanel.contains(event.target)) {

                    rightPanel.style.display = 'none';
                }
            });
        });
        function toggleText(idRec) {
            const limitedTextElement = document.getElementById(`textRec-${idRec}`);
            const fullTextElement = document.getElementById(`fullText-${idRec}`);
            const ellipsisElement = document.getElementById(`ellipsis-${idRec}`);

            if (fullTextElement.style.display === 'none') {

                limitedTextElement.style.display = 'none';
                fullTextElement.style.display = 'inline';
                ellipsisElement.style.display = 'none';
            } else {

                limitedTextElement.style.display = 'inline';
                fullTextElement.style.display = 'none';
                ellipsisElement.style.display = 'inline';
            }
        }
        document.querySelectorAll('.offer-actions a[href*="supprimerReclamation.php"]').forEach(function (deleteButton) {
            deleteButton.addEventListener('click', function (event) {
                event.preventDefault();
                const confirmDelete = confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?');
                if (confirmDelete) {
                    window.location.href = deleteButton.href;
                }
            });
        });

        const offers = document.querySelectorAll('.offer');

        offers.forEach(offer => {

            const showImageButton = offer.querySelector('.showImageButton');

            const imageModal = offer.querySelector('.imageModal');


            if (showImageButton) {
                showImageButton.addEventListener('click', () => {

                    imageModal.style.display = 'flex';
                });
            }

            if (imageModal) {
                imageModal.addEventListener('click', event => {
                    if (event.target === imageModal) {
                        imageModal.style.display = 'none';
                    }
                });
            }
        });

        function validateTextRec() {
            var textRecInput = document.querySelector('.ask-block-child');
            var textRecValue = textRecInput.value.trim();

            if (textRecValue.length < 30) {
                document.getElementById("errorTextQuestion").textContent = "* La Réclamation doit contenir au moins 30 caractère";
                textRecInput.style.backgroundColor = "pink";
                return false;
            }
            else if (textRecValue.length > 500) {
                document.getElementById("errorTextQuestion").textContent = "* La Réclamation doit contenir au maximum 500 caractère";
                textRecInput.style.backgroundColor = "pink";
                return false;
            } else {
                document.getElementById("errorTextQuestion").textContent = "";
                textRecInput.style.backgroundColor = "";
                return true;
            }
        }


        document.getElementById("modifyForm").addEventListener("submit", function (event) {
            var formIsValid = true;


            if (!validateTextRec()) {
                formIsValid = false;
            }


            if (!formIsValid) {
                event.preventDefault();
            }
        });


        function setStatutAndSubmit(statut) {
            document.getElementById('newStatut').value = statut;
            document.getElementById('modifyForm').submit();
        }







    </script>
</body>

</html>