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
  <link rel="stylesheet" href="../css/animate.min.css">
  <link rel="stylesheet" href="../css/quill.snow.css">


  <!-- MAIN CSS -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="./global.css" />
  <link rel="stylesheet" href="./main-signed-state.css" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Droid Sans:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alegreya:wght@400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Alatsi:wght@400&display=swap" />
  <?php
  session_start();
  include '../../../Controller/OffreC.php';
  include '../../../Controller/UserController.php';
  include '../../../Model/offre.php';
  if (!isset($_SESSION['id'])) {
    header("location: ../login.php");
    exit;
  } else {
    $usrc = new UserC();
    $user = $usrc->GetUserById($_SESSION['id']);
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

    .user-dropdown a:hover {
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
    }

    .user-dropdown .profile-link:active,
    .user-dropdown .logout-link:active {
      color: white;
    }

    .user-dropdown .dropdown-menu {
      width: 120px;
    }

    .button66 {
      display: inline-block;
      padding: 10px 20px;
      margin: 10px 0;
      color: black;
      background-color: var(--color-mistyrose);
      /* Red back ground color */
      border: none;
      border-radius: 5px;
      text-decoration: none;
      text-align: center;
      cursor: pointer;
      font-size: 25px;
      transition: background-color 0.3s ease, transform 0.3s ease;
      left: 20px;
    }

    .button66:hover {
      background-color: #cc0000;
      /* Darker red on hover */
      transform: scale(1.05);
      /* Slightly enlarge on hover */
    }

    .button66:focus {
      outline: none;
      /* Remove default focus outline */
      box-shadow: 0 0 0 3px rgba(255, 0, 0, 0.5);
      /* Add custom focus outline */
    }

    .container-mid {
      display: flex;
      max-width: 90%;
      padding-top: 40px;
      padding-bottom: 40px;
      margin-left: 20px;
      /* Add left margin to move the container right */
      position: relative;
      left: 20px;
      /* Move the container to the right */
    }

    .left-panel {
      background-color: #ff0000;
      color: white;
      padding: 20px;
      flex: 1;
    }

    .left-panel h1 {
      font-size: 2em;
      margin-bottom: 20px;
    }

    .left-panel p {
      font-size: 1.2em;
      margin-bottom: 20px;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      margin: 10px 0;
      color: black;
      background-color: var(--color-mistyrose);
      border: none;
      border-radius: 5px;
      text-decoration: none;
      text-align: center;
      cursor: pointer;
      font-size: 25px;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .button6,
    .button:hover {
      color: white;
      background-color: #cc0000;
      transform: scale(1.05);
    }
    
    .button:focus {
      color: black;
      outline: none;
      box-shadow: 0 0 0 3px rgba(255, 0, 0, 0.5);
    }

    .right-panel {
      flex: 1;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .exploring-image {
      max-width: 100%;
      height: auto;
      object-fit: cover;
    }
    .textt{
      max-width: 500px;
    }
    .titree{
      color: black;
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
              <li><a href="index.php">Offres</a></li>
              <li class="has-children"><a>Compétences</a>
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
                  <li><a href="reclamationArchive.php">Réclamations Archivées</a></li>
                </ul>
              </li>
              <li>
                <a href="entretiens_c.php">Entretiens organisés</a>
              </li>
              <li><a href="../posts/">Forum</a></li>
            </ul>
          </nav>
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <?php require_once "../../../Controller/chatbotFront.php"; ?>
            <div class="ml-auto">
              <div class="user_img">
                <img class="image" src="data:image/png;base64,<?php if (isset($user['image'])) {
                  echo base64_encode($user['image']);
                } ?>" alt="Image de l'utilisateur">
              </div>
              <div class="dropdowns">
                <a href="#" class="aaaaaa user" id="userDropdown" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">User</a>
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
            <h1 class="text-white font-weight-bold" id="suivre" >Réclamations</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php" style="text-decoration: none;">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Réclamations</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="container-mid">
      <div class="left-panel">
        <h1 class="titree">Retrouvez vos dernières demandes</h1>
        <p class="textt">Retrouvez vos dernières Réclamations déposées avec l'un de nos agents ou l'historique de vos Réclamations
          Archivées.</p>
        <a href="listeReclamation.php" class="button button-primary" style="text-decoration: none;">Suivre mes Réclamations</a>
        <a href="reclamationArchive.php" class="button button-secondary" style="text-decoration: none;">Réclamations Archivées</a>
      </div>
      <div class="right-panel">
        <img src="./public/heytham7367-two-people-exploring-on-phone-9285fa4172c24a2fa73f40f46650bef7-1@2x.png"
          alt="Two People Exploring" class="exploring-image">
      </div>
    </div>

    <section class="new-claim">
      <div class="new-claim-instructions">
        <div class="claim-description">
          <b class="vous-souhaitez-rclamer">Vous souhaitez réclamer  ?</b>
          <div class="description-input"></div>
        </div>
        <div class="claim-reason"></div>
        <div class="claim-options">
          <div class="slectionnez-le-motif-container">
            <span class="slectionnez-le-motif-container1">
              <ul class="slectionnez-le-motif-de-rcla">
                <li>
                  Sélectionnez le motif de réclamation parmi ceux proposés
                  dans la liste
                </li>
              </ul>
            </span>
          </div>
          <img class="instruction-dividers-icon" loading="lazy" alt="" />
        </div>
        <div class="claim-options1">
          <div class="dposez-votre-rclamation-container">
            <ul class="dposez-votre-rclamation">
              <li>Déposez votre réclamation</li>
            </ul>
          </div>
          <img class="claim-options-child" alt="" />
        </div>
        <img class="new-claim-instructions-child" loading="lazy" alt="" src="./public/line-11.svg" />

        <div class="consultez-tout-container">
          <span class="consultez-tout-container1">
            <ul class="consultez-tout-moment-la-rp">
              <li>
                Consultez à tout moment la réponse apportée depuis le
                <a class="uivi-de-vos-demandes" href="
                    #suivre">
                  <span class="uivi-de-vos">Suivi de vos demandes.</span>
                </a>
              </li>
            </ul>
          </span>
        </div>
        <a href="ajouterReclamation.php">
          <button class="button6">
            <div class="dposer-une-rclamation">Déposer une Réclamation</div>
            <img class="plus-circle-icon2" alt="" src="./public/pluscircle.svg" />
          </button>
        </a>
        <br><br>
      </div>
    </section>
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
            <p class="copyright"><small>Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> All rights reserved | Developed by <a
                  href="https://ByteQuest.tn" target="_blank">ByteQuest</a>
              </small></p>
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

</html>