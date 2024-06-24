
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
    

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <?php
        session_start();
        include '../../../Controller/UserController.php';
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
      .card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between; /* Répartit l'espace disponible entre les éléments */
}


.card-content {
    display: flex;
    align-items: center; /* Aligne les éléments verticalement */
}



.card-details {
    width: 60%; /* 60% de la largeur pour les détails de la carte */
}

     

    /* Pour éviter une marge à droite sur la dernière carte de chaque ligne */
   
    /* Style de base de la carte */
.card {
/* 50% de largeur pour chaque carte, moins la marge entre les cartes */
    margin-bottom: A0px;
  margin-left: 50px; /* Centre la carte horizontalement */
    margin-right: 20px; /* Centre la carte horizontalement */
    width: 470px;
    height: 100px;
    border-radius: 1px;
    border: 2px solid black; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #EDEDED;
    margin-bottom: 20px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s, opacity 0.3s, background-color 0.3s, color 0.3s; /* Ajouter des transitions pour plusieurs propriétés */
}

/* Effet de survol */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    opacity: 0.9;
    background-color: #7F848C; /* Changement de couleur de fond au survol */
    color: red; /* Changement de couleur du texte au survol */
}

/* Image de la carte */
.card img.card-img-top {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    width: 70%; /* Image occupant toute la largeur de la carte */
    max-height: 60%; /* Limiter la hauteur de l'image à 40% de la hauteur de la carte */
    object-fit: cover; /* Ajuster l'image sans déformer ses proportions */
}

/* Effet de zoom sur l'image au survol */
.card:hover img.card-img-top {
    transform: scale(1.1);
    filter: brightness(90%); /* Réduire légèrement la luminosité de l'image au survol */
}

/* Contenu de la carte */
.card-body {
    padding: 20px;
}

.card-title {
    font-size: 1.4rem;
    font-weight: bold;
    color: #333333;
    margin-bottom: 10px;
    transition: font-size 0.5s; /* Ajouter une transition pour la taille de la police */
}

.card:hover .card-title {
    font-size: 1.6rem; /* Augmenter légèrement la taille de la police au survol */
}

.card-text {
    color: black;
    margin-bottom: 15px;
}

/* Bouton de titre */
.title-button {
    background: none;
    border: none;
    color: black;
    font-size: 1.4em;
    font-weight: bold;
    cursor: pointer;
    padding: 0;
    margin: 0;
    transition: transform 0.3s; /* Ajouter une transition pour le bouton */
}

