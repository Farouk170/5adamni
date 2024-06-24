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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css'><link rel="stylesheet" href="../css/stylecal.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">  
    <link rel="stylesheet" href="../scss/style.scss"> 
    <?php
      include '../../../Controller/OffreC.php';
      include '../../../Controller/UserController.php';
      include '../../../Model/offre.php';
      include_once '../../../Controller/EntretienController.php';
      require_once __DIR__ . "/../../../Model/ClassEntretien.php";
      include_once '../../../Controller/TypeController.php';
      require_once __DIR__ . "/../../../Model/ClassType.php";
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
      .table-container {
        margin-top: 100px; 
        margin-bottom: 100px;
      }
      .status-column {
        width: 120px;
      }
    
      .status-effectue {
          color: red; 
          font-weight: bold; 
      }

      .status-encours {
          color: green; 
          font-weight: bold; 
          font-style: italic;
      }

      .btn.btn-outline-modify {
        background: #45D068;
        border-width: 2px;
        border-color: #fff;
        color: black; 
        border-radius: 5px;
        font-size: 14px; 
        padding: 5px 10px;
      }
      
      .btn.btn-outline-modify:hover {
        background: #45D068;
        color: white; 
      }
      
      .redirection {
        text-decoration: none; 
        color: inherit;
      }
      .redirection:hover {
        text-decoration: none; 
        color: #007bff;
      }

      .redirection {
        text-decoration: none; 
        color: inherit;
      }
      .redirection:hover {
        text-decoration: none; 
        color: #007bff;
      }

      .title-ent{
        color : white;
      }
      
      .pagination {
        display: flex;
        justify-content: center;
        
        margin-top: 20px;
      }

      .pagination > a:first-of-type {
          color: white;
      }

      .pagination a {
        display: inline-block;
        padding: 8px 16px;
        margin: 0 4px;
        color: white;
        text-decoration: none;
        border: 1px solid #ccc;
        border-radius: 4px;
      }

      .pagination a:hover {
        background-color: #f2f2f2;
        color: black;
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
    </div> 
    <!-- .site-mobile-menu -->
    

    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.php"><img src="logo.svg"></a></div>
          <nav class="mx-auto site-navigation col-6">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a></a></li>
              <li><a href="index.php">Offres</a></li>
              <li><a></a></li>
              <li class="has-children">
                <a>Réclamations</a>
                <ul class="dropdown">
                  <li><a href="reclamationIndex.php">Consulter réclamations</a></li>
                </ul>
              </li>
              <li><a></a></li>
              <li class="has-children">
                <a href="entretiens_c.php" class="nav-link active">Entretiens</a>
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
    <section class="home-section section-hero overlay bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
<br>
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
            <div class="bg-white text-center rounded p-4 table-container">
              <h4 class="mb-0">Table des entretiens</h4><br>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0"></h6>
                        <a href="add.php" style="text-decoration:none;">Ajouter <i class="bi-person-plus-fill"></i></a>
                        
                    </div>
                    <div class="table-responsive">
    <table id="entretiensTable" class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="text-black">
                <th scope="col">
                      <select id="filterType" onchange="filterTableType()">
                      <option value="" selected disabled class="text-center">Types</option>
                      <?php
                      
                      include_once '../../../Controller/EntretienController.php';

                      try { 
                          $entretienController = new EntretienController();

                          $types = $entretienController->getDistinctEntretienTypes();

                          foreach ($types as $type) {
                              echo "<option value=\"$type\">$type</option>";
                          }
                      } catch (PDOException $e) {
                          echo "Erreur lors de la récupération des types d'entretiens : " . $e->getMessage();
                      }
                      ?>
                      </section>
                </th> 
                <th scope="col">Date et heure</th>
                <th scope="col">RV </th>
                <th scope="col">Offre</th>
                <th scope="col">Candidat</th>
                <th scope="col">
                  <select id="filterType2" onchange="filterEntretiens()">
                      <option value="" class="text-center">Status</option>
                      <option value="en_cours" class="text-center">En cours</option>
                      <option value="effectue" class="text-center">Effectué</option>
                  </select>
                </th> 
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>   
            </tr>
        </thead>
        <tbody>
        <?php

        // Récupérer la page actuelle depuis l'URL
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

        // Déterminer l'index de départ pour la pagination
        $itemsPerPage = 3;
        $startIndex = ($page - 1) * $itemsPerPage;

        try {
            // Instancier un objet de la classe EntretienController
            $entretienController = new EntretienController();

            // Appeler la méthode readEntretiens() sur cet objet
            $entretiens = $entretienController->readEntretiens($startIndex, $itemsPerPage,$_SESSION['id']);
            $totalEntretiens = $entretienController->countEntretiens();

            // Calculer le nombre total de pages
            $totalPages = ceil($totalEntretiens / $itemsPerPage);

            // Afficher les entretiens dans un tableau
            if (!empty($entretiens)) {
                foreach ($entretiens as $entretien) {
                    echo "<tr>";
                    echo "<td><a href='type_entretien.php' class='redirection'>" . htmlspecialchars($entretien['type_entretien']) . "</a></td>";
                    echo "<td>" . htmlspecialchars($entretien['date_heure']) . "</td>";
                    echo "<td>" . htmlspecialchars($entretien['lien']) . "</td>";
                    echo "<td>" . htmlspecialchars($entretien['titreOffre']) . "</td>";
                    echo "<td>" . htmlspecialchars($entretien['nom']) . "</td>";
                    $date_actuelle = date("Y-m-d H:i:s");
                    if ($entretien['date_heure'] >= $date_actuelle) {
                        echo "<td class='status-column status-encours'>En cours</td>";
                    } else {
                        echo "<td class='status-column status-effectue'>Effectué</td>";
                    }
                    echo "<td><button class='btn btn-outline-modify'><a href='modifier.php?id=" . $entretien['id'] . "' style='text-decoration: none; color: white;'>Modifier</a></button></td>";
                    echo "<td><button class='btn btn-sm btn-primary'><a href='#' onclick='confirmerSuppression(" . $entretien['id'] . ")' style='text-decoration: none;color: white;'>Supprimer</a></button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun entretien trouvé.</td></tr>";
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des entretiens : " . $e->getMessage();
        }
        ?>

        </tbody>
    </table>
</div>
</div>
              <div class="pagination">
                <a href="<?php echo ($page > 1) ? "?page=".($page - 1) : "#"; ?>">Précédent</a>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<a href='?page=$i'>$i</a>";
                }
                ?>
                <a href="<?php echo ($page < $totalPages) ? "?page=".($page + 1) : "#"; ?>">Suivant</a>
                </div>          
            </div>
            

          </div>
        </div>
      </div>
              </div>
              
              </section>
              
  <!-- CALENDRIER-->
  <section style="background-color: #999999;">
  <br><br><br>
</section>
  <div class="cal-modal-container">
    <div class="cal-modal">
      <h3 class="title-ent">Planning des entretiens</h3>
      <div id="calendar">
        <div class="placeholder"></div>
        <div class="calendar-events">
        </div>
      </div>
    </div>
  </div>
  <section style="background-color: #999999;">
  <br><br><br>
</section>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/flatpickr'></script><script  src="../js/script.js"></script>


    <!--footer-->
      
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
    
    <script src="../js/bootstrap-select.min.js"></script>
    
    <script src="../js/custom.js"></script>

     
  </body>
  <script>

    function confirmerSuppression(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet entretien ?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "supprimer_entretiens.php?id=" + id, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); 
                    window.location.reload();
                }
            };
            xhr.send(); // Envoyer la requête
        }
    }

    //rechercher par date
    function rechercherMeet() {
      var paginationElement = document.querySelector(".pagination");
      paginationElement.style.display = "none"; // Cacher la pagination
      var inputDate = document.getElementById("searchInput").value.trim();

      if (inputDate !== "") {
          var xhr = new XMLHttpRequest();
          xhr.open("GET", "rechercher_par_date.php?date=" + inputDate, true);
          xhr.onreadystatechange = function() {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  var entretiens = JSON.parse(xhr.responseText);
                  if (entretiens.length > 0) {
                      var tableBody = document.querySelector("#entretiensTable tbody");
                      tableBody.innerHTML = ''; // Effacer le contenu existant du tableau
                      
                      entretiens.forEach(function(entretien) {
                          var row = tableBody.insertRow();
                          // Ajouter les cellules avec les données de l'entretien
                          row.insertCell().innerText = entretien.type_entretien;
                          row.insertCell().innerText = entretien.date_heure;
                          row.insertCell().innerText = entretien.lien;
                          row.insertCell().innerText = entretien.titreOffre;
                          row.insertCell().innerText = entretien.nom;
                          // Ajouter la classe de statut en fonction de la date
                          var dateActuelle = new Date();
                          if (new Date(entretien.date_heure) >= dateActuelle) {
                              row.insertCell().className = 'status-column status-encours';
                              row.cells[row.cells.length - 1].innerText = 'En cours';
                          } else {
                              row.insertCell().className = 'status-column status-effectue';
                              row.cells[row.cells.length - 1].innerText = 'Effectué';
                          }
                          var cellModifier = row.insertCell();
                          var cellSupprimer = row.insertCell();
                          var boutonModifier = document.createElement("button");
                          var boutonSupprimer = document.createElement("button");
                          boutonModifier.className = 'btn btn-outline-modify';
                          boutonModifier.innerHTML = '<a href="modifier.php?id=' + entretien.id + '" style="text-decoration: none; color: white;">Modifier</a>';
                          boutonSupprimer.className = 'btn btn-sm btn-primary';
                          boutonSupprimer.innerHTML = '<a href="#" onclick="confirmerSuppression(' + entretien.id + ')" style="text-decoration: none;color: white;">Supprimer</a>';
                          cellModifier.appendChild(boutonModifier);
                          cellSupprimer.appendChild(boutonSupprimer);
                          
                      });
                  } else {
                      alert("Aucun entretien à cette date n'a été trouvé.");
                      window.location.reload()
                  }
              }
          };
          xhr.send();
      } else {
          // Si aucun input n'est saisi
          alert("Veuillez saisir une date.");
      }
  }


    //appui sur entrée
    function validerRecherche(event) {
        if (event.key === "Enter") {
            rechercherMeet();
        }
    }
    

    //rechercher par candidat ou offre
    function rechercherCandidat() {
      var paginationElement = document.querySelector(".pagination");
      paginationElement.style.display = "none"; // Cacher la pagination
      var searchInput = document.getElementById("searchInputCandidat").value.trim();
      
      if (searchInput !== "") {
          var xhr = new XMLHttpRequest();
          xhr.open("GET", "rechercher_par_date.php?searchTerm=" + searchInput, true);
          xhr.onreadystatechange = function() {
              if (xhr.readyState === 4 && xhr.status === 200) {
                  var entretiens = JSON.parse(xhr.responseText);
                  if (entretiens.length > 0) {
                      var tableBody = document.querySelector("#entretiensTable tbody");
                      tableBody.innerHTML = ''; // Effacer le contenu existant du tableau
                      
                      entretiens.forEach(function(entretien) {
                          var row = tableBody.insertRow();
                          // Ajouter les cellules avec les données de l'entretien
                          row.insertCell().innerText = entretien.type_entretien;
                          row.insertCell().innerText = entretien.date_heure;
                          row.insertCell().innerText = entretien.lien;
                          row.insertCell().innerText = entretien.titreOffre;
                          row.insertCell().innerText = entretien.nom;
                          
                          // Ajouter la classe de statut en fonction de la date
                          var dateActuelle = new Date();
                          if (new Date(entretien.date_heure) >= dateActuelle) {
                              row.insertCell().className = 'status-column status-encours';
                              row.cells[row.cells.length - 1].innerText = 'En cours';
                          } else {
                              row.insertCell().className = 'status-column status-effectue';
                              row.cells[row.cells.length - 1].innerText = 'Effectué';
                          }
                          var cellModifier = row.insertCell();
                          var cellSupprimer = row.insertCell();
                          var boutonModifier = document.createElement("button");
                          var boutonSupprimer = document.createElement("button");
                          boutonModifier.className = 'btn btn-outline-modify';
                          boutonModifier.innerHTML = '<a href="modifier.php?id=' + entretien.id + '" style="text-decoration: none; color: white;">Modifier</a>';
                          boutonSupprimer.className = 'btn btn-sm btn-primary';
                          boutonSupprimer.innerHTML = '<a href="#" onclick="confirmerSuppression(' + entretien.id + ')" style="text-decoration: none;color: white;">Supprimer</a>';
                          cellModifier.appendChild(boutonModifier);
                          cellSupprimer.appendChild(boutonSupprimer);
                      });
                  } else {
                      alert("Aucun entretien correspondant trouvé pour : " + searchInput);
                      window.location.reload();
                  }
              }
          };
          xhr.send();
      } else {
        window.location.reload();
      }
  }


  //deuxième fonction entrée pour éviter d'obligée la deuxième à se valider
  function validerRechercheCandidat(event) {
      if (event.key === "Enter") {
          rechercherCandidat();
      }
  }

  //liste déroulante type pour analyser dans la bdd et non pas dans le tableau
  function filterTableType() {
    var paginationElement = document.querySelector(".pagination");
    paginationElement.style.display = "none"; // Cacher la pagination
    var selectedType = document.getElementById("filterType").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "rechercher_par_date.php?type=" + selectedType, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var entretiens = JSON.parse(xhr.responseText);
            if (entretiens.length > 0) {
                var tableBody = document.querySelector("#entretiensTable tbody");
                tableBody.innerHTML = ''; // Effacer le contenu existant du tableau
                entretiens.forEach(function(entretien) {
                    var row = tableBody.insertRow();
                    // Ajouter les cellules avec les données de l'entretien
                    row.insertCell().innerText = entretien.type_entretien;
                    row.insertCell().innerText = entretien.date_heure;
                    row.insertCell().innerText = entretien.lien;
                    row.insertCell().innerText = entretien.titreOffre;
                    row.insertCell().innerText = entretien.nom;
                    // Ajouter la classe de statut en fonction de la date
                    var dateActuelle = new Date();
                    if (new Date(entretien.date_heure) >= dateActuelle) {
                        row.insertCell().className = 'status-column status-encours';
                        row.cells[row.cells.length - 1].innerText = 'En cours';
                    } else {
                        row.insertCell().className = 'status-column status-effectue';
                        row.cells[row.cells.length - 1].innerText = 'Effectué';
                    }
                    var cellModifier = row.insertCell();
                    var cellSupprimer = row.insertCell();
                    var boutonModifier = document.createElement("button");
                    var boutonSupprimer = document.createElement("button");
                    boutonModifier.className = 'btn btn-outline-modify';
                    boutonModifier.innerHTML = '<a href="modifier.php?id=' + entretien.id + '" style="text-decoration: none; color: white;">Modifier</a>';
                    boutonSupprimer.className = 'btn btn-sm btn-primary';
                    boutonSupprimer.innerHTML = '<a href="#" onclick="confirmerSuppression(' + entretien.id + ')" style="text-decoration: none;color: white;">Supprimer</a>';
                    cellModifier.appendChild(boutonModifier);
                    cellSupprimer.appendChild(boutonSupprimer);
                });
            } else {
                alert("Aucun entretien correspondant trouvé pour le type : " + selectedType);
                window.location.reload();
            }
        }
    };
    xhr.send();
}


