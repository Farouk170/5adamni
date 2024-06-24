<?php
  session_start();
  include '../../../Controller/UserController.php';
 
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
    if (isset($_GET['idOffre'])){
        $offreC = new OffreC();
        $result = $offreC->recupererOffre($_GET['idOffre']);
        foreach($result as $Offre){
            $idOffre = $Offre['idOffre'];
            $titreOffre = $Offre['titreOffre'];
            $logo = $Offre['logo'];
            $descOffre = $Offre['descOffre'];
            $salaireOffre = $Offre['salaireOffre'];
            $typeContrat = $Offre['typeContrat'];
            $localOffre = $Offre['localOffre'];
            $dateP_offre = $Offre['dateP_offre'];
            $dateEx_offre = $Offre['dateEx_offre'];
            $compOffre = $Offre['compOffre'];
            $nvEttude = $Offre['nvEttude'];
            $expOffre = $Offre['expOffre'];
            $catgOffre = $Offre['catgOffre'];
            $statutOffre = $Offre['statutOffre'];
            $nbPostes = $Offre['nbPostes'];
            $langOffre = $Offre['langOffre'];
            $cleOffre = $Offre['cleOffre'];
          }
        }
    ?>

<?php
  
  if (isset($_POST['modifier'])){
      $offre = new Offre(
          $_POST['titreOffre'],
          $logo,
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
          $_POST['langOffre'],
          $_POST['cleOffre'],
          0,
          0,
          $_SESSION['id']
          
      );
      $offreC->modifierOffre($offre, $_POST['id_ini']);
      // Redirection vers la liste des offres
       header('Location: index.php');
       exit();
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">    

    <style>
    
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            color:black;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: red;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        button {
            background-color: transparent;
            border: none;
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
            margin-bottom: 20px;
            display: block;
            text-align: center;
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
            <h1 class="text-white font-weight-bold">Modifier offre</h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <a href="#">Job</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Modifier offre</strong></span>
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
          <h1>Modifier Offre</h1>
  
    <hr>
   
    <form id="offreForm" method="POST" enctype="multipart/form-data">
        <label>Titre Offre:</label>
        <input type="text" name="titreOffre" id="titreOffre" value="<?php echo $titreOffre ?>" >
        <span id="titreOffreError" style="color: red;" class="error-message"></span>
		<div class="form-group">
            <label for="descOffre">Description Offre</label>
            <textarea id="descOffre" name="descOffre" class="form-control" rows="5" ><?php echo $descOffre ?></textarea>
        </div>
        <label>Salaire Proposé:</label>
        <input type="number" name="salaireOffre" id="salaireOffre"  step="0.01"  value="<?php echo $salaireOffre ?>" >
        <label>Type de Contrat:</label><br>
         <select name="typeContrat" id="typeContrat">
         <option value="CDI"<?php if ($typeContrat === 'CDI') echo ' selected'; ?>>CDI</option>
            <option value="CDD"<?php if ($typeContrat === 'CDD') echo ' selected'; ?>>CDD</option>
            <option value="Stage"<?php if ($typeContrat === 'Stage') echo ' selected'; ?>>Stage</option>
                
                <!-- Add more options as needed -->
            </select>
            <br>
            <br>
        <label>Localisation:</label>
        <input type="text" name="localOffre" id="localOffre" value="<?php echo $localOffre ?>" >
        <label>Date de Publication:</label>
        <input type="text" name="dateP_offre" readonly value="<?php echo $dateP_offre ?>" >
        <label>Date d'Expiration:</label><br>
        <input type="date" name="dateEx_offre" id="dateEx_offre" value="<?php echo $dateEx_offre ?>" ><br><br>
        <label>Compétences Requises:</label>
        <input type="text" name="compOffre" id="compOffre" value="<?php echo $compOffre ?>" >
        <label>Niveau d'Étude:</label> <br>
        <select name="nvEttude" id="nvEttude"> 
            <option value="Bac" <?php if ( $nvEttude === 'Bac') echo 'selected'; ?>>Bac</option>
            <option value="Bac+2" <?php if ($nvEttude  === 'Bac+2') echo 'selected'; ?>>Bac+2</option>
            <option value="Bac+3" <?php if ( $nvEttude  === 'Bac+3') echo 'selected'; ?>>Bac+3</option>
            <option value="Bac+5 et plus" <?php if ( $nvEttude  === 'Bac+5 et plus') echo 'selected'; ?>>Bac+5 et plus</option>
            <!-- Ajoutez d'autres options au besoin -->
        </select>
<br><br>
        <label>Expérience:</label><br>
        <select name="expOffre" id="expOffre">
            <option value="Débutant" <?php if($expOffre=== 'Débutant') echo 'selected'; ?>>Débutant</option>
            <option value="1-2 ans" <?php if($expOffre=== '1-2 ans') echo 'selected'; ?>>1-2 ans</option>
            <option value="3-5 ans" <?php if($expOffre === '3-5 ans') echo 'selected'; ?>>3-5 ans</option>
            <option value="5 ans et plus" <?php if($expOffre=== '5 ans et plus') echo 'selected'; ?>>5 ans et plus</option>
        <!-- Add more options as needed -->
        </select>
<br>
<br>
        <label>Catégorie:</label><br>
        <select name="catgOffre" id="catgOffre">
            <option value="Administration et gestion" <?php if( $catgOffre=== 'Administration et gestion') echo 'selected'; ?>>Administration et gestion</option>
            <option value="Ventes et marketing" <?php if($catgOffre=== 'Ventes et marketing') echo 'selected'; ?>>Ventes et marketing</option>
            <option value="Informatique et technologie" <?php if( $catgOffre === 'Informatique et technologie') echo 'selected'; ?>>Informatique et technologie</option>
            <option value="Ressources humaines" <?php if( $catgOffre=== 'Ressources humaines') echo 'selected'; ?>>Ressources humaines</option>
            <option value="Finance et comptabilité" <?php if( $catgOffre=== 'Finance et comptabilité') echo 'selected'; ?>>Finance et comptabilité</option>
            <option value="Services à la clientèle" <?php if( $catgOffre=== 'Services à la clientèle') echo 'selected'; ?>>Services à la clientèle</option>
            <option value="Ingénierie" <?php if( $catgOffre=== 'Ingénierie') echo 'selected'; ?>>Ingénierie</option>
            <option value="Design et création" <?php if( $catgOffre=== 'Design et création') echo 'selected'; ?>>Design et création</option>
            <option value="Santé et médecine" <?php if( $catgOffre === 'Santé et médecine') echo 'selected'; ?>>Santé et médecine</option>
            <option value="Enseignement et formation" <?php if( $catgOffre === 'Enseignement et formation') echo 'selected'; ?>>Enseignement et formation</option>
            <option value="Juridique et conseil" <?php if( $catgOffre === 'Juridique et conseil') echo 'selected'; ?>>Juridique et conseil</option>
            <option value="Médias et communication" <?php if( $catgOffre === 'Médias et communication') echo 'selected'; ?>>Médias et communication</option>
            <option value="Sciences et recherche" <?php if( $catgOffre=== 'Sciences et recherche') echo 'selected'; ?>>Sciences et recherche</option>
            <option value="Logistique et transport" <?php if( $catgOffre === 'Logistique et transport') echo 'selected'; ?>>Logistique et transport</option>
            <option value="Arts et divertissement" <?php if( $catgOffre === 'Arts et divertissement') echo 'selected'; ?>>Arts et divertissement</option>
            <!-- Ajoutez d'autres catégories au besoin -->
        </select>
        <br><br>
        
        <label>Statut de l'Offre:</label><br>
        <select name="statutOffre" id="statutOffre">
            <option value="ouvert"<?php if ($statutOffre === 'ouvert') echo ' selected'; ?>>ouvert</option>
            <option value="ferme"<?php if ($statutOffre === 'ferme') echo ' selected'; ?>>ferme</option>
            <option value="en cours"<?php if ($statutOffre === 'en cours') echo ' selected'; ?>>en cours</option>
                 <!-- Add more options as needed -->
        </select>
        <br><br>
        <label>Nombre de Postes:</label>
        <input type="number" name="nbPostes" id="nbPostes" value="<?php echo $nbPostes ?>" >
        <label>Langue:</label>
        <input type="text" name="langOffre" id="langOffre" value="<?php echo $langOffre ?>" >
        <label>Clé de l'Offre:</label>
        
        <input type="text" name="cleOffre" id="cleOffre" value="<?php echo $cleOffre ?>"  oninput="showSuggestions()">
        <ul id="suggestionList"></ul>
        <input type="hidden" name="id_ini" value="<?php echo $_GET['idOffre']; ?>">
        <input type="submit" name="modifier" value="Modifier">
    </form>
 
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
   
   
     
  </body>
  <script>
    // Fonction de validation du formulaire
    function validateForm() {
        // Récupération de la valeur du champ titreOffre
        var titreOffre = document.getElementById("titreOffre").value;
        // Récupération de la valeur du champ descriptionOffre
        var descriptionOffre = document.getElementById("descOffre").value;
        var salaire = document.getElementById("salaireOffre").value;
        var localOffre = document.getElementById("localOffre").value;
        
        var compOffre = document.getElementById("compOffre").value;
        var nbPostes = document.getElementById("nbPostes").value;
        var langOffre = document.getElementById("langOffre").value;
        var cleOffre = document.getElementById("cleOffre").value;
        var today = new Date(); // Date d'aujourd'hui


        // Expression régulière pour vérifier si le titre contient uniquement des lettres
        var letters = /^[A-Za-z]+$/;
        var numbersOnly = /^[0-9]+$/;
        var descInput = $("#descOffre").val();
        var mots = descInput.split(/\s+/); 

        // Validation du titre de l'offre
        if (titreOffre.trim() === "") {
            alert("Le titre de l'offre est requis.");
            return false;
        } else if (!/^[A-Za-z\s]+$/.test(titreOffre)) {
            alert("Le titre de l'offre doit contenir uniquement des lettres.");
            return false;
        }
/*
         //Validation de la description de l'offre
        if (descriptionOffre.trim() === "") {
            alert("La description de l'offre est requise.");
            return false;
        }
        /*
        else if (!descriptionOffre.match(letters)) {
            alert("La description de l'offre doit contenir uniquement des lettres.");
            return false;
        }*/
        if (descriptionOffre.trim() === "") {
            alert("La description de l'offre est requise.");
            return false;
        }
        if (mots.length < 30) {
          alert("La description doit contenir au moins 30 mots.");
    
    return false;
       } 
        if (parseFloat(salaire) <= 0 || isNaN(parseFloat(salaire))) {
            alert("Le salaire proposé doit être un nombre positif.");
            return false;
        }

              // Validation de la localisation de l'offre
              if (localOffre.trim() === "") {
            alert("La localisation de l'offre est requise.");
            return false;
        }
        else if (!/^[A-Za-z\s]+$/.test(localOffre)) {
            alert("La localisation de l'offre doit contenir uniquement des lettres.");
            return false;
        }
              


            // Validation des compétences requises
            if (compOffre.trim() === "") {
            alert("Les compétences requises sont requises.");
            return false;
        }
        else if (!compOffre.match(letters)) {
            alert("competence(s) de l'offre doit contenir uniquement des lettres.");
            return false;
        }
        // Validation du nombre de postes (doit être un nombre positif)
        if (isNaN(nbPostes) || nbPostes <= 0) {
            alert("Le nombre de postes doit être un nombre positif.");
            return false;
        }

          // Validation de la langue (doit contenir des chaînes séparées par des virgules et ne doit pas être vide)
          if (langOffre.trim() === "") {
            alert("La langue de l'offre est requise.");
            return false;
        }
              // Validation du champ langue (doit contenir des chaînes de caractères et des virgules)
    if (  /^[0-9]+$/.test(langOffre)) {
        alert("Le champ langue doit contenir uniquement des lettres, des espaces et des virgules.");
        return false;
    }

        // Validation du champ clé de l'offre (ne doit pas être vide)
        if (cleOffre.trim() === "") {
        alert("La clé de l'offre est requise.");
        return false;
    }else if (!/^[A-Za-zÀ-ÿ\s]+$/u.test(cleOffre)) {
            alert("cle de l'offre doit contenir uniquement des lettres.");
            return false;
        }




        
    var dateExpirationInput = $("#dateEx_offre").val();
    var erreurDateExpiration = $("#dateEx_offreError");

    if (dateExpirationInput.trim() === "") {
      alert("La date d'expiration est requise");
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
      alert("La date d'expiration doit être ultérieure à la date d'aujourd'hui");
        
        return false;
    } else if (dateExpiration <= dateLimite) {
      alert("La date d'expiration doit être au moins 15 jours après la date d'aujourd'hui")
      
        return false;
    } 


        // Si toutes les validations réussissent, retourne true
        return true;
    }

    // Ajout d'un gestionnaire d'événement pour le formulaire
    document.getElementById("offreForm").addEventListener("submit", function(event) {
        // Empêche la soumission du formulaire si la validation échoue
        if (!validateForm()) {
            event.preventDefault();
        }
    });

  





</script>

</html>