.title-button:hover {
    transform: scale(1.09); /* Légèrement agrandir le bouton au survol */
}

      .logo-img {
          max-width: 100px;
          max-height: 100px;
      }
      
     
      .offer {
    background-color: #222; /* Couleur de fond sombre */
    color: #fff; /* Couleur du texte blanc */
    padding: 10px; /* Réduire le padding */
    border-radius: 9px; /* Réduire le rayon de bordure */
    margin-bottom: 10px; /* Réduire la marge en bas */
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); /* Ombre blanche */
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border: 1px solid #B4B4B8; /* Couleur de bordure rouge bordeaux */
}

      
      .offer img {
          max-width: 70px;
          max-height: 70px;
          border-radius: 8px;
          margin-right: 20px;
          flex-shrink: 0; /* Empêcher l'image de rétrécir */
      }
      
      .offer-details {
          flex-grow: 1; /* Permettre aux détails de prendre tout l'espace restant */
          margin-right: 20px;
          color: black;
      }
      
      .offer-details h2 {
          margin-top: 0;
          color: #000; /* Rouge bordeaux */
      }
      
      .offer-details p {
          color: #b3b3b3;
          margin-bottom: 5px;
      }
      
      .offer-actions {
          align-self: flex-end; /* Aligner les actions en bas */
          margin-top: auto; /* Mettre les actions au bas de la div */
      }
      
      .offer-actions button {
          padding: 8px 16px;
          background-color: #8b0000; /* Rouge bordeaux */
          color: white;
          border: none;
          border-radius: 4px;
          text-decoration: none;
          font-weight: bold;
          margin-right: 10px;
          cursor: pointer;
      }
      
      .offer-actions button:hover {
          background-color: #b3b3b3; /* Variation de la couleur au survol */
          text-decoration: underline;
      }
      
      .offer:nth-child(even) {
          background-color: #EDEDED; /* Couleur de fond de chaque ligne de liste (pairs) */
      }
      
      .offer:nth-child(odd) {
          background-color: #fff; /* Couleur de fond de chaque ligne de liste (impairs) */
      }
      .date-offre {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #666; /* Couleur du texte pour la date */
            font-size: 14px; /* Taille de la police pour la date */
        }
        .job-listing-logo{
          display: flex;
          justify-content: center;
        }
        .img-offre{
          max-width: 100px;
          max-height: 100px;
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
              <li><a></a></li>
              <li><a class="nav-link active">Offres</a></li>
              <li><a></a></li>
              <li class="has-children">
                <a>Réclamations</a>
                <ul class="dropdown">
                  <li><a href="reclamationIndex.php">Consulter réclamations</a></li>
                </ul>
              </li>
              <li><a></a></li>
              <li class="has-children">
                <a>Entretiens</a>
                <ul class="dropdown">
                  <li><a href="entretiens_e.php">Entretiens organisés</a></li>
                  <li><a href="type_entretien.php">Types entretiens</a></li>
                </ul>
              </li>
              <li><a></a></li>
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
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"> liste des offres</h1>
            <div class="custom-breadcrumbs">
              <a href="" style="text-decoration: none;">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong> liste des offres</strong></span>
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
                <h2> liste des offres</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-6">
              <a href="ajouterOffre.php" class="btn btn-block btn-light btn-md" style="border: 1px solid #000;"><span class="icon-open_in_new mr-2"></span>publier offre</a>
              </div>  
            </div>
          </div>
        </div>


        <div>
        <div class="filtrer_offer" >
          <form method="GET" class="search-jobs-form">
              <div class="row mb-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <input type="text" class="form-control form-control-lg" name="search" id="search" placeholder="Rechercher par titre...">
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0" style="position: relative;">
                  <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%" title="Options de Tri" name="tri" id="tri">
                      <option>Date de Publication</option>
                      <option>Localisation</option>
                  </select>
                  <span class="bi-arrow-down icon mr-2" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%);"></span>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                  <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search"><span class="icon-search icon mr-2"></span>Trier/Rechercher</button>
                </div>
              </div>
            </form>
        </div>
        </div>


        <div class="row mb-5">
          <div class="col-lg-12">
          <?php
    include '../../../Controller/OffreC.php';
    include '../../../Model/offre.php';

    $offrec = new OffreC();
    $liste = $offrec->listeOffres($_SESSION['id']);
    if(isset($_GET['tri'])) {
      $tri = $_GET['tri'];

      if(isset($_GET['search']) && !empty($_GET['search'])) {
          $search = $_GET['search'];
          $liste = $offrec->rechercherParTitre($_SESSION['id'],$search);
      } else {
          $liste = $offrec->listeOffres($_SESSION['id']);
      }
      function comparerOffres($a, $b) {
          global $tri;
          if ($tri === 'dateP_offre') {
              return strtotime($b[$tri]) - strtotime($a[$tri]);
          } elseif ($tri === 'localOffre') {
              return strcmp($a[$tri], $b[$tri]);
          }
      }
      usort($liste, 'comparerOffres');
  }
  $offersPerPage = 3;
  $totalPages = ceil(count($liste) / $offersPerPage);
  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
  $startIndex = ($currentPage - 1) * $offersPerPage;
  $currentPageOffers = array_slice($liste, $startIndex, $offersPerPage);
    foreach($currentPageOffers as $Offre) {
    ?>
    <div class="offer" style="position: relative;">

    <div class="date-offre"  >
            <?php 
            $datetime = $Offre['dateP_offre'];
            $date = date('Y-m-d', strtotime($datetime));
            echo $date; ?>
            <div class="offer-actions">
              <form method="POST" action="detailleOffre.php">
                  <input type="submit" value="Voir Détails" class="btn btn-primary border-width-2 d-none d-lg-inline-block">
                  <input type="hidden" name="idOffre" value="<?php echo $Offre['idOffre']; ?>">
              </form>
              <br>
            </div>
        </div>
        <img src="data:image/png;base64,<?php echo base64_encode($Offre['logo']); ?>" alt="Logo de l'offre">
        <div class="offer-details">
            <h2><?php echo $Offre['titreOffre']; ?></h2>
            <table>
                <tr>
                    <td><strong>Description:</strong></td>
                    <td>
        <?php
            // Limiter la description à 100 caractères
            $description = substr($Offre['descOffre'], 0, 95);
            
            // Vérifier si la description a été tronquée
            if (strlen($Offre['descOffre']) > 95) {
                $description .= '...'; // Ajouter des points de suspension si la description a été tronquée
            }
            
            echo $description;
        ?>
    </td>
                </tr>
                <tr>
                    <td><label for="localOffre">Localisation </label></td>
                    <td><i class="fas fa-map-marker-alt"></i>  <?php echo $Offre['localOffre']; ?></td>
                </tr>
                <td>
    <button onclick="window.location.href='modifierOffre.php?idOffre=<?php echo $Offre['idOffre']; ?>'" style="background-color: #2E933C; color: white;width: 80px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
        Modifier
    </button>
</td>
<td>
    <button onclick="confirmerSuppression(<?php echo $Offre['idOffre']; ?>)" style="background-color: #DC4E4E; color: white;width: 100px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
        Supprimer
    </button>
</td>
<tr> 
  <form method="POST" action="afficherCand.php">
      <input type="submit" value="candidature" style="background-color: #7F848C; color: white; border: none;width: 110px; border-radius: 4px; font-weight: bold; cursor: pointer;">
      <input type="hidden" name="idOffre" value="<?php echo $Offre['idOffre']; ?>">
      <input type="hidden" name="titreOffre" value="<?php echo $Offre['titreOffre']; ?>">
  </form>
</tr>

                   <script>
    function confirmerSuppression(idOffre) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette offre ?")) {
            // Si l'utilisateur appuie sur OK, la suppression se fait
            window.location.href = 'supprimerOffre.php?idOffre=' + idOffre;
        } else {
            // Si l'utilisateur appuie sur Annuler, la suppression est annulée
            alert("La suppression a été annulée.");
        }
    }
