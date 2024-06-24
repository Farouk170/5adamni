<?php
// Vérifie si la clé "idOffre" existe dans $_POST
session_start();
include '../../../Controller/OffreC.php';
include '../../../Controller/UserController.php';
include '../../../Model/offre.php';
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
if(!isset($_SESSION["idOffre"])){
  $_SESSION["idOffre"] = isset($_POST['idOffre']) ? $_POST['idOffre'] : null;
}
$titreOffre = isset($_POST['titreOffre']) ? $_POST['titreOffre'] : null;
$offrec = new OffreC();
$candidatures = $offrec->listeCandidatures($_SESSION["idOffre"]);

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
    

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">  
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <?php
      if(!isset($_SESSION['id'])) {
          header("location: ../login.php");
          exit;
      }
      else{
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
    border: 2px solid #8b0000; /* Couleur de bordure rouge bordeaux */
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
            color: #8b0000; /* Rouge bordeaux */
        }
        
        .offer-details p {
            color: #666;
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
            background-color: #7b0000; /* Variation de la couleur au survol */
            text-decoration: underline;
        }
        
        .offer:nth-child(even) {
            background-color: #ADA8A8; /* Couleur de fond de chaque ligne de liste (pairs) */
        }
        
        .offer:nth-child(odd) {
            background-color: #908B8B; /* Couleur de fond de chaque ligne de liste (impairs) */
        }

        .date-offre {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #666; /* Couleur du texte pour la date */
            font-size: 14px; /* Taille de la police pour la date */
        }
        .pagination-button {
    display: inline-block;
    width: 25px; /* Taille fixe pour des boutons ronds */
    height: 25px; /* Taille fixe pour des boutons ronds */
    border-radius: 50%; /* Rendre le bouton complètement rond */
    background-color: red;
    color: white;
    text-align: center;
    line-height: 25px; /* Centrer le texte verticalement */
    font-size: 14px; /* Taille de la police */
    cursor: pointer;
    transition: background-color 0.3s;
}

.pagination-button:hover {
    background-color: #7b0000;
}

.prev,
.next {
    width: 25px; /* Taille fixe pour des boutons ronds */
    height: 25px; /* Taille fixe pour des boutons ronds */
    border-radius: 50%; /* Rendre le bouton complètement rond */
    background-color: red;
    color: white;
    text-align: center;
    line-height: 25px; /* Centrer le texte verticalement */
    font-size: 14px; /* Taille de la police */
    cursor: pointer;
    transition: background-color 0.3s;
}

.prev:hover,
.next:hover {
    background-color: #7b0000;
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
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"> liste des offres</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
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
                <a href="ajouterOffre.php"  class="btn btn-block btn-light btn-md" style="border: 1px solid #000;"><span class="icon-open_in_new mr-2"></span>publier offre</a>
              </div>
            </div>
          </div>
        </div>



        <div class="row mb-5">
          <div class="col-lg-12">
            <body>
              <div class="container py-4">
                  <div class="card">
                      <div class="card-header bg-primary text-white">
                          <h3 class="mb-0" style="color: #fff;">Détails des candidatures pour l'offre d'emploi</h3>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>Date de la candidature</th>
                                          <th>titre de l'offre associée</th>
                                          <th>etat candidature</th>
                                          <th>CV</th>
                                       
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach($candidatures as $candidature) { 
                                        $offrecc = new OffreC();
                                        $titreOffre = $offrecc->recupererTitreOffre($candidature['idOffre']);  
                                      ?>
                                      <tr>
                                          <td><?php echo $candidature['dateCandidature']; ?></td>
                                          <td><?php echo  $titreOffre['titreOffre']; ?></td>
                                          <td><?php echo $candidature['etatCandidature']; ?></td>
                                      
                                          <td>
                                              <div class="col-md-4 mb-3">
                                                  <a data-fancybox data-type="iframe" data-src="<?php echo 'data:application/pdf;base64,' . base64_encode($candidature['cvOffre']); ?>" href="javascript:;" class="btn" style="background-color: #7F848C; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Voir CV</a>
                                              </div>
                                          </td>
                                     
                                          <td><button onclick="confirmerSuppression(<?php echo $candidature['idCandidature']; ?>)" class="btn btn-danger">Supprimer</button></td>
                                          <?php if ($candidature['etatCandidature'] === 'en cours de traitement') { ?>
    <td>
        <a href="changerEtatCandidature.php?idCandidature=<?php echo $candidature['idCandidature']; ?>&idOffre=<?php echo $candidature['idOffre']; ?>&action=accepter" class="btn btn-success" style="background-color: #2E933C; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;" >Accepter</a>
    </td>
    <td>
        <a href="changerEtatCandidature.php?idCandidature=<?php echo $candidature['idCandidature']; ?>&idOffre=<?php echo $candidature['idOffre']; ?>&action=refuser" class="btn"  style="background-color: #E9924A; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Refuser</a>
    </td>
<?php } ?>

                <?php if ($candidature['etatCandidature'] === 'accepté') { ?>
                  <td>
                    <a href="add.php" class="btn btn-info">Créer Entretien</a>
                    </td>
                <?php } ?>
           

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
          
                                      </td>
                                      </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>
                          </div>
                          <div class="text-center mt-4">
                              <a href="index.php" class="btn btn-primary">Retour</a>
                          </div>
                      </div>
                  </div>
              </div>
          </body>
     
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

  
   
   
     
  </body>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Fancybox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
   
</html>