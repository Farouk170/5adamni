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
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">
    <link rel="stylesheet" href="../fonts/line-icons/style.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
        form {
            flex: 2;

            max-width: 600px;

            margin: 40px auto;

            padding: 20px;

            border: none;

            border-radius: 12px;

            background-color: #f8f9fa;

            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);

        }


        input,
        select,
        textarea {
            display: block;
            width: 95%;

            padding: 12px;

            margin-bottom: 20px;

            border: 1px solid #dee2e6;

            border-radius: 8px;

            font-size: 16px;

            color: #495057;

            transition: border-color 0.3s, box-shadow 0.3s;

            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);

        }


        input:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;

            outline: none;

            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1), 0 0 8px rgba(0, 123, 255, 0.25);

        }





        button#listRec {
            display: block;

            margin: 20px auto;

            padding: 10px 20px;

            background-color: transparent;

            border: 2px solid red;

            color: red;

            font-size: 16px;

            border-radius: 5px;

            transition: background-color 0.3s, color 0.3s;

        }


        #guide {
            text-align: center;


        }


        button#listRec:hover {
            background-color: red;
            color: white;
 
        }



        button img {
            margin-right: 8px;

        }


        textarea {
            height: 150px;

            resize: vertical;

        }

        .error {
            color: red;
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
      .modif{
        background-color: red ;
        max-width: 20%;
        color: black;
      }
      .modif:hover {
      color: black;
      background-color: #cc0000;
      transform: scale(1.05);
    }
    
    .modif:focus {
      color: black;
      outline: none;
      box-shadow: 0 0 0 3px rgba(255, 0, 0, 0.5);
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
              <li><a href="index.php">Offres</a></li>
              <li class="has-children"><a href="#">Compétences</a>
                <ul class="dropdown">
                  <li>
                    <a href="cv/education-page.php" style="display: flex; align-items: center;">
                      <img src="edu_svg.svg" style="width: 20px; height: 20px; margin-right: 5px;">
                      Educations
                    </a>
                  </li>
                  <li>
                    <a href="cv/experience-page.php" style="display: flex; align-items: center;">
                      <img src="exp_svg.svg" style="width: 20px; height: 20px; margin-right: 5px;">
                      Experiences
                    </a>
                  </li>
                  <li>
                    <a onclick="openPDF()" style="display: flex; align-items: center;">
                      <img src="pdf_svg.svg" style="width: 20px; height: 20px; margin-right: 5px;">
                      CV vers PDF
                    </a>
                  </li>
                    <script>
                      function openPDF() {
                        window.open('cv/pdf_export.php', '_blank');
                      }
                    </script>
                </ul>
              </li>
              <li class="has-children">
                <a class="nav-link active">Réclamations</a>
                <ul class="dropdown">
                  <li><a href="reclamationIndex.php">Consulter réclamations</a></li>
                </ul>
              </li>
              <li>
                <a href="entretiens_c.php">Entretiens organisés</a>
              </li>
              <li><a href="../posts/">Forum</a></li>
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
                        <h1 class="text-white font-weight-bold">Modifier Réclamation</h1>
                        <div class="custom-breadcrumbs">
                            <a href="#">Home</a> <span class="mx-2 slash">/</span>
                            <span class="text-white"><strong>Modifier Réclamation</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div>

            <button id=listRec><a href="listeReclamation.php" style="text-decoration: none;">Retour à la liste des reclamations</a></button>
            <hr>
            <?php
            include '../../../Controller/ReclamationC.php';
            include '../../../Model/reclamation.php';
            if (isset($_GET['idRec'])) {
                $reclamationC = new ReclamationC();
                $result = $reclamationC->recupererReclamation($_GET['idRec']);
                foreach ($result as $Reclamation) {
                    $idRec = $Reclamation['idRec'];
                    $titleRec = $Reclamation['titleRec'];
                    $categorieRec = $Reclamation['categorieRec'];
                    $textRec = $Reclamation['textRec'];
                   
                    ?>

                    <form id="recForm" method="POST" enctype="multipart/form-data">

                        <label>Catégorie :</label>
                        <select class="frame-parent13" name="categorieRec">
                            <option value=""><?php echo $categorieRec; ?></option>
                            <?php if ($categorieRec !== 'Abonnement Premium'): ?>
                                <option value="Abonnement Premium">Abonnement Premium</option>
                            <?php endif; ?>
                            <?php if ($categorieRec !== 'Pages'): ?>
                                <option value="Pages">Pages</option>
                            <?php endif; ?>
                            <?php if ($categorieRec !== 'Groupes'): ?>
                                <option value="Groupes">Groupes</option>
                            <?php endif; ?>
                            <?php if ($categorieRec !== 'Votre Profil'): ?>
                                <option value="Votre Profil">Votre Profil</option>
                            <?php endif; ?>
                            <?php if ($categorieRec !== 'Connexion, Fraudes et sécurité'): ?>
                                <option value="Connexion, Fraudes et sécurité">Connexion, Fraudes et sécurité</option>
                            <?php endif; ?>
                            <?php if ($categorieRec !== 'Messagerie, Relations et notifications'): ?>
                                <option value="Messagerie, Relations et notifications">Messagerie, Relations et notifications
                                </option>
                            <?php endif; ?>
                            <?php if ($categorieRec !== 'Autre'): ?>
                                <option value="Autre">Autre</option>
                            <?php endif; ?>
                        </select>

                        <label>Titre :</label>
                        <div class="type-catching-attention-title-wrapper">
                            <input class="type-catching-attention" placeholder="Type catching attention title" type="text"
                                name="titleRec" value="<?php echo $titleRec ?>">
                            <div class="error" id="errorTextTitle"></div>
                        </div>

                        <label>Réclamation:</label>
                        <textarea class="ask-block-child" placeholder="ecrire votre reclamation" rows="5"
                            name="textRec"><?php echo $textRec ?></textarea>
                        <div class="error" id="errorTextQuestion"></div>
                        <div class="button-group">


                            <input type="hidden" name="idRec" value="<?php echo $idRec; ?>">
                            <input type="submit" class="modif" name="modifier" value="Modifier">
                    </form>
                    <?php
                }
            }
            if (isset($_POST['modifier'])) {

                $titleRec = $_POST['titleRec'];
                $categorieRec = $_POST['categorieRec'];
                $textRec = $_POST['textRec'];
               


                $reclamation = new Reclamation($categorieRec, $titleRec, $textRec );
                $reclamationC->modifierReclamation($reclamation, $idRec);
                echo "<script>alert('La modification a été effectuée avec succès.');</script>";
                echo "<script>window.location.href = 'listeReclamation.php';</script>";
                exit();

            }
            ?>
        </div>
        <br><br>
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


    <script>

        function validateTitleRec() {
            var titleRecInput = document.querySelector('.type-catching-attention');
            var titleRecValue = titleRecInput.value.trim();

            if (titleRecValue.length === 0) {
                document.getElementById("errorTextTitle").textContent = "* Le titre doit contenir au moins un caractère";
                titleRecInput.style.backgroundColor = "pink";
                return false;
            } else {
                document.getElementById("errorTextTitle").textContent = "";
                titleRecInput.style.backgroundColor = "";
                return true;
            }
        }


        function validateTextRec() {
            var textRecInput = document.querySelector('.ask-block-child');
            var textRecValue = textRecInput.value.trim();

            if (textRecValue.length < 30) {
                document.getElementById("errorTextQuestion").textContent = "* La Réclamation doit contenir au moins 30 caractère";
                textRecInput.style.backgroundColor = "pink";
                return false;
            } 
            else if (textRecValue.length > 200) {
                document.getElementById("errorTextQuestion").textContent = "* La Réclamation doit contenir au maximum 200 caractère";
                textRecInput.style.backgroundColor = "pink";
                return false;
            } else {
                document.getElementById("errorTextQuestion").textContent = "";
                textRecInput.style.backgroundColor = "";
                return true;
            }
        }


        document.getElementById("recForm").addEventListener("submit", function (event) {
            // Déclarez la variable de contrôle du formulaire comme true initialement
            let formIsValid = true;

            // Vérifiez chaque fonction de validation et changez la valeur de formIsValid si nécessaire
         

            if (!validateTitleRec()) {
                formIsValid = false;
            }

            if (!validateTextRec()) {
                formIsValid = false;
            }

            // Si formIsValid est false, empêchez la soumission du formulaire
            if (!formIsValid) {
                event.preventDefault();
            }
        });



    </script>
</body>

</html>