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
include '../../../Controller/OffreC.php';
include '../../../Model/offre.php';

$offrec=new OffreC();
$s=0;
if(
  isset($_POST['titreOffre'])&&
  isset($_FILES["logo"]) &&
  isset($_POST['descOffre'])&&
  isset($_POST['salaireOffre'])&&
  isset($_POST['typeContrat'])&&
  isset($_POST['localOffre'])&&
  isset($_POST['dateP_offre'])&&
  isset($_POST['dateEx_offre'])&&
  isset($_POST['compOffre'])&&
  isset($_POST['nvEttude'])&&
  isset($_POST['expOffre'])&&
  isset($_POST['catgOffre'])&&
  isset($_POST['statutOffre'])&&
  isset($_POST['nbPostes'])&&
  isset($_POST['langues'])&&
  isset($_POST['cleOffre'])&&
   isset($_POST['latitude'])&&
   isset($_POST['longitude'])
  )
{

    $fileTmpPath = $_FILES["logo"]["tmp_name"];
$fileContent = file_get_contents($fileTmpPath);
//echo $fileContent;
$langues = implode(',', $_POST['langues']);
// Insérez le contenu de l'image dans une variable string
//$imageString = base64_encode($fileContent);

$offre=new Offre(
  $_POST['titreOffre'],
  $fileContent,
  $_POST['descOffre'],
  $_POST['salaireOffre'],
  $_POST['typeContrat'],
  $_POST['localOffre'],
  $_POST['dateP_offre'],
  $_POST['dateEx_offre'],
  $_POST['compOffre'],
  $_POST['nvEttude'],
  $_POST['expOffre'],
  $_POST['catgOffre'],
  $_POST['statutOffre'],
  $_POST['nbPostes'],
  $langues,
  $_POST['cleOffre'],
  $_POST['latitude'],
  $_POST['longitude'],
  $_SESSION['id']

);
    $s=1;
}

?>
<?php

  




