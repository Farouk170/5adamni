<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>5adamni</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
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
    /* Styles pour le fond noir */
    body {
        background-color: black;
        font-family: Arial, sans-serif;
        margin: 0;
        /* padding: 20px;*/ 
    }
    .search-input {
    color: black;
    border: none;
    border-radius: 3px; /* Réduire le rayon de bordure */
    padding: 5px 10px; /* Réduire le padding */
    font-weight: bold;
    cursor: pointer;
    font-size: 12px; /* Réduire la taille de la police */
}

.search-button {
    background-color: #8b0000;
    color: white;
    border: none;
    border-radius: 3px; /* Réduire le rayon de bordure */
    padding: 5px 10px; /* Réduire le padding */
    font-weight: bold;
    cursor: pointer;
    font-size: 12px; /* Réduire la taille de la police */
} 
.filtrer_offer {
        width: 49%; /* Réduire la largeur à 80% de la largeur parente */
    background-color:#161515; /* Couleur de fond sombre */
    color: #fff; /* Couleur du texte blanc */
    padding: 10px; /* Réduire le padding */
    border-radius: 9px; /* Réduire le rayon de bordure */
    margin-bottom: 10px; /* Réduire la marge en bas */
    box-shadow: 2 0 10px rgba(255, 255, 255, 0.1); /* Ombre blanche */
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border: 1px solid #8b0000; /* Couleur de bordure rouge bordeaux */
}
    /* Styles pour les offres */
    .offer {
    background-color: #9092A1; /* Couleur de fond sombre */
    color: black; /* Couleur du texte blanc */
    padding: 10px; /* Réduire le padding */
    border-radius: 9px; /* Réduire le rayon de bordure */
    margin-bottom: 10px; /* Réduire la marge en bas */
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); /* Ombre blanche */
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border: 2px solid #8b0000; /* Couleur de bordure rouge bordeaux */
}
.offer:nth-child(even) {
    
          background-color: #9092A1; /* Couleur de fond de chaque ligne de liste (pairs) */
      }
      
      .offer:nth-child(odd) {
            color:#626D87;
          background-color: #2C3344; /* Couleur de fond de chaque ligne de liste (impairs) */
      }


    .offer img {
        max-width: 70px;
        max-height:70px;
        border-radius: 8px;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .offer-details {
        flex-grow: 1;
        margin-right: 20px;
    }

    .offer-details h2 {
        margin-top: 0;
        color: #8b0000; /* Rouge bordeaux */
    }

    .offer-actions {
        align-self: flex-end;
        margin-top: auto;
    }

    .offer-actions button {
            padding: 6px 12px; /* Réduire le padding */
            background-color: #8b0000;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 9px; /* Réduire la taille de la police */
            margin-right: 5px; /* Réduire la marge */
            cursor: pointer;
        }

    .offer-actions button:hover {
        background-color: #7b0000;
        text-decoration: underline;
    }
    .date-offre {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #626D87;; /* Couleur du texte pour la date */
            font-size: 14px; /* Taille de la police pour la date */
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
                    <a href="../" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="../users/index.php" class="nav-item nav-link"><i class="fa bi-people-fill me-2"></i>Users</a>
                    <a class="nav-item nav-link active"><i class="fa bi-megaphone-fill me-2"></i>Offres</a>
                    <a href="../entretiens/entretiens.php" class="nav-item nav-link"><i class="fa bi-calendar-event-fill me-2"></i>Entretiens</a>
                    <a href="../Postes/postes.php" class="nav-item nav-link"><i class="fa bi-pen-fill me-2"></i>Postes</a>
                    <a href="../reclamations/reclamations.php" class="nav-item nav-link"><i class="fa bi-exclamation-octagon-fill me-2"></i>Reclamations</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
             <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a  class="navbar-brand d-flex d-lg-none me-4">
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
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <br>
            <!-- Navbar End -->
            <div class="filtrer_offer" >
                <form method="GET" action="">
                    <label for="tri">Trier par :</label>
                    <select class="search-input"  name="tri" id="tri">
                        <option value="dateP_offre">Date de Publication</option>
                        <option value="localOffre">Localisation</option>
                    </select>
                    <input class="search-input" type="text" name="search" id="search" placeholder="Rechercher par titre">
                    <button class="search-button">Trier/Rechercher</button>
                </form>
            </div>
            <div><br></div>
            <?php
    include '../../../Controller/OffreC.php';
    include '../../../Model/offre.php';

    $offrec = new OffreC();
    $liste = $offrec->AllOffers();
     
    
    if(isset($_GET['tri'])) {
        $tri = $_GET['tri'];

        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $_GET['search'];
            $liste = $offrec->rechercherParTitreAll($search);
        } else {
            $liste = $offrec->AllOffers();
        }
       
        // Fonction de tri personnalisée en fonction du critère choisi
        function comparerOffres($a, $b) {
            global $tri;
            if ($tri === 'dateP_offre') {
                // Tri par date de publication
                return strtotime($b[$tri]) - strtotime($a[$tri]);
            } elseif ($tri === 'localOffre') {
                // Tri par localisation
                return strcmp($a[$tri], $b[$tri]);
            }
            // Ajoutez d'autres cas pour d'autres critères de tri si nécessaire
        }
    
        // Tri des offres en utilisant la fonction de tri personnalisée
        usort($liste, 'comparerOffres');
    }
    

    foreach($liste as $Offre) {
    ?>

    
    <div class="offer" style="position: relative;">
    <div class="date-offre"  >
            <?php echo $Offre['dateP_offre']; ?>
            <div class="offer-actions">
                  
                  <form method="POST" action="detailleOffre.php">
                      <input type="submit" value="Voir Détails" style="background-color:#353131; color: white; border: 2px solid black; border-radius: 4px; padding: 6px 12px; font-weight: bold; cursor: pointer; font-size: 14px;">
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
            $description = substr($Offre['descOffre'], 0, 100);
            
            // Vérifier si la description a été tronquée
            if (strlen($Offre['descOffre']) > 100) {
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
                <tr>

                </tr>
                <td>
    <button onclick="window.location.href='modifierOffre.php?idOffre=<?php echo $Offre['idOffre']; ?>'" style="background-color: #353131; color: white; border: 2px solid black; border-radius: 4px; padding: 6px 12px; font-weight: bold; cursor: pointer; font-size: 14px;">
        Modifier ce poste
    </button>
</td>
<td>
    <button onclick="confirmerSuppression(<?php echo $Offre['idOffre']; ?>)" style="background-color:#353131; color: white; border: 2px solid black; border-radius: 4px; padding: 6px 12px; font-weight: bold; cursor: pointer; font-size: 14px;">
        Supprimer
    </button>
</td>
<tr> <form method="POST" action="afficherCand.php">
                      <input type="submit" value="voir les candidatures" style="background-color: #8b0000; color: white; border: none; border-radius: 4px; padding: 8px 16px; font-weight: bold; cursor: pointer;">
                      <input type="hidden" name="idOffre" value="<?php echo $Offre['idOffre']; ?>">
                  </form></tr>

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
                <tr>
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



            </tr>
               
            </table>

        </div>
       
    </div>
    <?php
    }
    ?>
            <!-- 404 End -->

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
</body>
</html>