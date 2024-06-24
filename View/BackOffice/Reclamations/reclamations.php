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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

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
    if (!isset($_SESSION['id'])) {
        header("location: login.php");
        exit;
    } else {
        $usrc = new UserC();
        $user = $usrc->GetUserById($_SESSION['id']);
        if ($user['role'] == "Admin") {
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    var prenom = "' . htmlspecialchars($_SESSION['prenom']) . '";';
            echo '    var users = document.getElementsByClassName("user");';
            echo '    for (var i = 0; i < users.length; i++) {';
            echo '        users[i].textContent = prenom;';
            echo '    }';
            echo '});';
            echo '</script>';
        } else {
            if ($user['role'] == "Postulant") {
                header("location: ../../FrontOffice/Postulant/");
            } else {
                header("location: ../../FrontOffice/Entreprise/");
            }
        }
    }
    ?>
    <style>
        .pagination-container {
            text-align: center;
            /* Centre les éléments enfants */
            margin-top: 20px;
            /* Ajoute un espace entre le contenu et les boutons */
            padding-bottom: 40px;
            padding-top: 30px;
        }

        .pagination-button {
            background-color: red;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            /* Supprime le soulignement du lien */
            margin-right: 5px;
            /* Ajoute un espace entre les boutons */
        }

        .pagination-button:hover {
            background-color: black;
            /* Change la couleur au survol */
        }

        .limited-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .imageModal {
            display: none;
            z-index: 1000;
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

            margin-top: 20px;
        }


        .showImageButton:hover {
            background-color: #0056b3;

        }

        .reply-box {
            display: none;
        }

        .reponses-section {
            /* Ajoutez vos styles ici */
            padding-left: 30px;
            /* Ajoute un espace au-dessus de la section */

        }

        /* Styles pour le sélecteur */
        #filterStatus {
            padding: 8px;
            /* Ajoute un espacement interne */
            border: 1px solid #ccc;
            /* Ajoute une bordure grise */
            border-radius: 4px;
            /* Ajoute des coins arrondis */
            background-color: black;
            /* Ajoute une couleur d'arrière-plan */
            color: gray;
            /* Définit la couleur du texte */
            font-size: 16px;
            /* Définit la taille de la police */
            width: 200px;
            /* Définit la largeur du sélecteur */
            cursor: pointer;
            /* Change le curseur en pointeur lors du survol */
            margin-bottom: 10px;
            /* Ajoute un espace en bas */
            outline: none;
            /* Supprime le contour par défaut */
        }

        /* Change la couleur de fond du sélecteur lors du survol */
        #filterStatus:hover {
            background-color: #e6e6e6;
        }

        /* Change la couleur de la bordure et de fond lors de la sélection d'une option */
        #filterStatus:focus {
            border-color: #007bff;
            /* Change la couleur de la bordure */
            background-color: #fff;
            /* Change la couleur de fond */
        }

        .problme-de-postulation {
            color: red;
        }

        .rep {
            color: red;
        }

        .brouillon-button {
            background-color: red;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;

        }

        .repon {
            color: white;
            background-color: red;

        }

        .repon:hover {
            background-color: #191c24;

        }

        .imageUser {
            width: 45px;
            /* Adjust the size as needed */
            height: 45px;
            /* Adjust the size as needed */
            border-radius: 50%;
            /* Makes the image circular */
            object-fit: cover;
            /* Ensures the image covers the area while maintaining aspect ratio */
            border: 2px solid #fff;
            /* Optional: adds a border around the image */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            /* Optional: adds a subtle shadow */
        }

        .offer-actions {
            display: none;
            position: absolute;
            top: 50px;
            /* Adjust this as necessary */
            right: 10px;
            /* Adjust this as necessary */
            flex-direction: row;
            /* Change to row for horizontal layout */
            align-items: center;
            /* Center align the items */
            background-color: black;
            /* Optional: Add a background color */
            border: 1px solid #ccc;
            /* Optional: Add a border */
            border-radius: 5px;
            /* Optional: Add rounded corners */
            padding: 10px;
            /* Optional: Add some padding */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Optional: Add a shadow */
        }

        .offer-actions a,
        .offer-actions button {
            display: inline-block;
            padding: 10px 15px;
            margin: 0 5px;
            /* Horizontal margin for spacing */
            color: #fff;
            background-color: #ff0000;
            /* Red background color */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .offer-actions a:hover,
        .offer-actions button:hover {
            background-color: #cc0000;
            /* Darker red on hover */
        }

        .archive {
            right: 10px;
            position: relative;
        }

        .lienn {
            padding-left: 30px;


        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">



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
                        <img class="rounded-circle me-lg-2" src="<?php echo $imageSource; ?>"
                            alt="Image de l'utilisateur" style="width: 40px; height: 40px;">
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
                <a class="lienn" href="reclamationArchive.php" class="archive">Réclamations Archivées</a>
                <div class="navbar-nav align-items-center ms-auto">

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php echo $imageSource; ?>"
                                alt="Image de l'utilisateur" style="width: 40px; height: 40px;">
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
            <div class="container-fluid pt-4 px-4">
                <label for="filterStatus">Filtrer par statut : </label>
                <select id="filterStatus" name="filterStatus">
                    <option value="">Récente</option>
                    <option value="En attente">En attente</option>
                    <option value="En cours de traitement">En cours de traitement</option>
                    <option value="Résolue">Résolue</option>
                </select>
                <?php
                include '../../../Controller/ReclamationC.php';
                include '../../../Model/reclamation.php';
                include '../../../Controller/ReponseC.php';
                include '../../../Model/reponse.php';
                include '../../../Controller/NoteC.php';
                include '../../../Model/Note.php';
                // Création des objets pour les contrôleurs
                $reclamationc = new ReclamationC();
                $reponsec = new ReponseC();
                // Récupération de la liste des réclamations
                $liste = $reclamationc->listeReclamations();
                // Number of offers per page
                $offersPerPage = 3;

                // Calculate the total number of pages
                $totalPages = ceil(count($liste) / $offersPerPage);

                // Get the current page number from the URL, default to 1 if not set
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the starting index of the current page
                $startIndex = ($currentPage - 1) * $offersPerPage;

                // Get a subset of offers for the current page
                $currentPageOffers = array_slice($liste, $startIndex, $offersPerPage);
                // Traitement des données du formulaire pour ajouter une réponse
                if (isset($_POST['idRec']) && isset($_POST['textRep'])) {
                    $idRec = $_POST['idRec'];
                    $textRep = $_POST['textRep'];


                }

                foreach ($currentPageOffers as $Reclamation) {
                    $user = $usrc->GetUserById($Reclamation['idUser']);
                    if ($Reclamation['archiveBackRec'] == '0') {
                        ?>

                        <div class="offer">

                            <!-- Affichage des détails de la réclamation -->
                            <div class="ava-wrapper">
                                <img class="imageUser" src="data:image/png;base64,<?php if (isset($user['image'])) {
                                    echo base64_encode($user['image']);
                                } ?>" alt="Image de l'utilisateur">
                                
                                <div class="nikcname-group">
                                    <div class="nikcname1"><?php echo $user['prenom']; ?></div>
                                    <div class="time1"><?php echo $Reclamation['dateRec']; ?></div>
                                    <div class="stat"><?php echo $Reclamation['statRec']; ?>...</div>
                                </div>
                                <div>
                                    <input type="hidden" name="tel" value="<?php echo $user['tel']; ?>">
                                    <span class="material-symbols-outlined button" type="button" onclick="display(this)">visibility</span>
                                </div>
                            </div>

                            <h4 class="problme-de-postulation"><?php echo $Reclamation['titleRec']; ?></h4>

                            <div class="categorie-rec"><?php echo $Reclamation['categorieRec']; ?></div>
                            <hr>
                            <div class="posuere-arcu-arcu">
                                <p class="limited-text" id="textRec-<?php echo $Reclamation['idRec']; ?>">
                                    <?php
                                    $textRec = $Reclamation['textRec'];

                                    $shortText = mb_substr($textRec, 0, 100);
                                    echo $shortText;
                                    ?>
                                    <span id="ellipsis-<?php echo $Reclamation['idRec']; ?>">
                                        [...] <b onclick="toggleText('<?php echo $Reclamation['idRec']; ?>')">Voir plus</b>
                                    </span>
                                </p>
                                <span id="fullText-<?php echo $Reclamation['idRec']; ?>" style="display: none;">
                                    <?php echo $textRec; ?>
                                    <b onclick="toggleText('<?php echo $Reclamation['idRec']; ?>')">Voir moins</b>
                                </span>
                            </div>
                            <hr>
                            <!-- Affichage des réponses associées -->
                            <?php
                            $reponses = $reponsec->recupererReponsesParReclamation($Reclamation['idRec']);
                            if ($reponses) {
                                echo "<div class='reponses-section'>";
                                foreach ($reponses as $reponse) {
                                    echo "<div class='reponse'>";
                                    echo "<h4 class='rep'>Réponse : </h4>";
                                    echo "<p>" . $reponse['dateRep'] . "</p>";
                                    echo "<p>" . $reponse['textRep'] . "</p>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                            ?>
                            <?php if ($Reclamation['statRec'] == 'Résolue') { ?>
                                <hr>
                                <?php $noteC = new NoteC();
                                $noted = $noteC->CheckNote(1, $reponse['idRep']);
                                if ($noted == 1) { ?>
                                    <li><span class="detail-label">taux de satisfaction Cient:</span>
                                        <?php echo $noteC->getNotes($reponse['idRep']); ?></li>
                                <?php } ?>
                                <div class="toggle-actions" onclick="toggleActions(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M8 2.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5zm0 6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5zm0 6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                </div>
                                <div class="offer-actions">
                                    <?php
                                    echo "<form action='traitementArchive.php' method='POST' style='display:inline;'>";
                                    echo "<input type='hidden' name='idRec' value='{$Reclamation['idRec']}'>";
                                    echo "<input type='hidden' name='archiveBackRec' value='1'>";
                                    echo "<button type='submit'>Archiver</button>";
                                    echo "</form>"; ?>
                                </div>
                            <?php } ?>

                            <!-- Affichage conditionnel des actions basées sur le statut de la réclamation -->
                            <?php if ($Reclamation['statRec'] !== 'Résolue') { ?>

                                <hr class="offer-hr">
                                <?php
                                if ($Reclamation['statRec'] === 'En cours de traitement') {
                                    // Bloc de code pour les réclamations en cours de traitement
                                    foreach ($reponses as $reponse) {
                                        echo '<a href="modifierReponse.php?idRec=' . $Reclamation['idRec'] . '" class="modify-button">';
                                        echo '<span class="button-text">Modifier</span>';
                                        echo '</a>';
                                    }
                                } else {
                                    // Bloc de code pour les autres cas, ici vous ajoutez le formulaire d'ajout de réponse
                                    echo '
    <form method="POST" action="ajouterReponse.php">
        <input class="repon" type="submit" value="réponse">
        <input type="hidden" name="idRec" value="' . $Reclamation['idRec'] . '">
        <input type="hidden" name="dateRec" value="' . $Reclamation['dateRec'] . '">
        <input type="hidden" name="titleRec" value="' . $Reclamation['titleRec'] . '">
        <input type="hidden" name="categorieRec" value="' . $Reclamation['categorieRec'] . '">
        <input type="hidden" name="textRec" value="' . $Reclamation['textRec'] . '">
        <input type="hidden" name="statRec" value="' . $Reclamation['statRec'] . '">
    </form>
    ';
                                }
                                ?>

                            <?php } ?>

                            <button class="showImageButton">Image </button>

                            <div class="imageModal">
                                <img src="data:image/png;base64,<?php echo base64_encode($Reclamation['imgRec']); ?>"
                                    alt="image">
                            </div>

                        </div>
                        <?php
                    }
                }
                ?>

                <?php


                if ($totalPages > 1) {
                    echo "<div class='pagination-container'>";
                    // Afficher le bouton "Précédent" s'il n'est pas sur la première page
                    if ($currentPage > 1) {
                        echo "<a href='?page=" . ($currentPage - 1) . "' class='pagination-button'>Précédent</a>";
                    }

                    // Afficher les numéros de page
                    for ($i = 1; $i <= $totalPages; $i++) {
                        // Mettre en évidence la page actuelle
                        $activeClass = ($i == $currentPage) ? "active" : "";
                        echo "<a href='?page=$i' class='pagination-button $activeClass'>$i</a>";
                    }

                    // Afficher le bouton "Suivant" s'il n'est pas sur la dernière page
                    if ($currentPage < $totalPages) {
                        echo "<a href='?page=" . ($currentPage + 1) . "' class='pagination-button'>Suivant</a>";
                    }
                    echo "</div>";
                }


                ?>
            </div>

            <!-- 404 End -->
            <div class="right-panel">
                <br>
                <div class="right-panel-inner">
                    <img class="frame-inner" id="image" loading="lazy" alt="photo" />
                </div>
                <br>
                <div class="golanginya-wrapper">
                    <b class="golanginya" style="color: #eb1616;">Nom et Prenom: </b>
                </div>
                <div class="golanginya-wrapper">
                    <b class="golanginya" id="prenom"></b>
                    <b class="golanginya" id="nom"></b>
                </div>
                <div class="golanginya-wrapper">
                    <b class="golanginya" style="color: #eb1616;">Num:</b>
                    <b class="golanginya" id="tel"></b>
                </div>
                <div class="golanginya-wrapper">
                    <b class="golanginya" style="color: #eb1616;">Role:</b>
                    <b class="golanginya" id="role"></b>
                </div>
                <br>
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

        document.addEventListener('DOMContentLoaded', function () {
            // Attacher les événements aux boutons de chaque formulaire de réponse
            const forms = document.querySelectorAll('.reply-box');

            forms.forEach(form => {
                const envoyerButton = form.querySelector('.envoyer-button');
                const brouillonButton = form.querySelector('.brouillon-button');

                envoyerButton.addEventListener('click', function (event) {
                    event.preventDefault(); // Empêcher la soumission par défaut

                    // Assurez-vous de définir correctement l'actionType
                    form.querySelector('[name="actionType"]').value = 'Envoyer';

                    // Désactiver le bouton pour éviter les soumissions multiples
                    envoyerButton.disabled = true;

                    // Soumettre le formulaire
                    form.submit();
                });

                brouillonButton.addEventListener('click', function (event) {
                    event.preventDefault(); // Empêcher la soumission par défaut

                    // Assurez-vous de définir correctement l'actionType
                    form.querySelector('[name="actionType"]').value = 'Brouillon';

                    // Désactiver le bouton pour éviter les soumissions multiples
                    brouillonButton.disabled = true;

                    // Soumettre le formulaire
                    form.submit();
                });
            });
        });



        document.addEventListener('DOMContentLoaded', function () {
            const filterStatus = document.getElementById('filterStatus');
            filterStatus.addEventListener('change', function () {
                const selectedStatus = filterStatus.value;

                // Récupérez toutes les offres
                const offers = document.querySelectorAll('.offer');

                // Filtrer les offres par statut
                offers.forEach(offer => {
                    const statElement = offer.querySelector('.stat');
                    const statText = statElement.textContent.trim();

                    if (selectedStatus === '' || statText.includes(selectedStatus)) {
                        offer.style.display = ''; // Afficher l'offre
                    } else {
                        offer.style.display = 'none'; // Masquer l'offre
                    }
                });
            });
        });


        function validateTextRep() {
            var textRepInput = document.querySelector('.reply-box');
            var textRepValue = textRepInput.value.trim();

            if (textRepValue.length < 30) {
                document.getElementById("errorTextQuestion").textContent = "* La Réponse doit contenir au moins 30 caractère";
                textRecInput.style.backgroundColor = "pink";
                return false;
            }
            else if (textRepValue.length > 500) {
                document.getElementById("errorTextQuestion").textContent = "* La Réponse doit contenir au maximum 500 caractère";
                textRepInput.style.backgroundColor = "pink";
                return false;
            } else {
                document.getElementById("errorTextQuestion").textContent = "";
                textRepInput.style.backgroundColor = "";
                return true;
            }
        }
        document.getElementsByClassName("reply-box").addEventListener("submit", function (event) {
            var formIsValid = true;

            if (!validateTextRep()) {
                formIsValid = false;
            }


            if (!formIsValid) {
                event.preventDefault();
            }
        });


    </script>
    <script src="XHML.js"></script>
</body>

</html>