</script>
                  </tr>
                  <td colspan="2">
    <?php
        // Calculer le nombre de jours depuis la publication de l'offre
        $datePublication = strtotime($Offre['dateP_offre']);
        $maintenant = time();
        $differenceEnSecondes = $maintenant - $datePublication;

        // Convertir la différence en jours, heures et minutes
        $differenceEnJours = floor($differenceEnSecondes / (60 * 60 * 24));
        $resteEnSecondes = $differenceEnSecondes % (60 * 60 * 24);
        $differenceEnHeures = floor($resteEnSecondes / (60 * 60));
        $resteEnSecondes = $resteEnSecondes % (60 * 60);
        $differenceEnMinutes = floor($resteEnSecondes / 60);

        // Affichage du temps écoulé en fonction de la durée
        if ($differenceEnJours > 0) {
            echo "<i class='fas fa-clock'></i> Publiée il y a " . ($differenceEnJours === 1 ? "1 jour" : $differenceEnJours . " jours");
        } elseif ($differenceEnHeures > 0) {
            echo "<i class='fas fa-clock'></i> Publiée il y a " . ($differenceEnHeures === 1 ? "1 heure" : $differenceEnHeures . " heures");
        } else {
            echo "<i class='fas fa-clock'></i> Publiée " . ($differenceEnMinutes === 1 ? "il y a 1 minute" : "il y a " . $differenceEnMinutes . " minutes");
        }
    ?>
</td>


               
            </table>
            

        </div>
       
    </div>
    <?php
    }
    ?>

<div> <div class="row pagination-wrap">
          <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
          </div>
          <div class="col-md-6 text-center text-md-right">
            <div class="custom-pagination ml-auto">
            
              <div class="d-inline-block">
             
              <?php
    

    if ($totalPages > 1) {
        // Afficher le bouton "Précédent" s'il n'est pas sur la première page
        if ($currentPage > 1) {
            echo "<a href='?page=" . ($currentPage - 1) . "' class='prev icon-arrow-left'></a>";
        }
    
        // Afficher les numéros de page
        for ($i = 1; $i <= $totalPages; $i++) {
            // Mettre en évidence la page actuelle
            $activeClass = ($i == $currentPage) ? "active" : "";
            echo "<a href='?page=$i' class='pagination-button $activeClass'>$i</a>";
        }
    
        // Afficher le bouton "Suivant" s'il n'est pas sur la dernière page
        if ($currentPage < $totalPages) {
            echo "<a href='?page=" . ($currentPage + 1) . "' class='next icon-arrow-right'></a>";
        }
    }
    
    ?>
              </div>
            
            </div>
          </div>
        </div>

      </div></div>

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
    <script src="../js/jquery.min"></script>
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
   
   
     
  </body>

  
</html>