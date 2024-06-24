<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>5adamni</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="logo-mini.svg" rel="icon">

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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php
        require_once "../../config/connexion.php";
        require_once "../../Controller/UserController.php";
        require_once "../../Controller/OffreC.php";
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
                    header("location: ../FrontOffice/Postulant/");
                }
                else{
                    header("location: ../FrontOffice/Entreprise/");
                }
            }
        }
        $pdo = openDB();
        $get_usersnumber = $pdo->prepare("SELECT COUNT(*) FROM USERS");
       $get_offrenumber = $pdo->prepare("SELECT COUNT(*) FROM OFFRE");
       $get_entretiennumber = $pdo->prepare("SELECT COUNT(*) FROM ENTRETIENS");
        $get_postnumber = $pdo->prepare("SELECT COUNT(*) FROM POSTS");

        $get_usersnumber->execute();
        $get_offrenumber->execute();
        $get_entretiennumber->execute();
        $get_postnumber->execute();

        $usersnumber = $get_usersnumber->fetchColumn();
        $offrenumber = $get_offrenumber->fetchColumn();
        $entretiennumber =$get_entretiennumber->fetchColumn();
        $postnumber = $get_postnumber->fetchColumn();

    ?>
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
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><img src="logo.svg"></h3>
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
                    <a class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="users/index.php" class="nav-item nav-link"><i class="fa bi-people-fill me-2"></i>Users</a>
                    <a href="offres/offres.php" class="nav-item nav-link"><i class="fa bi-megaphone-fill me-2"></i>Offres</a>
                    <a href="entretiens/entretiens.php" class="nav-item nav-link"><i class="fa bi-calendar-event-fill me-2"></i>Entretiens</a>
                    <a href="Postes/postes.php" class="nav-item nav-link"><i class="fa bi-pen-fill me-2"></i>Postes</a>
                    <a href="reclamations/reclamations.php" class="nav-item nav-link"><i class="fa bi-exclamation-octagon-fill me-2"></i>Reclamations</a>
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
                            <a href="Users/profile.php" class="dropdown-item">My Profile</a>
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Users</p>
                                <h6 class="mb-0"><?php echo $usersnumber;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Offres</p>
                                <h6 class="mb-0"><?php echo $offrenumber;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Entretiens</p>
                                <h6 class="mb-0"><?php echo $entretiennumber;?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total posts</p>
                                <h6 class="mb-0"><?php echo $postnumber;?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Statistique des candidatures par rapport au offres publiés</h6>
                                <a href="offres/offres.php">liste offres</a>
                            </div>
                            <canvas id="offersAndCandidaturesChart"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Reclamations et Utilisateurs</h6>
                                <a href="reclamations/reclamations.php">liste reclamations</a>
                            </div>
                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
    // Récupération des données depuis la base de données
    $pdo = openDB();

    // Fonction pour récupérer le nombre d'offres par semaine
    function getOffersAndCandidaturesByWeek($pdo) {
        $query = $pdo->prepare("SELECT YEAR(week_date) as year, WEEK(week_date) as week, 
            SUM(is_offer) as total_offres, SUM(is_candidature) as total_candidatures 
            FROM (
                SELECT dateP_offre AS week_date, 1 AS is_offer, 0 AS is_candidature FROM offre
                UNION ALL
                SELECT dateCandidature AS week_date, 0 AS is_offer, 1 AS is_candidature FROM candidature
            ) AS merged_data
            GROUP BY YEAR(week_date), WEEK(week_date)");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupération des données
    $offers_and_candidatures_by_week = getOffersAndCandidaturesByWeek($pdo);
?>



<?php
    // Formatage des données pour Chart.js
    $labels_weeks = [];
    $data_offres = [];
    $data_candidatures = [];

    foreach ($offers_and_candidatures_by_week as $row) {
        $labels_weeks[] = "Semaine " . $row['week'] . ", " . $row['year'];
        $data_offres[] = $row['total_offres'];
        $data_candidatures[] = $row['total_candidatures'];
    }
?>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-fill-between@2.0.0/dist/chartjs-plugin-fill-between.min.js"></script>

<script>
    // Configuration de la courbe pour les offres et les candidatures
    var ctxOffersAndCandidatures = document.getElementById('offersAndCandidaturesChart').getContext('2d');
    var offersAndCandidaturesChart = new Chart(ctxOffersAndCandidatures, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels_weeks); ?>,
            datasets: [{
                label: 'Nombre d\'offres par semaine',
                data: <?php echo json_encode($data_offres); ?>,
                borderColor: 'rgba(128, 128, 128, 1)', // Gris
                backgroundColor: 'rgba(128, 128, 128, 0.2)',
                borderWidth: 3, // Épaisseur de la ligne
                fill: false, // Ne pas remplir la zone sous la courbe
                pointRadius: 5, // Taille des points de données
                pointBackgroundColor: 'rgba(128, 128, 128, 1)', // Couleur des points de données
                pointBorderColor: '#fff', // Bordure des points de données
                pointBorderWidth: 2, // Épaisseur de la bordure des points de données
                pointHoverRadius: 7, // Taille des points de données au survol
            }, {
                label: 'Nombre de candidatures par semaine',
                data: <?php echo json_encode($data_candidatures); ?>,
                borderColor: 'rgba(128, 0, 0, 1)', // Rouge bordeaux
                backgroundColor: 'rgba(128, 0, 0, 0.2)',
                borderWidth: 3, // Épaisseur de la ligne
                fill: '-1', // Remplir la zone entre cette courbe et la précédente
                pointRadius: 5, // Taille des points de données
                pointBackgroundColor: 'rgba(128, 0, 0, 1)', // Couleur des points de données
                pointBorderColor: '#fff', // Bordure des points de données
                pointBorderWidth: 2, // Épaisseur de la bordure des points de données
                pointHoverRadius: 7, // Taille des points de données au survol
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Semaine'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom', // Position de la légende
                    labels: {
                        font: {
                            size: 14 // Taille de police de la légende
                        }
                    }
                },
                tooltip: {
                    intersect: false // Les tooltips n'apparaissent que sur le pointage direct
                }
            },
            animation: {
                duration: 1000, // Durée de l'animation en millisecondes
                easing: 'easeInOutQuart' // Type d'animation
            },
            elements: {
                line: {
                    tension: 0.4 // Tension des lignes pour des courbes plus lisses
                }
            }
        }
    });
