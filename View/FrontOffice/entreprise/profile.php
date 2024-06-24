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

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/style.css">  
    <link href="../css/style.css" rel="stylesheet">
    <?php 
        require_once "../../../Controller/UserController.php";
        session_start();
        if(!isset($_SESSION['prenom'])) {
            header("location: login.php");
            exit;
        }
        else {
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
                    $user_data = $usrc->GetUserById($_SESSION['id']);
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
    <style>
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
    </div> <!-- .site-mobile-menu -->
    

    <!-- NAVBAR -->
    <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="index.php"><img src="logo.svg"></a></div>
          <nav class="mx-auto site-navigation col-6">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a></a></li>
              <li><a class="nav-link active">Offres</a></li>
              <li><a></a></li>
              <li class="has-children">
                <a>Réclamations</a>
                <ul class="dropdown">
                  <li><a href="reclamationIndex.php">Consulter réclamations</a></li>
                </ul>
              </li>
              <li><a></a></li>
              <li class="has-children">
                <a>Entretiens</a>
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
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">My Profile</h1>
            <div class="custom-breadcrumbs">
              <a href="index.php" style="text-decoration: none;">Home</a> <span class="mx-2 slash">/</span>
              <a href="profile.php" style="text-decoration: none;">Profile</a> <span class="mx-2 slash"></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    
    <section class="site-section">
      <div class="container">

        <div class="row align-items-center mb-5">
          <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="d-flex align-items-center">
              <div>
                <h2>My Profile</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-12">
            <div class="container-fluid pt-4 px-4">
              <form action="" method="post" enctype="multipart/form-data">
                  <div class="row g-4" style="border: 1px solid black;">
                      <div class="col-sm-12 col-xl-6">
                              <div class=" text-center rounded p-4">
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
                                <br>
                              </div>
                      </div>
                      <div class="col-sm-12 col-xl-6">
                          <div class=" text-center rounded p-4">
                              <div class="form-floating mb-3">
                                  <h6 class="mb-0">User Infos</h6>
                              </div>
                              <hr>
                              <div class="d-flex align-items-center justify-content-between mb-4">
                                <label id="cin_label">Cin</label>
                              </div>
                              <div class="form-floating mb-3">
                                  <label for="floatingText" id="nom_label">Nom</label>
                                  <input type="text" class="form-control" id="nom" placeholder="" name="nom">
                                  <p id="err_nom"></p>
                              </div>
                              <div class="form-floating mb-3">
                                  <label for="floatingText" id="prenom_label">Prenom</label>
                                  <input type="text" class="form-control" placeholder="" name="prenom" id="prenom">
                                  <p id="err_prenom"></p>
                              </div>
                              <div class="form-floating mb-3">
                                  <label for="floatingText" id="date_label">Date de naissance</label>
                                  <input type="date" class="form-control" placeholder="" name="date_naissance" id="date_naissance">
                                  <p id="err_date"></p>
                              </div>
                              <div class="form-floating mb-3">
                                  <label for="floatingText" id="email_label">Email</label>
                                  <input type="text" class="form-control"placeholder="" name="email" id="email">
                                  <p id="err_email"></p>
                              </div>
                              <div class="form-floating mb-3">
                                  <label for="floatingText" id="tel_label">Numero de telephone</label>
                                  <input type="text" class="form-control"placeholder="" name="tel" id="tel">
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
          </div>
        </div>
      </div>
    </section>

    
    
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
    <script src="../js/quill.min.js"></script>
    
    
    <script src="../js/bootstrap-select.min.js"></script>
    
    <script src="../js/custom.js"></script>
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
    document.getElementById("nom").style.borderColor = "green";
    document.getElementById("err_nom").style.color = "green";
    document.getElementById("err_nom").innerHTML = "Correct";
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
    document.getElementById("prenom").style.borderColor = "green";
    document.getElementById("err_prenom").style.color = "green";
    document.getElementById("err_prenom").innerHTML = "Correct";
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
    document.getElementById("date_naissance").style.borderColor = "green";
    document.getElementById("err_date").style.color = "green";
    document.getElementById("err_date").innerHTML = "Correct";
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
    document.getElementById("email").style.borderColor = "green";
    document.getElementById("err_email").style.color = "green";
    document.getElementById("err_email").innerHTML = "Correct";
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
    document.getElementById("tel").style.borderColor = "green";
    document.getElementById("err_tel").style.color = "green";
    document.getElementById("err_tel").innerHTML = "Correct";
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