//filtrer par status
  function filterEntretiens() {
    var paginationElement = document.querySelector(".pagination");
    paginationElement.style.display = "none"; // Cacher la pagination
    var selectBox = document.getElementById("filterType2");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

    if (selectedValue !== "") {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "rechercher_par_date.php?statut=" + selectedValue, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var entretiens = JSON.parse(xhr.responseText);
                if (entretiens.length > 0) {
                    var tableBody = document.querySelector("#entretiensTable tbody");
                    tableBody.innerHTML = '';

                    entretiens.forEach(function (entretien) {
                        var row = tableBody.insertRow();
                        // Ajouter les cellules avec les données de l'entretien
                        row.insertCell().innerText = entretien.type_entretien;
                        row.insertCell().innerText = entretien.date_heure;
                        row.insertCell().innerText = entretien.lien;
                        row.insertCell().innerText = entretien.titreOffre;
                        row.insertCell().innerText = entretien.nom;

                        // Ajouter la classe de statut en fonction du choix
                        if (selectedValue === "en_cours") {
                            row.insertCell().className = 'status-column status-encours';
                            row.cells[row.cells.length - 1].innerText = 'En cours';
                        } else if (selectedValue === "effectue") {
                            row.insertCell().className = 'status-column status-effectue';
                            row.cells[row.cells.length - 1].innerText = 'Effectué';
                        }

                        // Ajouter les boutons Modifier et Supprimer
                        var cellModifier = row.insertCell();
                        var cellSupprimer = row.insertCell();
                        var boutonModifier = document.createElement("button");
                        var boutonSupprimer = document.createElement("button");
                        boutonModifier.className = 'btn btn-outline-modify';
                        boutonModifier.innerHTML = '<a href="modifier.php?id=' + entretien.id + '" style="text-decoration: none; color: white;">Modifier</a>';
                        boutonSupprimer.className = 'btn btn-sm btn-primary';
                        boutonSupprimer.innerHTML = '<a href="#" onclick="confirmerSuppression(' + entretien.id + ')" style="text-decoration: none;color: white;">Supprimer</a>';
                        cellModifier.appendChild(boutonModifier);
                        cellSupprimer.appendChild(boutonSupprimer);
                    });
                } else {
                    alert("Aucun entretien trouvé avec ce statut.");
                }
            }
        };
        xhr.send();
    } else {
        alert("Veuillez sélectionner un statut.");
        window.location.reload();
    }
}

    
    </script>
    
    
</html>