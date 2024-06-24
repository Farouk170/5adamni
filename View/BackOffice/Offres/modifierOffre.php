<?php
    include '../../../Controller/OffreC.php';
    include '../../../Model/offre.php';
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
            0
        );
        $offreC->modifierOffre($offre, $_POST['id_ini']);
        // Redirection vers la liste des offres
         header('Location: Offres.php');
         exit();
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
   
    <style>
       
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color:red;
            
        }
        form {
            max-width: 600px;
            margin: 0 auto;
        
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
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
        .input_offre {
            
            border-width: 2px; /* Épaisseur de la bordure */
            border-style: solid; /* Style de la bordure */
            background-color:  #A22B0D ;
        }
        .form-control {
            
            border-width: 2px; /* Épaisseur de la bordure */
            border-style: solid; /* Style de la bordure */
            background-color:  black ;
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
                        <img class="rounded-circle" src="../img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
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
                            <img class="rounded-circle me-lg-2" src="../img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">User</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="../Users/profile.php" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <h1>Modifier Offre</h1>
            <a href="Offres.php" style="text-decoration: none;">
    <span style="margin-right: 5px;">&#9664;</span> Retour
</a>
    <hr>
   
    <form id="offreForm" method="POST" enctype="multipart/form-data">
    <div class="bg-secondary rounded h-100 p-4">
        <label>Titre Offre:</label>
        <input type="text" name="titreOffre" id="titreOffre" class="form-control" value="<?php echo $titreOffre ?>" >
        <span id="titreOffreError" style="color: red;" class="error-message"></span>
		<div class="form-group">
            <label for="descOffre">Description Offre</label>
            <textarea id="descOffre" name="descOffre" class="form-control" rows="5" ><?php echo $descOffre ?></textarea>
        </div>
        <label>Salaire Proposé:</label>
        <input type="number" name="salaireOffre" id="salaireOffre" class="form-control" step="0.01"  value="<?php echo $salaireOffre ?>" >
        <label>Type de Contrat:</label><br>
         <select name="typeContrat" id="typeContrat" class="form-select">
         <option value="CDI"<?php if ($typeContrat === 'CDI') echo ' selected'; ?>>CDI</option>
            <option value="CDD"<?php if ($typeContrat === 'CDD') echo ' selected'; ?>>CDD</option>
            <option value="Stage"<?php if ($typeContrat === 'Stage') echo ' selected'; ?>>Stage</option>
                
                <!-- Add more options as needed -->
            </select>
            <br>
            <br>
        <label>Localisation:</label>
        <input type="text" name="localOffre" id="localOffre" class="form-control" value="<?php echo $localOffre ?>" >
        <label>Date de Publication:</label>
        <input type="text" name="dateP_offre" class="input-offre" readonly value="<?php echo $dateP_offre ?>" >
        <label>Date d'Expiration:</label><br>
        <input type="date" name="dateEx_offre" id="dateEx_offre" class="form-control" value="<?php echo $dateEx_offre ?>" ><br><br>
        <label>Compétences Requises:</label>
        <input type="text" name="compOffre" id="compOffre" class="form-control" value="<?php echo $compOffre ?>" >
        <label>Niveau d'Étude:</label> <br>
        <select name="nvEttude" id="nvEttude" class="form-select"> 
            <option value="Bac" <?php if ( $nvEttude === 'Bac') echo 'selected'; ?>>Bac</option>
            <option value="Bac+2" <?php if ($nvEttude  === 'Bac+2') echo 'selected'; ?>>Bac+2</option>
            <option value="Bac+3" <?php if ( $nvEttude  === 'Bac+3') echo 'selected'; ?>>Bac+3</option>
            <option value="Bac+5 et plus" <?php if ( $nvEttude  === 'Bac+5 et plus') echo 'selected'; ?>>Bac+5 et plus</option>
            <!-- Ajoutez d'autres options au besoin -->
        </select>
<br><br>
        <label>Expérience:</label><br>
        <select name="expOffre" id="expOffre" class="form-select">
            <option value="Débutant" <?php if($expOffre=== 'Débutant') echo 'selected'; ?>>Débutant</option>
            <option value="1-2 ans" <?php if($expOffre=== '1-2 ans') echo 'selected'; ?>>1-2 ans</option>
            <option value="3-5 ans" <?php if($expOffre === '3-5 ans') echo 'selected'; ?>>3-5 ans</option>
            <option value="5 ans et plus" <?php if($expOffre=== '5 ans et plus') echo 'selected'; ?>>5 ans et plus</option>
        <!-- Add more options as needed -->
        </select>
<br>
<br>
        <label>Catégorie:</label><br>
        <select name="catgOffre" id="catgOffre" class="form-select">
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
        <select name="statutOffre" id="statutOffre" class="form-select"  >
            <option value="ouvert"<?php if ($statutOffre === 'ouvert') echo ' selected'; ?>>ouvert</option>
            <option value="ferme"<?php if ($statutOffre === 'ferme') echo ' selected'; ?>>ferme</option>
            <option value="en cours"<?php if ($statutOffre === 'en cours') echo ' selected'; ?>>en cours</option>
                 <!-- Add more options as needed -->
        </select>
        <br><br>
        <label>Nombre de Postes:</label>
        <input type="number" name="nbPostes" id="nbPostes" class="form-control" value="<?php echo $nbPostes ?>" >
        <label>Langue:</label>
        <input type="text" name="langOffre" id="langOffre" class="form-control" value="<?php echo $langOffre ?>" >
        <label>Clé de l'Offre:</label>
        
        <input type="text" name="cleOffre" id="cleOffre" class="form-control" value="<?php echo $cleOffre ?>"  oninput="showSuggestions()">
        <ul id="suggestionList"></ul>
        <input type="hidden" name="id_ini" value="<?php echo $_GET['idOffre']; ?>">
        <input type="submit" name="modifier"  value="Modifier">
        </div>
    </form>

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