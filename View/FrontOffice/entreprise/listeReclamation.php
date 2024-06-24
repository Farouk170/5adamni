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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">
    <link rel="stylesheet" href="../fonts/line-icons/style.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/animate.min.css">
    <link rel="stylesheet" href="../css/quill.snow.css">


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
        .pagination-container {
            text-align: center;
            /* Centre les éléments enfants */
            margin-top: 20px;
            /* Ajoute un espace entre le contenu et les boutons */
            padding-bottom: 40px;
            padding-top: 30px;
        }

        .pagination-button {
            background-color: #FF0000;
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
            background-color: pink;
            /* Change la couleur au survol */
        }

        .offer {
            width: 800px;
            background-color: transparent;
            padding: 20px;
            border-radius: 8px;
            margin: 20px auto;
            border: 1px solid #dcdcdc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: row-reverse;
            align-items: center;
            position: relative;
            transition: background-color 0.3s, box-shadow 0.3s;
            padding-bottom: 60px;
        }

        .offer:hover {
            background-color: rgba(255, 0, 0, 0.1);
            box-shadow: 0 0 15px rgba(255, 0, 0, 0.5);

        }



        .offer img {
            width: 150px;

            height: auto;

            border-radius: 8px;
            margin-right: 20px;
            padding-left: 20px;
            max-width: 100%;

            max-height: 100%;

            object-fit: contain;

        }




        .offer-details {
            flex-grow: 1;
        }


        .offer-actions {
            display: none;
            position: absolute;
            top: 90px;
            right: 30px;
            transform: translateY(-50%);
            background-color: #FF0000;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 100;
            color: white;
        }

        .offer-actions a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }


        .offer-actions a:hover {
            background-color: rgba(255, 0, 0, 0.1);

            box-shadow: 0 0 15px rgba(255, 0, 0, 0.5);

        }


        .toggle-actions {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            font-size: 20px;

            transform: rotate(90deg);

        }


        .toggle-actions:hover {
            color: #333;
        }

        /* Styles pour le conteneur modale */
        .imageModal {
            display: none;
            /* Masqué par défaut */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Arrière-plan gris transparent */
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Styles pour l'image dans la modale */
        .imageModal img {
            max-width: 80%;
            /* Ajustez cette largeur si nécessaire */
            max-height: 80%;
        }

        /* Styles pour le bouton */
        .showImageButton {
            position: absolute;
            /* Position absolue */
            bottom: 10px;
            /* Aligne le bouton en bas de la div contenant l'offre */
            right: 0%;
            /* Centre le bouton horizontalement */
            transform: translateX(-50%);
            /* Compense le centrage */
            background-color: #FF0000;
            /* Couleur de fond du bouton */
            color: #FFF;
            /* Couleur du texte */
            border: none;
            /* Supprime les bordures */
            border-radius: 5px;
            /* Bords arrondis */
            cursor: pointer;
            /* Change le curseur en pointeur */
            height: 30px;
            width: 60px;
        }

        /* Styles pour le bouton lors du survol */
        .showImageButton:hover {
            background-color: #DA0000;
            color: #fff;
        }

        .limited-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .colorTitle {
            color: #FF0000;
            font-size: 30px;
            padding-right: 20px;
        }

        .stat {
            animation: clignoter 2s linear infinite;
        }

        /* Définit l'animation de clignotement */
        @keyframes clignoter {
            0% {
                opacity: 1;
                /* Complètement visible */
            }

            50% {
                opacity: 0;
                /* Complètement invisible */
            }

            100% {
                opacity: 1;
                /* Complètement visible */
            }
        }

        /* Style pour la section des réponses */
        .reponses-section {
            margin-top: 15px;
            /* Ajoute un espace au-dessus de la section */
            border-top: 1px solid #ccc;
            /* Ajoute une ligne de séparation au-dessus de la section */
            padding-top: 10px;
            /* Ajoute de l'espace en haut de la section */
        }

        /* Style pour chaque réponse */
        .reponse {
            margin-bottom: 10px;
            /* Ajoute un espace en dessous de chaque réponse */
        }

        /* Style pour le titre "Réponse" */
        .reponse h2 {
            color: #FF0000;
            /* Définit la couleur du titre en rouge */
            font-size: 18px;
            /* Taille de la police du titre */
            margin-bottom: 5px;
            /* Réduit l'espace en dessous du titre */
        }

        /* Style pour la date de la réponse */
        .reponse p:first-of-type {
            margin-bottom: 3px;
            /* Réduit l'espace entre la date et le texte de la réponse */
        }

        /* Styles pour le sélecteur */
        #filterStatus {

            padding: 8px;
            /* Ajoute un espacement interne */
            border: 1px solid #ccc;
            /* Ajoute une bordure grise */
            border-radius: 2px;
            /* Ajoute des coins arrondis */
            background-color: white;
            /* Ajoute une couleur d'arrière-plan */
            color: gray;
            /* Définit la couleur du texte */
            font-size: 15px;
            /* Définit la taille de la police */
            width: 200px;
            /* Définit la largeur du sélecteur */
            height: 35px;
            cursor: pointer;
            /* Change le curseur en pointeur lors du survol */

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
            border-color: #FF0000;
            /* Change la couleur de la bordure */
            background-color: #fff;
            /* Change la couleur de fond */
        }

        .tri {
            display: flex;
            /* Utiliser Flexbox pour aligner le contenu */
            justify-content: center;
            /* Centrer horizontalement le contenu */
            margin: 20px auto;
            /* Ajouter de l'espace autour de la section de tri */
        }

        /* Couleur de fond orange pour les réclamations en cours de traitement */
        .orange-background {
            background-color: #fccdb8;
        }

        /* Couleur de fond verte pour les réclamations résolues */
        .green-background {
            background-color: #e3ffe7;
        }

        /* Style pour le bouton de soumission */
        .note-button {
            background-color: #FF0000;
            /* Fond rouge */
            color: white;
            /* Texte blanc */
            border: none;
            /* Pas de bordure */
            padding: 5px 5px;
            /* Espacement interne */
            border-radius: 5px;
            /* Bordures arrondies */
            cursor: pointer;
            /* Pointeur de la souris */
        }
        .note-button:hover{
            background-color: #0056b3;
        }
        /* Style pour le sélecteur */
        .note-selector {
            padding: 8px 12px;
            /* Espacement interne */
            border: 1px solid #ccc;
            /* Bordure grise claire */
            border-radius: 5px;
            /* Bordures arrondies */
            font-size: 14px;
            /* Taille de police */
        }
      html {
        scroll-behavior: smooth;
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
              <li><a href="" class="nav-link">Offres</a></li>
              <li class="has-children">
                <a class="active">Réclamations</a>
                <ul class="dropdown">
                  <li><a href="reclamationIndex.php">Consulter réclamations</a></li>
                </ul>
              </li>
              <li class="has-children">
                <a class="nav-link">Entretiens</a>
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
        <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');"
            id="home-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1 class="text-white font-weight-bold">Liste des Réclamations</h1>
                        <div class="custom-breadcrumbs">
                            <a href="index.php" style="text-decoration: none;">Home</a> <span class="mx-2 slash">/</span>
                            <span class="text-white"><strong>Liste des Réclamations</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="tri">
            <label for="filterStatus">Filtrer par statut : </label>
            <select id="filterStatus" name="filterStatus">
                <option value="">Récente</option>
                <option value="En attente">En attente</option>
                <option value="En cours de traitement">En cours de traitement</option>
                <option value="Résolue">Résolue</option>
            </select>
        </div>
        
        <?php
        
        include '../../../Controller/ReclamationC.php';
        include '../../../Model/reclamation.php';
        include '../../../Controller/ReponseC.php';
        include '../../../Model/reponse.php';
        include '../../../Controller/NoteC.php';
        include '../../../Model/Note.php';
        

        $reclamationc = new ReclamationC();
        $reponsec = new ReponseC();
        $liste = $reclamationc->listeReclamationsById($_SESSION['id']);
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

        foreach ($currentPageOffers as $Reclamation) {
            // Définir la classe CSS de l'arrière-plan en fonction du statut de la réclamation
            $bgClass = '';
            if ($Reclamation['statRec'] === 'En cours de traitement') {
                $bgClass = 'orange-background';
            } elseif ($Reclamation['statRec'] === 'Résolue') {
                $bgClass = 'green-background';
            }

            // Utilisez les classes CSS dans l'élément div
            echo "<div class='offer $bgClass'>";

            // Reste de votre code PHP pour afficher les détails de la réclamation
            echo "<div class='offer-details'>";
            echo "<span class='colorTitle'>{$Reclamation['titleRec']}</span>";
            echo "<span class='stat'>{$Reclamation['statRec']}...</span>";
            echo "<div><strong>Date :</strong> {$Reclamation['dateRec']}</div>";
            echo "<div><strong>Catégorie :</strong> {$Reclamation['categorieRec']}</div>";
            echo "<strong>Réclamation :</strong>";
            echo "<p class='limited-text' id='textRec-{$Reclamation['idRec']}'>";
            $textRec = $Reclamation['textRec'];
            $shortText = mb_substr($textRec, 0, 100);
            echo "<span id='ellipsis-{$Reclamation['idRec']}'>";
            echo "[...] <b onclick='toggleText(\"{$Reclamation['idRec']}\")'>Voir plus</b>";
            echo "</span>";
            echo "</p>";
            echo "<span id='fullText-{$Reclamation['idRec']}' style='display: none;'>";
            echo "{$textRec}";
            echo "<b onclick='toggleText(\"{$Reclamation['idRec']}\")'>Voir moins</b>";
            echo "</span>";

            // Afficher les réponses si le statut de la réclamation est 'Résolue'
            if ($Reclamation['statRec'] === 'Résolue') {
                $reponses = $reponsec->recupererReponsesParReclamation($Reclamation['idRec']);
                if ($reponses) {
                    echo "<div class='reponses-section'>";
                    foreach ($reponses as $reponse) {
                        echo "<div class='reponse'>";
                        echo "<h2 style='color: #FF0000;'>Réponse :</h2>";
                        echo "<p>idRep =" . $reponse['idRep'] . "</p>";
                        echo "<p>" . $reponse['dateRep'] . "</p>";
                        echo "<p  style='margin-top: 0;'><strong>Réponse : </strong>" . $reponse['textRep'] . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "<hr>";
                    echo "<div><strong> *Merci de nous donner votre taux de satisfaction</strong> </div>";
                    //notageeeee************
                    $noteC = new NoteC();
                    $idUser=4;
                    $noted = $noteC->CheckNote($idUser, $reponse['idRep']);
                    if ($noted == 0) {
                        echo '<form action="noter.php?id=' . $reponse['idRep'] . '" method="POST">';
                        echo '<select name="note" id="note" class="note-selector" value="0">';
                        echo '<option value="0">0/5</option>';
                        echo '<option value="1">1/5</option>';
                        echo '<option value="2">2/5</option>';
                        echo '<option value="3">3/5</option>';
                        echo '<option value="4">4/5</option>';
                        echo '<option value="5">5/5</option>';
                        echo '</select>';
                        echo '<input type="submit" value="Noter" class="note-button" />';
                        echo '</form>';
                    }

                }
                ?>
                <?php $noteC = new NoteC();
                $idUser=4;
                $noted = $noteC->CheckNote($idUser, $reponse['idRep']);
                if ($noted == 1) { ?>
                    <li><span class="detail-label">taux de satisfaction:</span> <?php echo $noteC->getNotes($reponse['idRep']); ?></li>
                <?php } ?>
                <?php
            }


            echo "</div>";

            // Afficher les boutons Modifier et Supprimer pour les réclamations en attente
            if ($Reclamation['statRec'] === 'En attente') {
                echo "<img id='3dots' src='3 dots.png' onclick='toggleActions(this)' alt='Texte alternatif' style='position: absolute; top: 10px; right: 10px; width: 50px; height: 50px; cursor: pointer;'>";
                echo "<div class='offer-actions'>";
                echo "<a href='modifierReclamation.php?idRec={$Reclamation['idRec']}'>Modifier</a>";
                echo "<a href='supprimerReclamation.php?idRec={$Reclamation['idRec']}'>Supprimer</a>";
                echo "</div>";
            }

            echo "<button class='showImageButton'>Image</button>";
            echo "<div class='imageModal'>";
            echo "<img src='data:image/png;base64," . base64_encode($Reclamation['imgRec']) . "' alt='image'>";
            echo "</div>";
            echo "</div>";

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
        <br>
        <br>

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
        function toggleActions(icon) {
            const offerActions = icon.nextElementSibling;
            offerActions.style.display = (offerActions.style.display === 'block') ? 'none' : 'block';
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
        // Sélectionnez tous les éléments offer
        const offers = document.querySelectorAll('.offer');

        // Pour chaque élément offer, ajoutez des écouteurs d'événements aux boutons et modales
        offers.forEach(offer => {
            // Sélectionnez le bouton showImageButton à l'intérieur de l'offer
            const showImageButton = offer.querySelector('.showImageButton');
            // Sélectionnez la modale imageModal à l'intérieur de l'offer
            const imageModal = offer.querySelector('.imageModal');

            // Ajoutez un écouteur d'événements au bouton
            if (showImageButton) {
                showImageButton.addEventListener('click', () => {
                    // Affichez la modale correspondante
                    imageModal.style.display = 'flex';
                });
            }

            // Ajoutez un écouteur d'événements à la modale pour la fermer lorsqu'on clique à l'extérieur
            if (imageModal) {
                imageModal.addEventListener('click', event => {
                    if (event.target === imageModal) {
                        imageModal.style.display = 'none';
                    }
                });
            }
        });
        function toggleText(idRec) {
            const limitedTextElement = document.getElementById(`textRec-${idRec}`);
            const fullTextElement = document.getElementById(`fullText-${idRec}`);
            const ellipsisElement = document.getElementById(`ellipsis-${idRec}`);

            if (fullTextElement.style.display === 'none') {
                // Afficher le texte complet
                limitedTextElement.style.display = 'none';
                fullTextElement.style.display = 'inline';
                ellipsisElement.style.display = 'none';
            } else {
                // Afficher le texte limité
                limitedTextElement.style.display = 'inline';
                fullTextElement.style.display = 'none';
                ellipsisElement.style.display = 'inline';
            }
        }
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

    </script>

</body>

</html>