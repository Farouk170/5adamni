<?php 
include '../../../Controller/OffreC.php';
include '../../../Model/Offre.php';
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
    $_POST['longitude']

);
    $s=1;
}

?>



<?php if($s==1)
//variable pour verifier si le formulaire est rempli
{
$offrec->ajouterOffre($offre);
echo "<script>alert('Offre ajoutée avec succès!');</script>";
//$offrec->listeOffres();
header('Location:Offres.php');
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

    <!-- Favicon -->
    <link href="../mini_logo.svg" rel="icon">

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
       
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #000000;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
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

.input_offre {
            
            border-width: 2px; /* Épaisseur de la bordure */
            border-style: solid; /* Style de la bordure */
            background-color:  #A22B0D ;
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
                <h3 class="text-primary"><img src="../logo.svg" style="width: 200px; height: 70px;"></h3>
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
            <form id="offreForm" action="" method="POST" enctype="multipart/form-data">

            <div>
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

    </div>
    <h1>Ajouter une offre d'emploi</h1>
    <div class="bg-secondary rounded h-100 p-4">
    <div class="form-group">
        <div class="form-group">
            <label for="titreOffre">Titre offre</label>
            <input type="text" name="titreOffre" id="titreOffre" class="input_offre" >
            <span id="titreOffreError" style="color: red;" class="error-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="logo">Logo</label>
        <input type="file" id="logo" name="logo"  class="input_offre" accept="image/*">
        <span id="logoError" style="color: red;" class="error-message"></span>
    </div>
    <div class="form-group">
        <label for="descOffre">Description de l'offre</label>
        <textarea name="descOffre" id="descOffre" cols="30" rows="5"  class="input_offre"></textarea>
        <span id="descOffreError" style="color: red;" class="error-message"></span>
         </div>
    <div class="form-row">
        <div class="form-group">
            <label for="salaireOffre">Salaire proposé</label>
            <input type="number" step="0.01" name="salaireOffre" id="salaireOffre" class="input_offre">
            <span id="salaireOffreError" style="color: red;" class="error-message"></span>
        </div>
        <div class="form-group">
            <label for="typeContrat">Type du contrat</label>
            <select name="typeContrat" id="typeContrat"  class="input_offre">
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
            <input type="text" name="localOffre" id="localOffre" class="input_offre">
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
            <input type="date" name="dateEx_offre" id="dateEx_offre" class="input_offre">
            <span id="dateEx_offreError" style="color: red;" class="error-message"></span>
            
        </div>
        <div class="form-group">
            <label for="expOffre">Expérience</label>
            <select name="expOffre" id="expOffre"  class="input_offre">
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
                <select name="nvEttude" id="nvEttude"  class="input_offre">
                    <option value="Bac">Bac</option>
                    <option value="Bac+2">Bac+2</option>
                    <option value="Bac+3">Bac+3</option>
                    <option value="Bac+5 et plus">Bac+5 et plus</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        <div class="form-group">
            <label for="compOffre">Compétences</label>
            <input type="text" name="compOffre" id="compOffre"  class="input_offre">
            <span id="compOffreError" style="color: red;" class="error-message"></span>
           
        </div>
    </div>
    <div class="form-group">
    <label for="catgOffre">Catégorie offre</label>
    <select name="catgOffre" id="catgOffre"  class="input_offre">
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
            <input type="text" name="statutOffre" id="statutOffre"  class="input_offre" value="ouvert" readonly>
        </div>
        <div class="form-group">
            <label for="nbPostes">Nombre de postes</label>
            <input type="number" name="nbPostes" id="nbPostes"  class="input_offre">
            <span id="nbPostesError" style="color: red;" class="error-message"></span>
            <div class="form-group">
             <label for="langues">Langues demandées</label>
           <select name="langues[]" id="langues"  class="input_offre" multiple>
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
        <input type="text" name="cleOffre" id="cleOffre"  class="input_offre">
        <span id="cleOffreError" style="color: red;" class="error-message"></span>
        
    </div>
    <div class="form-row">
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </div>
    </div>
</form>
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
   
 
</body>

  <!-- Template Javascript -->
  <script src="../js/main.js"></script>
  

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