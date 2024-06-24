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
        $pdo = openDB();
        $rowsPerPage = 5;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $startRow = ($currentPage - 1) * $rowsPerPage;
        $totalRowsStmt = $pdo->query("SELECT COUNT(*) FROM type_diplom");
        $totalRows = $totalRowsStmt->fetchColumn();
        $totalPages = ceil($totalRows / $rowsPerPage);
        if(isset($_POST['sort'])){
            $_SESSION['sort']=true;
        }
        if(isset($_SESSION['sort']) && $_SESSION['sort']==true){//sort
            $table = $pdo->prepare("SELECT * FROM type_diplom ORDER BY type_d ASC LIMIT :startRow, :rowsPerPage");
            $table->bindValue(':startRow', (int)$startRow, PDO::PARAM_INT);
            $table->bindValue(':rowsPerPage', (int)$rowsPerPage, PDO::PARAM_INT);
            $table->execute();
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
                $table = $pdo->prepare("SELECT * FROM type_diplom LIMIT :startRow, :rowsPerPage");
                $table->bindParam(':startRow', $startRow, PDO::PARAM_INT);
                $table->bindParam(':rowsPerPage', $rowsPerPage, PDO::PARAM_INT);
                $table->execute();
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
                    <img src="../../logo.svg">
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
            <div class="container-fluid pt-4 px-4">
            <button class="btn btn-danger m-2 btn-lg" onclick="window.location.href='cv.php'">Retour</button></button> <button type="button" class="btn btn-success m-2 btn-lg" onclick="window.location.href='ajout_diplom.php'">Ajouter Diplome</button><br><br>
                <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Gestion des Diplomes</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">Type Diplome</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($rows=$table->fetch()){
                                    $type_d = $rows['type_d'];
                                ?>
                                <tr>
                                    <td><?php echo $type_d;?></td>
                                    <td><button style="text-decoration: none;color: white;" class="btn btn-sm btn-primary" onclick="deleteDiplom(<?php echo $rows['id_type_diplom'];?>)">Supprimer</button></td>
                                </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                        <div class="pagination text-center d-flex justify-content-center mt-4">
                        <?php
                                if ($currentPage > 1) {
                                    echo '<a class="btn btn-sm btn-primary me-2" href="affichage_diplom.php?page=' . ($currentPage - 1) . '">Previous</a>';
                                }
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    // Add different class for the current page
                                    $activeClass = ($i == $currentPage) ? 'btn-primary active' : 'btn-secondary';
                                    echo '<a class="btn btn-sm ' . $activeClass . ' me-2" href="affichage_diplom.php?page=' . $i . '">' . $i . '</a>';
                                }
                                if ($currentPage < $totalPages) {
                                    echo '<a class="btn btn-sm btn-primary" href="affichage_diplom.php?page=' . ($currentPage + 1) . '">Next</a>';
                                }
                            ?>
                        </div>
                        
                    </div>
                                  
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

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
         function deleteDiplom(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet enregistrement du Diplome ?")) {
            window.location.href = 'supprimer_diplom.php?id_type_diplom=' + id;
        }
    }
    </script>
</body>

</html>