if($s == 1) {
    $offrec->ajouterOffre($offre);
    require_once "Careerjet_API.php";

    $api = new Careerjet_API('en_GB');
    $page = 1; // Ou à partir des paramètres.
    
    $result = $api->search(array(
        'location' => 'Tunisia',
        'page' => $page,
        'affid' => '678bdee048',
    ));
    
    if ($result->type == 'JOBS') {
        // Affiche tous les titres des offres d'emploi dans une liste non numérotée
        echo "Titres des offres d'emploi :\n\n";
        echo "<ul>\n";
        foreach ($result->jobs as $job) {
            echo "<li>" . $job->title . "</li>\n";
        }
        echo "</ul>\n";
    
        // Ajouter les titres d'offres à la liste des titres surveillés
        $listeTitresSurveilles = array();
        foreach ($result->jobs as $job) {
            $listeTitresSurveilles[] = $job->title;
        }
    } else {
        echo "Aucune offre d'emploi n'a été trouvée.";
    }
    
    // Votre code pour ajouter l'offre, vérifier les titres surveillés et incrémenter le score
    foreach ($listeTitresSurveilles as $titreSurveille) {
        if (stripos($_POST['titreOffre'], $titreSurveille) !== false) {
            // Si une correspondance partielle est trouvée, incrémentez le score de l'offre
            $offrec->incrementerScoreOffre_2($_POST['titreOffre']);
            break; // Sortir de la boucle une fois qu'une correspondance est trouvée
        }
    }

    header('Location:index.php');
exit;
}
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
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">    
    <style>
        
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 16px;
        }
        input[type="file"] {
            width: calc(100% - 24px);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        input[type="submit"],
        input[type="reset"] {
            width: 48%;
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            margin-right: 2%;
        }
        input[type="reset"] {
            background-color: #f44336; /* Rouge */
        }
       
        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input[type="file"] {
            margin-top: 6px;
        }
        .form-group select {
            width: 100%;
            padding: 10px;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .form-row .form-group {
            width: calc(48% - 10px);
        }
        #statutOffre{
            border-color: green;
            border-width: 2px; /* Épaisseur de la bordure */
            border-style: solid; /* Style de la bordure */
            background-color: grey;
        }
        #dateP_offre {
            border-color: green;
            border-width: 2px; /* Épaisseur de la bordure */
            border-style: solid; /* Style de la bordure */
            background-color: grey;
        }
        .erreur-input {
            border-color: red !important; /* Couleur de la bordure en rouge */
            /* Autres styles pour les inputs en erreur */
        }
        .error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px;
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
            <h1 class="text-white font-weight-bold">publier un offre</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>publier un offre </strong></span>
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
                <h2>publier votre offre</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-6">
                <a href="index.php"  class="btn btn-block btn-light btn-md" style="border: 1px solid #000;"><span class="icon-open_in_new mr-2"></span>liste </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">
          <form id="offreForm" action="" method="POST" enctype="multipart/form-data">
    <h2>Ajouter une offre d'emploi</h2>
    <div class="form-row">
        <div class="form-group">
            <label for="titreOffre">Titre offre</label>
            <div>
        <h2>Localisation actuelle</h2>
        <p id="demo"></p>
    </div>

    <!-- Ajoutez des champs de formulaire pour la latitude et la longitude -->
    <div style="display: none;">
        <input type="text" name="latitude" id="latitude">
        <input type="text" name="longitude" id="longitude">
    </div>

    <!-- Bouton pour obtenir la localisation -->
    <div>
        <button onclick="getLocation()">Obtenir la localisation</button> 
    </div>
            <input type="text" name="titreOffre" id="titreOffre">
            <span id="titreOffreError" style="color: red;" class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="logo">Logo</label>
        <input type="file" id="logo" name="logo" accept="image/*">
        <span id="logoError" style="color: red;" class="error-message"></span>
    </div>
    <div class="form-group">
        <label for="descOffre">Description de l'offre</label>
        <textarea name="descOffre" id="descOffre" cols="30" rows="5"></textarea>
        <span id="descOffreError" style="color: red;" class="error-message"></span>
         </div>
    <div class="form-row">
        <div class="form-group">
            <label for="salaireOffre">Salaire proposé</label>
            <input type="number" step="0.01" name="salaireOffre" id="salaireOffre">
            <span id="salaireOffreError" style="color: red;" class="error-message"></span>
        </div>
        <div class="form-group">
            <label for="typeContrat">Type du contrat</label>
            <select name="typeContrat" id="typeContrat">
                <option value="CDI">CDI</option>
                <option value="CDD">CDD</option>
                <option value="Stage">Stage</option>
                <option value="Alternance">Alternance</option>
                <!-- Add more options as needed -->
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="localOffre">Localisation de l'offre</label>
            <input type="text" name="localOffre" id="localOffre">
            <span id="localOffreError" style="color: red;" class="error-message"></span>
            
        </div>
        <div class="form-group">
    <label for="dateP_offre">Date publication de l'offre</label>
    <?php
        // Obtenez la date actuelle au format Y-m-d H:i:s (année-mois-jour heure:minute:seconde)
        $datePublication = date('Y-m-d H:i:s');
    ?>
    <input type="text" name="dateP_offre" id="dateP_offre" readonly value="<?php echo $datePublication; ?>">