</script>



<?php
    // Récupération des données depuis la base de données
    $pdo = openDB();

    // Fonction pour récupérer le nombre d'utilisateurs par type
    function getUsersByType($pdo) {
        $query_users = $pdo->prepare("SELECT role, COUNT(*) as total_users FROM users GROUP BY role");
        $query_users->execute();
        return $query_users->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fonction pour récupérer le nombre de réclamations par type d'utilisateur
    function getComplaintsByType($pdo) {
        $query_complaints = $pdo->prepare("SELECT u.role, COUNT(*) as total_complaints FROM users u INNER JOIN reclamation r ON u.id = r.idUser GROUP BY u.role");
        $query_complaints->execute();
        return $query_complaints->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupération des données
    $users_by_type = getUsersByType($pdo);
    $complaints_by_type = getComplaintsByType($pdo);
?>


<?php
    // Formatage des données pour Chart.js
    $labels_users = [];
    $data_users = [];
    $data_complaints = [];

    // Fusionner les données des utilisateurs et des réclamations par type
    foreach ($users_by_type as $user) {
        $labels_users[] = $user['role'];
        $data_users[] = $user['total_users'];
        $data_complaints[$user['role']] = 0; // Initialiser le nombre de réclamations à 0 pour chaque type d'utilisateur
    }

    // Mettre à jour le nombre de réclamations par type d'utilisateur
    foreach ($complaints_by_type as $complaint) {
        $data_complaints[$complaint['role']] = $complaint['total_complaints'];
    }
?>

<script>
    // Configuration du graphique pour les utilisateurs par type
    var ctxUsers = document.getElementById('usersChart').getContext('2d');
    var usersChart = new Chart(ctxUsers, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels_users); ?>,
            datasets: [{
                label: 'Nombre d\'utilisateurs par type',
                data: <?php echo json_encode($data_users); ?>,
                backgroundColor: 'rgba(0, 0, 0, 0.8)', // Noir
                borderColor: 'rgba(0, 0, 0, 1)', // Noir
                borderWidth: 2
            }, {
                label: 'Nombre de réclamations par type',
                data: <?php echo json_encode(array_values($data_complaints)); ?>,
                backgroundColor: 'rgba(128, 0, 0, 0.8)', // Rouge bordeaux
                borderColor: 'rgba(128, 0, 0, 1)', // Rouge bordeaux
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Type'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom', // Position de la légende
                    labels: {
                        font: {
                            size: 14 // Taille de police de la légende
                        }
                    }
                },
                tooltip: {
                    intersect: false // Les tooltips n'apparaissent que sur le pointage direct
                }
            },
            animation: {
                duration: 1000, // Durée de l'animation en millisecondes
                easing: 'easeInOutQuart' // Type d'animation
            }
        }
    });
</script>




            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">5adamni</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
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
        <?php require_once "../../Controller/chatbotBack.php";?>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="home.js"></script>
    
</body>

</html>