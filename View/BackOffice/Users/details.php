<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>5adamni</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php
        require_once "../../../config/connexion.php";
        require_once "../../../Controller/UserController.php";
        session_start();
        if(!isset($_SESSION['id'])) {
            header("location: ../login.php");
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
        
        $pdo=openDB();
        $usrc=new UserC();
        $rowsPerPage = 5;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $startRow = ($currentPage - 1) * $rowsPerPage;
        $totalRowsStmt = $pdo->query("SELECT COUNT(*) FROM USERS");
        $totalRows = $totalRowsStmt->fetchColumn();
        $totalPages = ceil($totalRows / $rowsPerPage);
        if(isset($_POST['sort'])){
            $_SESSION['sort']=true;
        }
        else{
            if(isset($_POST['search'])){
                $_SESSION['sort']=false;
                if(isset($_POST['search_label']) && !empty($_POST['search_label'])){
                    $name = $_POST['search_label'];
                    $query = $pdo->prepare("SELECT * FROM USERS WHERE nom LIKE :name_start OR prenom LIKE :name_start");
                    $name_start = "$name%";
                    $query->execute([':name_start' => $name_start]);
                    $table = $query->fetchAll();
                }
                else{
                    echo 'error';
                }
            }                          
            else{
                $table = $pdo->prepare("SELECT * FROM USERS");
                $table->execute();
            }
        }
    ?>
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
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <style>
        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            color: #fff;
        }

        .pagination .btn-primary.active {
            background-color: #EB1616;
            border-color: #EB1616;
        }
        .image {
            max-width: 100px;
            max-height: 100px;
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
                    <a href="index.php" class="nav-item nav-link active"><i class="fa bi-people-fill me-2"></i>Users</a>
                    <a href="../offres/offres.php" class="nav-item nav-link"><i class="fa bi-megaphone-fill me-2"></i>Offres</a>
                    <a href="../entretiens/entretiens.php" class="nav-item nav-link"><i class="fa bi-calendar-event-fill me-2"></i>Entretiens</a>
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
                <form class="d-none d-md-flex ms-4 me-2" method="POST" action="">
                    <input id="search_label" name="search_label" class="form-control bg-dark border-0 me-2" type="search" placeholder="Search">
                    <button name="sort" class="btn btn-sm btn-primary ">Sort</button>

                </form>
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
                            <a href="profile.php" class="dropdown-item">My Profile</a>
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="owl-carousel-item">
                        <br>
                        <div class="testimonial-item text-center">
                            <?php
                                $user_data=$usrc->GetUserById($_GET['id']);
                                $cin=$user_data['CIN'];
                            ?>
                            <img class="img-fluid rounded-circle mx-auto mb-4" src="data:image/png;base64,<?php if (isset($user_data['image'])) {echo base64_encode($user_data['image']);} ?>" style="width: 300px; height: 300px;">
                            <br> 
                            <h3 class="mb-1"><?php echo $user_data['nom'] . " " . $user_data['prenom']; ?></h3>
                            <p><?php echo $user_data['role']; ?></p>
                            <br>
                            <table style="text-align: left; margin: auto;">
                                <tr>
                                    <td><strong style="font-weight: bold; color: #fff;">Email </strong></td>
                                    <td><?php echo $user_data['email']; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding-right: 110px;"><strong style="font-weight: bold; color: #fff;">Date de naissance </strong></td>
                                    <td><?php echo $user_data['date_naissance']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong style="font-weight: bold; color: #fff;">Num </strong></td>
                                    <td><?php echo $user_data['tel']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong style="font-weight: bold; color: #fff;">Ban </strong></td>
                                    <td><?php echo $user_data['ban']." j" ; ?></td>
                                </tr>
                            </table>
                            <br>
                            <div class="btn-group">
                                <button class="comp btn btn-sm" style="width: 150px; height: 50px;"><?php echo'<a href="competences/cv.php?id='. $user_data['id'] .'" style="text-decoration: none;color: white;">Compétences</a>'?></button>
                                &nbsp;&nbsp;&nbsp;
                                <button class="ban btn btn-sm" style="width: 150px; height: 50px;"><?php echo'<a href="details.php?cin='. $cin .'&ban=oui" style="text-decoration: none;color: white;">Ban</a>'?></button>
                                &nbsp;&nbsp;&nbsp;
                                <button class="delete btn btn-sm btn-primary" style="width: 150px; height: 50px;"><?php echo'<a href="details.php?cin='. $cin .'&delete=oui" style="text-decoration: none;color: white;">Delete</a>'?></button>
                            </div>
                            <br>
                            <br>
                        </div>
                        <?php
                            if(isset($_GET["cin"])){
                                if(isset($_GET["ban"])){
                                    echo '<script>';
                                    echo 'var dure = prompt("Enter la duree du ban:");';
                                    echo 'window.location.href = "ban.php?cin=' . $_GET["cin"] . '&duree=" + dure;';
                                    echo '</script>';
                                }
                                if(isset($_GET["delete"])){
                                    echo '<script>';
                                    echo '    var cin = "' . htmlspecialchars($_GET["cin"]) . '";';
                                    echo 'var result = confirm("Do you want to delete the user: "+cin+"?");';
                                    echo 'if (result) {';
                                    echo '    window.location.href = "delete.php?cin=' . $_GET["cin"] . '&confirmed=true";';
                                    echo '} else {';
                                    echo '    window.location.href = "index.php";';
                                    echo '}';
                                    echo '</script>';
                                }
                            }
                            ?>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->
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
        <?php require_once "../../../Controller/chatbotBack.php";?>

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
        $(document).ready(function () {
            $("#search_label").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#table_body tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            });
        });
    </script>
</body>

</html>