</div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="dateEx_offre">Date expiration des candidatures</label>
            <input type="date" name="dateEx_offre" id="dateEx_offre">
            <span id="dateEx_offreError" style="color: red;" class="error-message"></span>
            
        </div>
        <div class="form-group">
            <label for="expOffre">Expérience</label>
            <select name="expOffre" id="expOffre">
                <option value="Débutant">Débutant</option>
                <option value="1-2 ans">1-2 ans</option>
                <option value="3-5 ans">3-5 ans</option>
                <option value="5 ans et plus">5 ans et plus</option>
                <!-- Add more options as needed -->
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
                <label for="nvEttude">Niveau d'étude demandé</label>
                <select name="nvEttude" id="nvEttude">
                    <option value="Bac">Bac</option>
                    <option value="Bac+2">Bac+2</option>
                    <option value="Bac+3">Bac+3</option>
                    <option value="Bac+5 et plus">Bac+5 et plus</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        <div class="form-group">
            <label for="compOffre">Compétences</label>
            <input type="text" name="compOffre" id="compOffre">
            <span id="compOffreError" style="color: red;" class="error-message"></span>
           
        </div>
    </div>
    <div class="form-group">
    <label for="catgOffre">Catégorie offre</label>
    <select name="catgOffre" id="catgOffre">
        <option value="Administration et gestion">Administration et gestion</option>
        <option value="Ventes et marketing">Ventes et marketing</option>
        <option value="Informatique et technologie">Informatique et technologie</option>
        <option value="Ressources humaines">Ressources humaines</option>
        <option value="Finance et comptabilité">Finance et comptabilité</option>
        <option value="Services à la clientèle">Services à la clientèle</option>
        <option value="Ingénierie">Ingénierie</option>
        <option value="Design et création">Design et création</option>
        <option value="Santé et médecine">Santé et médecine</option>
        <option value="Enseignement et formation">Enseignement et formation</option>
        <option value="Juridique et conseil">Juridique et conseil</option>
        <option value="Médias et communication">Médias et communication</option>
        <option value="Sciences et recherche">Sciences et recherche</option>
        <option value="Logistique et transport">Logistique et transport</option>
        <option value="Arts et divertissement">Arts et divertissement</option>
        <!-- Ajoutez d'autres catégories au besoin -->
    </select>
</div>

        <div class="form-group">
            <label for="statutOffre">Statut offre</label>
            <input type="text" name="statutOffre" id="statutOffre" value="ouvert" readonly>
        </div>
        <div class="form-row">
        <div class="form-group">
            <label for="nbPostes">Nombre de postes</label>
            <input type="number" name="nbPostes" id="nbPostes">
            <span id="nbPostesError" style="color: red;" class="error-message"></span>
            
        </div>
        <div class="form-group">
             <label for="langues">Langues demandées</label>
           <select name="langues[]" id="langues" multiple>
        <option value="Anglais">Anglais</option>
        <option value="Français">Français</option>
        <option value="Espagnol">Espagnol</option>
        <option value="Allemand">Allemand</option>
        <option value="Hindi">Hindi</option>
        <option value="Japonais">Japonais</option>
        <option value="chinois">chinois</option>
        <option value="Russe">Russe</option>
        <option value="Arabe">Arabe</option>
        <option value="Portugais">Portugais</option>
        <option value="italien">italien</option>
        <!-- Ajoutez d'autres langues au besoin -->
    </select>
        </div>
    </div>
    <div class="form-group">
        <label for="cleOffre">Mot clé</label>
        <input type="text" name="cleOffre" id="cleOffre">
        <span id="cleOffreError" style="color: red;" class="error-message"></span>
        
    </div>
    <div class="form-row">
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </div>
    </div>
   
 
</form>



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

   
    
   
     
  </body>
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
    <script src="offre.js"> </script>
  <!-- Template Javascript -->
  <script src="js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  
  <script>
document.addEventListener("DOMContentLoaded", function() {
  // Sélectionnez tous les champs de saisie du formulaire
  var fields = document.querySelectorAll('input[type="text"], input[type="number"], textarea, select');

  // Attachez un écouteur d'événements à chaque champ
  fields.forEach(function(field, index) {
    field.addEventListener('keydown', function(event) {
      // Si la touche Entrée est enfoncée et que le champ actuel n'est pas le dernier
      if (event.keyCode === 13 && index < fields.length - 1) {
        // Empêcher le comportement par défaut du formulaire
        event.preventDefault();
        // Passer le focus au champ suivant
        fields[index + 1].focus();
      }
    });
  });
});
</script>

