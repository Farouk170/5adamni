<?php
  require_once "../../../../config/connexion.php";
  require_once __DIR__. "/../../../../Controller/UserController.php";
  session_start();
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
    $pdo = openDB();
    $rowsPerPage = 5;
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $startRow = ($currentPage - 1) * $rowsPerPage;
    $totalRowsStmt = $pdo->prepare("SELECT COUNT(*) FROM experience WHERE id_user = :id_user");
    $totalRowsStmt->bindValue(':id_user', $_SESSION['id'], PDO::PARAM_INT);
    $totalRowsStmt->execute();
    $totalRows = $totalRowsStmt->fetchColumn();
    $totalPages = ceil($totalRows / $rowsPerPage);
    if($totalPages<=1){
      $totalPages=0;
    }
    $table = $pdo->prepare("SELECT * FROM experience WHERE id_user = :id_user LIMIT :startRow, :rowsPerPage");
    $table->bindValue(':id_user', $_SESSION['id'], PDO::PARAM_INT);
    $table->bindValue(':startRow', $startRow, PDO::PARAM_INT);
    $table->bindValue(':rowsPerPage', $rowsPerPage, PDO::PARAM_INT);
    $table->execute();
        
?>
<!doctype html>
<html lang="en">
  <head>
    <title>5adamni</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="../../logo-mini.svg">
    
    <link rel="stylesheet" href="../../css/custom-bs.css">
    <link rel="stylesheet" href="../../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../../fonts/icomoon/style.css">
    <link rel="stylesheet" href="../../fonts/line-icons/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../css/animate.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../../css/style.css">  
<style>
      .sticky-top {
        position: -webkit-sticky;
        position: sticky;
        left: 95%;
        top: 85%;
        width: 50px;
        height: 50px;
        background-color: #EB1616;
        text-align: center;
        border-radius: 50%;
      }
      .sticky-top a{
        padding: 10px 0 0 0;
        color: rgb(255, 255, 255);
      }
      .sticky-top a:hover{
        color: #be9d9d;
      }
      .sticky-robot {
        position: -webkit-sticky;
        position: sticky;
        left: 91%;
        top: 85%;
        width: 50px;
        height: 50px;
        background-color: #EB1616;
        text-align: center;
        border-radius: 50%;
      }
      .sticky-robot a{
        padding: 10px 0 0 0;
        color: rgb(255, 255, 255);
      }
      .sticky-robot a:hover{
        color: #be9d9d;
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
              <li><a href="../">Offres</a></li>
              <li class="has-children"><a href="#" class="nav-link active">Compétences</a>
                <ul class="dropdown">
                  <li>
                    <a href="education-page.php" style="display: flex; align-items: center;">
                      <img src="edu_svg.svg" style="width: 20px; height: 20px; margin-right: 5px;">
                      Educations
                    </a>
                  </li>
                  <li>
                    <a style="display: flex; align-items: center;">
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
                <a>Réclamations</a>
                <ul class="dropdown">
                  <li><a href="../reclamationIndex.php">Consulter réclamations</a></li>
                </ul>
              </li>
              <li>
                <a href="../entretiens_c.php">Entretiens organisés</a>
              </li>
              <li><a href="../posts/">Forum</a></li>
            </ul>
          </nav>
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
          <?php require_once "../../../../Controller/chatbotFront.php";?>
            <div class="ml-auto">
                <div class="user_img" >
                <img class="image" src="data:image/png;base64,<?php if (isset($user['image'])){echo base64_encode($user['image']);} ?>" alt="Image de l'utilisateur">
                </div>
                <div class="dropdowns">
                  <a href="#" class="aaaaaa user" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
                  <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item profile-link" href="  ../profile.php">Profile</a></li>
                    <li><a class="dropdown-item logout-link" href="../../logout.php">Log Out</a></li>
                  </ul>
                  <span class="material-symbols-outlined span">arrow_drop_down</span>
                </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- HOME -->
    <section class="home-section section-hero overlay bg-image" style="background-image: url('../../images/hero_1.jpg');" id="home-section">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
                        
<div class="d-flex align-items-center justify-content-between mb-4">
                        
                    </div>
                   
                    <br><br>
                                  
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="mb-0">Gestion des Experiences</h1>
      <button type="button" class="btn btn-primary m-2 btn-lg" onclick="window.location.href='ajout_experience.php'"> + Experience</button>
                    </div>
                    <div class="table-responsive">
                        <table style="background-color: white;" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-grey">
                                    <th scope="col">Poste</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Détails</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($rows=$table->fetch()){
                                    $poste = $rows['poste'];
                                    $date_exp=date('F Y', strtotime($rows['date_exp']));
                                    $entreprise=$rows['entreprise'];
                                    $tache=$rows['tache'];
                                ?>
                                <tr>
                                    <td><?php echo $poste;?></td>
                                    <td><?php echo $date_exp;?></td>
                                    <td><?php echo $entreprise;?></td>
                                    <td><?php echo $tache;?></td>
                                    <td><button type="button" style="background-color: #2E933C; color: white;width: 80px; height:40px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;" onclick="window.location.href='modifier_experience.php?id_experience=<?php echo urlencode($rows['id_experience']); ?>&poste=<?php echo urlencode($rows['poste']); ?>&entreprise=<?php echo urlencode($rows['entreprise']); ?>&date_exp=<?php echo urlencode($rows['date_exp']); ?>&tache=<?php echo urlencode($rows['tache']); ?>'">Modifier</button>
                                    <button onclick="deleteExperience(<?php echo $rows['id_experience']; ?>)" type="button" style="background-color: #DC4E4E; color: white;width: 100px;height:40px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Supprimer</button></td>
                                </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                        <div class="pagination text-center d-flex justify-content-center mt-4">
                        <?php
                                if ($currentPage > 1) {
                                    echo '<a class="btn btn-sm btn-primary me-2" href="experience-page.php?page=' . ($currentPage - 1) . '">Précédant</a>';
                                }
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    // Add different class for the current page
                                    $activeClass = ($i == $currentPage) ? 'btn-primary active' : 'btn-secondary';
                                    echo '<a class="btn btn-sm ' . $activeClass . ' me-2" href="experience-page.php?page=' . $i . '">' . $i . '</a>';
                                }
                                if ($currentPage < $totalPages) {
                                    echo '<a class="btn btn-sm btn-primary" href="experience-page.php?page=' . ($currentPage + 1) . '">Suivant</a>';
                                }
                            ?>
                        </div>
                        
                    </div>
                            <!------------------------------------------------------------------>
            </div>
          </div>
        </div>
      </div>
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
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/isotope.pkgd.min.js"></script>
    <script src="../../js/stickyfill.min.js"></script>
    <script src="../../js/jquery.fancybox.min.js"></script>
    <script src="../../js/jquery.easing.1.3.js"></script>
    
    <script src="../../js/jquery.waypoints.min.js"></script>
    <script src="../../js/jquery.animateNumber.min.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    
    <script src="../../js/bootstrap-select.min.js"></script>
    
    <script src="../../js/custom.js"></script>
    <script>
         function openPhotoWindow(idEducation) {
        var url = 'show_photo.php?id_education=' + idEducation;
        window.open(url, 'Image', 'width=600,height=400');
    }
        function deleteExperience(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet enregistrement d'expérience ?")) {
        window.location.href = 'supprimer_experience.php?id_experience=' + id;
    }
}
    function openPDF() {
            window.open('pdf_export.php', '_blank');

    }
    </script>

     
  </body>
</html>