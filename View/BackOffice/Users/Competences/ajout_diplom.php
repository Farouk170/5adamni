<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>5adamni</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../../logo-mini.svg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../css/style.css" rel="stylesheet">
<?php
    require_once "../../../../config/connexion.php";
    require_once __DIR__. "/../../../../Model/CV.php";
    require_once __DIR__. "/../../../../Controller/UserController.php";
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = openDB();
        try {
            $requette = $conn->prepare("INSERT INTO type_diplom (type_d) VALUES (:type_d)");
            $requette->bindParam(':type_d', $_POST['type_d']);
            $requette->execute();
            header("Location: affichage_diplom.php");
            exit();
            
        } catch (PDOException $e) {
            echo 'Echec de connexion:' . $e->getMessage();
        }
    }
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
                <a href="../../index.php" class="navbar-brand mx-4 mb-3">
                    <img src="../../../logo.svg">
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
                    <a href="../../index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="../users.php" class="nav-item nav-link active"><i class="fa bi-people-fill me-2"></i>Users</a>
                    <a href="../../offres/offres.php" class="nav-item nav-link"><i class="fa bi-megaphone-fill me-2"></i>Offres</a>
                    <a href="../../entretiens/entretiens.php" class="nav-item nav-link"><i class="fa bi-calendar-event-fill me-2"></i>Entretiens</a>
                    <a href="../../Postes/postes.php" class="nav-item nav-link"><i class="fa bi-pen-fill me-2"></i>Postes</a>
                    <a href="../../reclamations/reclamations.php" class="nav-item nav-link"><i class="fa bi-exclamation-octagon-fill me-2"></i>Reclamations</a>
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

            <!-- 404 Start -->
            <div class="container-fluid pt-4 px-4" >
                <div class="bg-secondary text-center rounded p-4" style="display: flex; justify-content: center; align-items: center;">
                <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4" >
                            <h4 class="mb-4">Ajouter une Diplome</h4>
                            <form id="diplomform" action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input class="form-control" type="text" name="type_d" id="type_d" placeholder="Type de Diplome">
                                    <div id="error-container" class="error-message"></div>
                                </div>
                                <input type="submit" value="Ajouter" class="btn btn-success m-2"> <button class="btn btn-primary" onclick="window.location.href='affichage_diplom.php'">Annuler</button>
                            </form>
                        </div>
                    </div>
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
                </div>
            </div>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../lib/chart/chart.min.js"></script>
    <script src="../../lib/easing/easing.min.js"></script>
    <script src="../../lib/waypoints/waypoints.min.js"></script>
    <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../js/main.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var diplomForm = document.getElementById("diplomform");
        var errorContainer = document.getElementById("error-container");

        diplomForm.addEventListener("submit", function(event) {
            var type_d = document.getElementById("type_d").value;

            errorContainer.innerHTML = "";

            if (type_d.trim() === "") {
                displayError("Veuillez saisir un diplôme");
                event.preventDefault(); 
            }
        });

        function displayError(message) {
            var errorMessage = document.createElement("p");
            errorMessage.textContent = message;
            errorMessage.style.color = "red";
            errorContainer.appendChild(errorMessage);
        }
    });;
</script>
</body>

</html>