<script >
$(function() {
    // Liste de villes tunisiennes pour l'autocomplétion
    var villesTunisiennes = [
        "Tunis", "Sfax", "Sousse", "Kairouan", "Bizerte", "Gabès", "Ariana", "Gafsa", "Monastir", "Ben Arous", 
        "Kasserine", "Nabeul", "La Marsa", "Médenine", "Beja", "Mahdia", "Zarzis", "El Mourouj", "Sidi Bouzid",
        "Tataouine", "Jendouba", "Douz", "Siliana", "Manouba", "Kebili", "La Goulette", "Rades", "Hammam-Lif",
        "Djerba", "Fériana", "Korba", "Oued Ellil", "Hammam Sousse", "Ksour Essaf", "Menzel Temime", "Chebba",
        "Zaghouan", "Jammel", "Menzel Bourguiba", "Kalâa Kebira", "Mateur", "Dahmani", "Menzel Jemil", "Aïn Draham",
        "Ghannouch", "Galaat el Andeless", "El Alia", "Amdoun", "Sakiet Sidi Youssef", "Sakiet Ezzit", "Menzel Kamel",
        "El Haouaria", "Akouda", "Séjnane", "Zaouiet Djedidi", "Ksibet el Mediouni", "Nadhour", "Sbikha", "Oueslatia",
        "Kalaat Senan", "Bir Mcherga", "Majaz al Bab", "Bou Arada", "Touza", "El Ksar", "Oued Meliz", "El Aroussa",
        "Menzel Abderhaman", "Menzel Fersi", "Nabeur", "Menzel Hayet", "Menzel Chaker", "Menzel Ennour", "Téboulba",
        "Menzel Salem", "Nasrallah", "Menzel El Khair", "Hajeb El Ayoun", "Chihia", "Menzel Bouzaiane", "Sanghé", 
        "Menzel Meherzi", "Menzel El Habib", "Ksibet el Aïdi", "Menzel Temime", "Ksibet Thrayet", "Menzel Jemil", 
        "Teboursouk", "Menzel Horr", "Bou Hajla", "Menzel Farsi", "Menzel Salem", "Menzel El Khair", "El Batan",
        "Menzel Bouzelfa", "Béni Khalled", "Ghar al Milh", "Sajnen", "Menzel Chamekh", "Foussana", "Hadjerat Ennous",
        "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime", "Sekhira", "Menzel El Amra",
        "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri", "La Sebala du Mornag",
        "Sakiet Eddaïer", "Mellouleche", "Menzel Jemil", "Foussana", "Hadjerat Ennous", "Tinja", "El Hencha",
        "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime", "Sekhira", "Menzel El Amra", "El Alâa",
        "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri", "La Sebala du Mornag", 
        "Sakiet Eddaïer", "Mellouleche", "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", 
        "Menzel Tmime", "Sekhira", "Menzel El Amra", "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker",
        "Dar Châabane El Fehri", "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Menzel El Habib", 
        "El Batan", "Menzel Bouzelfa", "Béni Khalled", "Ghar al Milh", "Sajnen", "Menzel Chamekh", "Foussana",
        "Hadjerat Ennous", "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime",
        "Sekhira", "Menzel El Amra", "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri", 
        "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", 
        "Joumine", "Menzel Tmime", "Sekhira", "Menzel El Amra", "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker",
        "Dar Châabane El Fehri", "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Menzel Chaker", "Dar Châabane El Fehri",
        "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Menzel El Habib", "El Batan", "Menzel Bouzelfa",
        "Béni Khalled", "Ghar al Milh", "Sajnen", "Menzel Chamekh", "Foussana", "Hadjerat Ennous", "Tinja",
        "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime", "Sekhira", "Menzel El Amra",
        "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri", "La Sebala du Mornag",
        "Sakiet Eddaïer", "Mellouleche", "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine",
        "Menzel Tmime", "Sekhira", "Menzel El Amra", "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker",
        "Dar Châabane El Fehri", "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Menzel El Habib", "El Batan",
        "Menzel Bouzelfa", "Béni Khalled", "Ghar al Milh", "Sajnen", "Menzel Chamekh", "Foussana", "Hadjerat Ennous",
        "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime", "Sekhira", "Menzel El Amra",
        "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri", "La Sebala du Mornag",
        "Sakiet Eddaïer", "Mellouleche", "Tinja", "El Hencha", "Menzelet Ejjarna", "El Golâa", "Joumine", "Menzel Tmime",
        "Sekhira", "Menzel El Amra", "El Alâa", "Ghardimaou", "Ksibet Thrayet", "Menzel Chaker", "Dar Châabane El Fehri",
        "La Sebala du Mornag", "Sakiet Eddaïer", "Mellouleche", "Menzel Chaker", "Dar Châabane El Fehri", "La Sebala du Mornag",
        "Sakiet Eddaïer", "Mellouleche"
    ];

    // Activation de l'autocomplétion pour le champ de localisation
    $("#localOffre").autocomplete({
        source: villesTunisiennes
    });
});



