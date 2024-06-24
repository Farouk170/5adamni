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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <?php 
        require_once "../../Controller/UserController.php";
        $roles = [
            'Postulant' => 'Postulant',
            'Entreprise' => 'Entreprise',
            'Non-entreprise' => 'Non-entreprise'
        ];
        if(isset($_POST['cin']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date_naissance']) && isset($_POST['email']) && isset($_POST['tel']) && isset($_FILES['image']) && isset($_POST['role']) && isset($_POST['pwd']) && isset($_POST['conf_pwd'])){
            $cin = $_POST['cin'];
            $nom = $_POST['nom'];
            $pren = $_POST['prenom'];
            $date = $_POST['date_naissance'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $role = $_POST['role'];
            $pwd = $_POST['pwd'];
            $conf_pwd = $_POST['conf_pwd'];

            $fileTmpPath = $_FILES["image"]["tmp_name"];
            $fileContent = file_get_contents($fileTmpPath);
            if(!empty($cin) && !empty($nom) && !empty($pren) && !empty($date) && !empty($fileContent)  && !empty($email) && !empty($tel) && !empty($role) && !empty($pwd) && !empty($conf_pwd)){
                if($pwd!=$conf_pwd){
                    echo '<script>alert("Mot de passe ne correspond pas");</script>';
                }
                else{
                   
                    $usr = new user(null,$cin,$nom,$pren,$date,$email,$fileContent,$role,$tel,$pwd);
                    $usrc = new UserC();
                    $usrc->AddUser($usr);
                }
                
            }
            else
            echo "champ vide";
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


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <form action="" onsubmit="return valider_verif();" method="POST" enctype="multipart/form-data">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="home.html" class="">
                                    <h3 class="text-primary"><img src="logo.svg"></h3>
                                </a>
                                <h3>Sign Up</h3>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="cin" name="cin" placeholder="">
                                <label for="floatingText">CIN</label>
                                <p id="err_cin"></p>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="">
                                <label for="floatingText">Nom</label>
                                <p id="err_nom"></p>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="">
                                <label for="floatingText">Prenom</label>
                                <p id="err_prenom"></p>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance" placeholder="">
                                <label for="floatingText">Date de naissance</label>
                                <p id="err_date"></p>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control bg-dark" id="image" name="image" accept="image/*"  >
                            </div>
                            <div class="form-floating mb-3">
                                <select id="role" name="role"  class="form-select" aria-label="Floating label select example">
                                    <?php foreach ($roles as $key => $value): ?>
                                        <option style="background-color: black;" class="form-control" value="<?php echo htmlspecialchars($key); ?>" <?php if(isset($_POST['role']) && $_POST['role'] == $key) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($value); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="floatingSelect">Role</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="">
                                <label for="floatingInput">Email address</label>
                                <p id="err_email"></p>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="tel" name="tel" placeholder="">
                                <label for="floatingInput">Numero du Telephone</label>
                                <p id="err_tel"></p>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="">
                                <label for="floatingPassword">Mot de passe</label>
                                <p id="err_pwd"></p>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="conf_pwd" name="conf_pwd" placeholder="">
                                <label for="floatingPassword">Confirmer le mot de passe</label>
                                <p id="err_conf_pwd"></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="showPassword">
                                    <label class="form-check-label" for="exampleCheck1">Show password</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4 btn_signup">Sign Up</button>
                            <p class="text-center mb-0">Already have an Account? <a href="login.php">Log In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfMFeMpAAAAAOJBsYMDD2t7zKVvi8cRflfJKPBc" async defer></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="signup.js"></script>
    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            document.getElementById("fileName").innerText = fileName;
        }
    </script>
</body>

</html>