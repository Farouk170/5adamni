<!doctype html>
<html lang="en">
  <head>
    <title>5adamni</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="logo-mini.svg">
    
    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">  
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
          <div class="site-logo col-6"><a href="home.php"><img src="logo.svg"></a></div>

          <nav class="mx-auto site-navigation col-6">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="accueil.php">Accueil</a></li>
              <li><a href="about.html">Offres</a></li>
              <li><a href="home.php">Compétences</a></li>
              <li class="has-children">
                <a href="job-listings.html">Réclamations</a>
                <ul class="dropdown">
                  <li><a href="">Consulter réclamations</a></li>
                  <li><a href="">Réponses</a></li>
                </ul>
              </li>
              <li class="has-children">
                <a href="services.html">Entretiens</a>
                <ul class="dropdown">
                  <li><a href="services.html">Entretiens organisés</a></li>
                  <li><a href="service-single.html">RDV</a></li>
                </ul>
              </li>
              <li><a href="blog.html">Postes</a></li>
            </ul>
          </nav>
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
              <img class="icon-person userImg rounded-circle flex-shrink-0" src="images/user.jpg">
              <div class="dropdown user-dropdown">
                <a href="#" class="dropdown-toggle user" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                  <li><a class="dropdown-item profile-link" href="  profile.php">Profile</a></li>
                  <li><a class="dropdown-item logout-link" href="#">Log Out</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">My Profile</h1>
            <div class="custom-breadcrumbs">
              <a href="accueil.php">Home</a> <span class="mx-2 slash">/</span>
              <a href="profile.php">Profile</a> <span class="mx-2 slash"></span>
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
            <form class="p-4 p-md-5 border rounded" method="post">
              <h3 class="text-black mb-5 border-bottom pb-2">User infos</h3>
              
              <div class="form-group">
                <label for="company-website-tw d-block">Change profile photo</label> <br>
                <label class="btn btn-primary btn-md btn-file">
                  Browse image<input type="file" hidden>
                </label>
              </div>
              <div class="form-group">
                <label for="cin">Cin</label>
                <input type="text" class="form-control" id="cin" placeholder="cin" readonly>
              </div>
              <div class="form-group">
                <label for="nom">Username</label>
                <input type="text" class="form-control" id="nom" placeholder="Username">
                <p class="err_nom"></p>
              </div>
              <div class="form-group">
                <label for="prenom">Family name</label>
                <input type="text" class="form-control" id="prenom" placeholder="Family name">
                <p class="err_prenom"></p>
              </div>
              <div class="form-group">
                <label for="date">Birthday</label>
                <input type="date" class="form-control" id="date">
                <p class="err_date"></p>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="you@yourdomain.com">
                <p class="err_email"></p>
              </div>
              <div class="form-group">
                <label for="tel">Numéro de téléphone</label>
                <input type="text" class="form-control" id="tel" placeholder="Numéro de téléphone">
                <p class="err_tel"></p>
              </div>
              <br>
              <br>
              <div class="row align-items-center mb-5">
                <div class="col-lg-4 ml-auto">
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-block btn-light btn-md" type="submit" onclick="window.location.href='accueil.php';">Cancel</button>
                    </div>
                    <div class="col-6">
                      <button class="btn btn-block btn-primary btn-md" type="submit">Save infos</buttons>
                    </div>
                  </div>
                </div>
              </div>
            </form>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/stickyfill.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/quill.min.js"></script>
    
    
    <script src="js/bootstrap-select.min.js"></script>
    
    <script src="js/custom.js"></script>
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
        var formule = /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/;
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