$(function() {
// Validation du formulaire lors de la soumission
$("#offreForm").submit(function(event) {
    // Appel des fonctions de validation pour chaque champ
    var titreValide = validerTitre();
    var logoValide = validerLogo();
    var descValide = validerDescription();
    var salaireValide = validerSalaire();
   var  localValide = validerLocalisation();
   var dateExVAlide =validerDateExpiration();
   var nbPostesValide = validerNbPostes();
   var motCleValide = validerMotCle();
   var competenceVAlide = validerCompetences();
    // Ajoutez d'autres fonctions de validation pour les autres champs

    // Vérification globale
    if (!titreValide || !logoValide || !descValide || !salaireValide || !localValide || !dateExVAlide || !nbPostesValide || !motCleValide || !competenceVAlide) {
        // Empêcher la soumission du formulaire si un champ est invalide
        event.preventDefault();
    }
});

// Fonction de validation du titre
function validerTitre() {
var titreInput = $("#titreOffre");
var erreurTitre = $("#titreOffreError");
var regex = /^[A-Za-z\s]+$/; // Expression régulière pour les chaînes de caractères

if (titreInput.val().trim() === "") {
    erreurTitre.html("<span style='color:red'>Le titre est requis</span>");
    titreInput.addClass("erreur-input"); // Ajouter la classe en cas d'erreur
    return false;
} else if (!regex.test(titreInput.val())) {
    erreurTitre.html("<span style='color:red'>Le titre ne doit contenir que des lettres</span>");
    titreInput.addClass("erreur-input"); // Ajouter la classe en cas d'erreur
    return false;
} else {
    erreurTitre.html("");
    titreInput.removeClass("erreur-input"); // Retirer la classe si tout est valide
    return true;
}
}




// Fonction de validation du logo
function validerLogo() {
    var logoInput = $("#logo").val();
    var erreurLogo = $("#logoError");

    if (logoInput === "") {
        erreurLogo.html("<span style='color:red'> logo est requis</span>");
        return false;
    } else {
        erreurLogo.html("");
        return true;
    }
}

// Fonction de validation de la description
function validerDescription() {
var descInput = $("#descOffre").val();
var erreurDesc = $("#descOffreError");

// Séparer la description en mots
var mots = descInput.split(/\s+/); // Sépare la chaîne en mots (utilisez un espace comme séparateur)

if (descInput.trim() === "") {
    erreurDesc.html("<span style='color:red'>La description est requise</span>");
    return false;
} else if (mots.length < 30) {
    erreurDesc.html("<span style='color:red'>La description doit contenir au moins 30 mots</span>");
    return false;
} else {
    erreurDesc.html("");
    return true;
}
}


// Fonction de validation du salaire
function validerSalaire() {
var salaireInput = parseFloat($("#salaireOffre").val()); // Convertir la valeur du salaire en nombre flottant
var erreurSalaire = $("#salaireOffreError");

if (isNaN(salaireInput)) {
    erreurSalaire.html("<span style='color:red'>Le salaire doit être un nombre</span>");
    return false;
} else if (salaireInput <= 0) {
    erreurSalaire.html("<span style='color:red'>Le salaire doit être positif</span>");
    return false;
} else {
    erreurSalaire.html("");
    return true;
}
}
function validerLocalisation() {
var localisationInput = $("#localOffre").val();
var erreurLocalisation = $("#localOffreError");

if (localisationInput.trim() === "") {
    erreurLocalisation.html("<span style='color:red'>La localisation est requise</span>");
    return false;
} else if (!/^[A-Za-z\s]+$/.test(localisationInput)) {
    erreurLocalisation.html("<span style='color:red'>La localisation ne doit contenir que des lettres et des espaces</span>");
    return false;
} else {
    erreurLocalisation.html("");
    return true;
}
}


function validerDateExpiration() {
    var dateExpirationInput = $("#dateEx_offre").val();
    var erreurDateExpiration = $("#dateEx_offreError");

    if (dateExpirationInput.trim() === "") {
        erreurDateExpiration.html("<span style='color:red'>La date d'expiration est requise</span>");
        return false;
    }

    // Convertir la date d'expiration en objet Date
    var dateExpiration = new Date(dateExpirationInput);

    // Obtenir la date d'aujourd'hui
    var dateAujourdhui = new Date();
    
    // Ajouter 15 jours à la date actuelle
    var dateLimite = new Date(dateAujourdhui);
    dateLimite.setDate(dateLimite.getDate() + 15);

    if (dateExpiration <= dateAujourdhui) {
        erreurDateExpiration.html("<span style='color:red'>La date d'expiration doit être ultérieure à la date d'aujourd'hui</span>");
        return false;
    } else if (dateExpiration <= dateLimite) {
        erreurDateExpiration.html("<span style='color:red'>La date d'expiration doit être au moins 15 jours après la date d'aujourd'hui</span>");
        return false;
    } else {
        erreurDateExpiration.html("");
        return true;
    }
}



function validerNbPostes() {
var nbPostesInput = $("#nbPostes").val();
var erreurNbPostes = $("#nbPostesError");

if (nbPostesInput.trim() === "") {
    erreurNbPostes.html("<span style='color:red'>Le nombre de postes est requis</span>");
    return false;
} else if (parseInt(nbPostesInput) <= 0) {
    erreurNbPostes.html("<span style='color:red'>Le nombre de postes doit être positif</span>");
    return false;
} else {
    erreurNbPostes.html("");
    return true;
}
}

function validerMotCle() {
var motCleInput = $("#cleOffre").val();
var erreurMotCle = $("#cleOffreError");

if (motCleInput.trim() === "") {
    erreurMotCle.html("<span style='color:red'>Le champ mot-clé est requis</span>");
    return false;
} else if (!/^[A-Za-z]+$/.test(motCleInput)) {
    erreurMotCle.html("<span style='color:red'>Le mot-clé ne doit contenir que des lettres</span>");
    return false;
} else {
    erreurMotCle.html("");
    return true;
}
}

function validerCompetences() {
var competencesInput = $("#compOffre");
var erreurCompetences = $("#compOffreError");
var regex = /^[A-Za-z\s]+$/; // Expression régulière pour les chaînes de caractères

if (competencesInput.val().trim() === "") {
    erreurCompetences.html("<span style='color:red'>Les compétences sont requises</span>");
    competencesInput.addClass("erreur-input"); // Ajouter la classe en cas d'erreur
    return false;
} else if (!regex.test(competencesInput.val())) {
    erreurCompetences.html("<span style='color:red'>Les compétences ne doivent contenir que des lettres</span>");
    competencesInput.addClass("erreur-input"); // Ajouter la classe en cas d'erreur
    return false;
} else {
    erreurCompetences.html("");
    competencesInput.removeClass("erreur-input"); // Retirer la classe si tout est valide
    return true;
}
}




// Ajoutez d'autres fonctions de validation pour les autres champs ici
});
 </script>


<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            document.getElementById("demo").innerHTML = "La géolocalisation n'est pas supportée par ce navigateur.";
        }
    }

    function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        
        // Mettre à jour les champs de formulaire avec la latitude et la longitude
        document.getElementById("latitude").value = latitude;
        document.getElementById("longitude").value = longitude;

        // Afficher la localisation sur la page
        document.getElementById("demo").innerHTML = "Latitude: " + latitude + "<br>Longitude: " + longitude;
    }
</script>
</html>