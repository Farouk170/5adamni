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
    <?php
        include_once '../../../Controller/EntretienController.php';
        require_once __DIR__ . "/../../../Model/ClassEntretien.php";
        include_once '../../../Controller/TypeController.php';
        require_once "../../../Controller/UserController.php";
        require_once __DIR__ . "/../../../Model/ClassType.php";
        if(!isset($_SESSION['prenom'])) {
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
                    <br>
                    <a href="../index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="../users/users.php" class="nav-item nav-link"><i class="fa bi-people-fill me-2"></i>Users</a>
                    <a href="../offres/offres.php" class="nav-item nav-link"><i class="fa bi-megaphone-fill me-2"></i>Offres</a>
                    <a href="entretiens.php" class="nav-item nav-link active"><i class="fa bi-calendar-event-fill me-2"></i>Entretiens</a>
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
                            <a href="../profile.php" class="dropdown-item">My Profile</a>
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            
            <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
            <br>
            <br>
            <div class="bg-secondary text-center rounded p-4 table-container">
            <h4 class="mb-0">Table des entretiens</h4><br>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                                    <!-- Affichage des entretiens existants -->
                            <div class="search-container">
                                <h6>Rechercher un entretien par date:</h6>
                                <input type="date" id="searchInput" placeholder="Entrez la date du meet" onkeypress="validerRecherche(event)">
                                <button onclick="rechercherMeet()" class="btn btn-primary">Rechercher</button>
                            </div>
                            <!-- Barre de recherche pour entreprise ou candidat -->
                            <div class="search-container">
                                <h6>Rechercher un entretien par entreprise ou candidat:</h6>
                                <input type="text" id="searchInputEntreprise" placeholder="Mohamed, Orange, etc" onkeypress="validerRechercheEntreprise(event)">
                                <button onclick="rechercherEntreprise()" class="btn btn-primary">Rechercher</button>
                            </div>

                        <h6 class="mb-0"></h6>
                    </div>
                    <div class="table-responsive">
    <table id="entretiensTable" class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="text-white">
            <th scope="col">
                    <select id="filterType" onchange="filterTableType()">
                    <option value="" selected disabled>Types</option>
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
                <th scope="col">Entreprise</th>
                <th scope="col">Candidat</th>
                <th scope="col">Status</th>   
            </tr>
        </thead>
        <tbody>
        <?php

        // Récupérer la page actuelle depuis l'URL
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

        // Déterminer l'index de départ pour la pagination
        $itemsPerPage = 4;
        $startIndex = ($page - 1) * $itemsPerPage;

        try {
            // Instancier un objet de la classe EntretienController
            $entretienController = new EntretienController();

            // Appeler la méthode readEntretiens() sur cet objet
            $entretiens = $entretienController->readEntretiensall($startIndex, $itemsPerPage);
            $totalEntretiens = $entretienController->countEntretiens();

            // Calculer le nombre total de pages
            $totalPages = ceil($totalEntretiens / $itemsPerPage);

            // Afficher les entretiens dans un tableau
            if (!empty($entretiens)) {
                foreach ($entretiens as $entretien) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($entretien['type_entretien']) . "</a></td>";
                    echo "<td>" . htmlspecialchars($entretien['date_heure']) . "</td>";
                    echo "<td>" . htmlspecialchars($entretien['lien']) . "</td>";
                    echo "<td>" . htmlspecialchars($entretien['titreOffre']) . "</td>";
                    echo "<td>" . htmlspecialchars($entretien['compOffre']) . "</td>";
                    echo "<td>" . htmlspecialchars($entretien['nom']) . "</td>";
                    //statut
                    $date_actuelle = date("Y-m-d H:i:s");
                    if ($entretien['date_heure'] >= $date_actuelle) {
                        echo "<td class='status-column status-encours'>En cours</td>";
                    } else {
                        echo "<td class='status-column status-effectue'>Effectué</td>";
                    }
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
                          row.insertCell().innerText = entretien.compOffre;
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

    function validerRecherche(event) {
        if (event.key === "Enter") {
            rechercherMeet();
        }
    }

    //rechercher par candidat ou entretprise
    function rechercherEntreprise() {
        var paginationElement = document.querySelector(".pagination");
        paginationElement.style.display = "none"; // Cacher la pagination
        var searchInput = document.getElementById("searchInputEntreprise").value.trim();
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
                            
                            row.insertCell().innerText = entretien.type_entretien;
                            row.insertCell().innerText = entretien.date_heure;
                            row.insertCell().innerText = entretien.lien;
                            row.insertCell().innerText = entretien.titreOffre;
                            row.insertCell().innerText = entretien.compOffre;
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
function validerRechercheEntreprise(event) {
    if (event.key === "Enter") {
        rechercherEntreprise();
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
                    row.insertCell().innerText = entretien.compOffre;
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
                });
            } else {
                alert("Aucun entretien correspondant trouvé pour le type : " + selectedType);
                window.location.reload();
            }
        }
    };
    xhr.send();
}


    </script>
</body>

</html>