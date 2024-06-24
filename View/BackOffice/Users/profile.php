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
        require_once "../../../config/connexion.php";
        require_once "../../../Controller/UserController.php";
        session_start();
        if(!isset($_SESSION['id'])) {
            header("location: ../login.php");
            exit;
        }
        else {
            $usrc=new UserC();
            $user_data = $usrc->GetUserById($_SESSION['id']);
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
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            if ($id) {
                $pdo = openDB();
                $stmt = $pdo->prepare("SELECT * FROM USERS WHERE id = ?");
                $stmt->execute([$id]);
                $userData = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$userData) {
                    echo "<p>No user found for CIN: $id</p>";
                }
                else{
                    $cin = $userData['CIN'];
                    $nom = $userData['nom'];
                    $prenom = $userData['prenom'];
                    $date = $userData['date_naissance'];
                    $email = $userData['email'];
                    $tel = $userData['tel'];
                    echo '<script>';
                    echo 'document.addEventListener("DOMContentLoaded", function() {';
                    echo '    var cin = "' . htmlspecialchars($cin) . '";';
                    echo '    var nom = "' . htmlspecialchars($nom) . '";';
                    echo '    var prenom = "' . htmlspecialchars($prenom) . '";';
                    echo '    var date = "' . htmlspecialchars($date) . '";';
                    echo '    var email = "' . htmlspecialchars($email) . '";';
                    echo '    var tel = "' . htmlspecialchars($tel) . '";';
                    echo '    document.getElementById("cin_label").innerHTML = "Cin : " + cin;';
                    echo '    document.getElementById("nom").value = nom;';
                    echo '    document.getElementById("prenom").value = prenom;';
                    echo '    document.getElementById("date_naissance").value = date;';
                    echo '    document.getElementById("email").value = email;';
                    echo '    document.getElementById("tel").value = tel;';
                    echo '});';
                    echo '</script>';
                }
            }
            if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date_naissance']) && isset($_POST['email']) && isset($_POST['tel'])){
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $date = $_POST['date_naissance'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                if(isset($_FILES["image"]["tmp_name"]) && !empty($_FILES["image"]["tmp_name"])){
                    $fileTmpPath = $_FILES["image"]["tmp_name"];
                    $fileContent = file_get_contents($fileTmpPath);
                }
                else{
                    $fileContent = $user_data['image'];
                }
                $usr = new user($id,$cin,$_POST['nom'],$_POST['prenom'],$_POST['date_naissance'],$_POST['email'],$fileContent,null,$_POST['tel'],null);
                
                $usrc->ModifyUser($usr);
            }
        }
        else{
            echo "id not set!!";
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
                <a href="../home.html" class="navbar-brand mx-4 mb-3">
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
            <div class="container-fluid pt-4 px-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-6">
                                <div class="bg-secondary text-center rounded p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <h6 class="mb-0">Profile Picture</h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <?php
                                        
                                        $cin = $user_data['CIN'];
                                        ?>
                                        <img id="profilePicture" class="img-fluid rounded-circle mx-auto mb-4"
                                            src="data:image/png;base64,<?php if (isset($user_data['image'])) { echo base64_encode($user_data['image']); } ?>"
                                            style="width: 300px; height: 300px; cursor: pointer;">
                                        <input type="file" class="form-control form-control-lg bg-dark" style="display: none;" id="imageInput" id="image" name="image" accept="image/*">
                                    </div>
                                    <div class="update-text">
                                        Update Profile Pic
                                    </div>
                                    <div class="bg-secondary text-center rounded p-4">
                                        <button class="modif_form btn btn-sm btn-warning" style="color:black;" onclick="window.location.href='../logout.php';">Log out</button>
                                    </div>
                                    <br>
                                </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-secondary text-center rounded p-4">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h6 class="mb-0">User Infos</h6>
                                </div>
                                <label id="cin_label">Cin</label>
                                <br>
                                <br>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nom" placeholder="" name="nom">
                                    <label for="floatingText" id="nom_label">Nom</label>
                                    <p id="err_nom"></p>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" placeholder="" name="prenom" id="prenom">
                                    <label for="floatingText" id="prenom_label">Prenom</label>
                                    <p id="err_prenom"></p>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" placeholder="" name="date_naissance" id="date_naissance">
                                    <label for="floatingText" id="date_label">Date de naissance</label>
                                    <p id="err_date"></p>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control"placeholder="" name="email" id="email">
                                    <label for="floatingText" id="email_label">Email</label>
                                    <p id="err_email"></p>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control"placeholder="" name="tel" id="tel">
                                    <label for="floatingText" id="tel_label">Numero de telephone</label>
                                    <p id="err_tel"></p>
                                </div>
                                <br>
                                <button type="submit" class="modif modif_form btn btn-sm btn-primary">Modify</button>
                                <button type="button" onclick="location.href='index.php';" class="modif_form btn btn-sm btn-primary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>   
            </div>

            <script>
            document.getElementById('profilePicture').addEventListener('click', function() {
                document.getElementById('imageInput').click();
            });

            document.getElementById('imageInput').addEventListener('change', function(event) {
                if (event.target.files && event.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profilePicture').src = e.target.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
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
        function verif_nom(){
            var req = document.getElementById('nom');
            req.setAttribute('required', true);
            var st = document.getElementById("nom").value;
            var lettre = /^[a-zA-Z]+$/;
            if(st.length<1){
            document.getElementById("nom").style.borderColor = "red";
            document.getElementById("err_nom").style.color = "red";
            document.getElementById("err_nom").innerHTML = "Last name must contain more than one character";
            }
            else if(!st.match(lettre)){
            document.getElementById("nom").style.borderColor = "red";
            document.getElementById("err_nom").style.color = "red";
            document.getElementById("err_nom").innerHTML = "Last name must contain only characters(letters only)";
            }
            else{
            document.getElementById("nom").style.borderColor = " ";
            document.getElementById("err_nom").style.color = " ";
            document.getElementById("err_nom").innerHTML = " ";
            return true;
            }
            return false;
        }
        function verif_prenom(){
            var req = document.getElementById('prenom');
            req.setAttribute('required', true);
            var st = document.getElementById('prenom').value;
            var lettre = /^[A-Za-z]+$/;
            if(st.length<1){
            document.getElementById("prenom").style.borderColor = "red";
            document.getElementById("err_prenom").style.color = "red";
            document.getElementById("err_prenom").innerHTML = "First name must contain more than one character";
            }
            else if(!st.match(lettre)){
            document.getElementById("prenom").style.borderColor = "red";
            document.getElementById("err_prenom").style.color = "red";
            document.getElementById("err_prenom").innerHTML = "First name must contain only characters(letters only)";
            }
            else{
            document.getElementById("prenom").style.borderColor = " ";
            document.getElementById("err_prenom").style.color = " ";
            document.getElementById("err_prenom").innerHTML = " ";
            return true;
            }
            return false;
        }
        function verif_datenaissance(){
            var req = document.getElementById('date_naissance');
            req.setAttribute('required', true);
            var dateInput=new Date(document.getElementById("date_naissance").value);
            var sysDate=new Date();
            if(dateInput<sysDate){
            document.getElementById("date_naissance").style.borderColor = " ";
            document.getElementById("err_date").style.color = " ";
            document.getElementById("err_date").innerHTML = " ";
            return true;
            }
            else{
            document.getElementById("date_naissance").style.borderColor = "red";
            document.getElementById("err_date").style.color = "red";
            document.getElementById("err_date").innerHTML = "Il faut saisir une date inferieure a la date d'aujourdhui!!";
            }
            return false;
        }
        function verif_email(){
            var req = document.getElementById('email');
            req.setAttribute('required', true);
            var st = document.getElementById('email').value;
            var formule = /@/;
            if(st.length<1){
            document.getElementById("email").style.borderColor = "red";
            document.getElementById("err_email").style.color = "red";
            document.getElementById("err_email").innerHTML = "Email must contain more than one character";
            }
            else if(!st.match(formule)){
            document.getElementById("email").style.borderColor = "red";
            document.getElementById("err_email").style.color = "red";
            document.getElementById("err_email").innerHTML = "Email must respect the format(user@exemple.tn)";
            }
            else{
            document.getElementById("email").style.borderColor = " ";
            document.getElementById("err_email").style.color = " ";
            document.getElementById("err_email").innerHTML = " ";
            return true;
            }
            return false;
        }
        function verif_numtel(){
            var req = document.getElementById('tel');
            req.setAttribute('required', true);
            var st = document.getElementById('tel').value;
            var tel = /^[0-9]+$/;
            if(st.length!=8){
            document.getElementById("tel").style.borderColor = "red";
            document.getElementById("err_tel").style.color = "red";
            document.getElementById("err_tel").innerHTML = "Tel must be of 8 numbers";
            }
            else if(!st.match(tel)){
            document.getElementById("tel").style.borderColor = "red";
            document.getElementById("err_tel").style.color = "red";
            document.getElementById("err_tel").innerHTML = "Tel must respect the format(exemple:12345678)";
            }
            else{
            document.getElementById("tel").style.borderColor = " ";
            document.getElementById("err_tel").style.color = " ";
            document.getElementById("err_tel").innerHTML = " ";
            return true;
            }
            return false;
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nom').addEventListener('keyup', verif_nom);
            document.getElementById('prenom').addEventListener('keyup', verif_prenom);
            document.getElementById('date_naissance').addEventListener('keyup', verif_datenaissance);
            document.getElementById('email').addEventListener('keyup', verif_email);
            document.getElementById('tel').addEventListener('keyup', verif_numtel);
        });
        function valider_verif(){
            return (verif_nom() && verif_prenom() && verif_datenaissance() && verif_email() && verif_numtel());
        }
    </script>
</body>

</html>