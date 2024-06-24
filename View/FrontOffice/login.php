<!doctype html>
<html lang="en">
  <head>
    <link href="logo-mini.svg" rel="icon">
    <title>5adamni</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="css/custom-bs.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="fonts/line-icons/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">    

    <?php
      require_once "../../Controller/UserController.php";
      session_start();
      if (isset($_SESSION['login_error'])) {
          echo '<script>alert("' . $_SESSION['login_error'] . '");</script>';
          unset($_SESSION['login_error']);
      }
      if (isset($_SESSION['id'])) {
        $usrc = new UserC();
        $user = $usrc->GetUserById($_SESSION['id']);
        if ($user['role'] == "Admin") {
          echo '<script>window.location.href = "../BackOffice/";</script>';
        } else {
          if ($user['role'] == "Postulant") {
            echo '<script>window.location.href = "postulant/";</script>';
          } else {
            echo '<script>window.location.href = "entreprise/";</script>';
          }
        }
      }
    ?>

    <style>
      .cta {
        position: relative;
        margin: auto;
        padding: 12px 18px;
        transition: all 0.2s ease;
        border: none;
        background: none;
        cursor: pointer;
      }
      .cta:before {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        border-radius: 50px;
        border: none;
        background: #ED7D7D;
        width: 45px;
        height: 45px;
        transition: all 0.3s ease;
      }
      .cta span {
        position: relative;
        font-family: "Ubuntu", sans-serif;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: red;
      }
      .cta svg {
        position: relative;
        top: 0;
        margin-left: 10px;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke: red;
        stroke-width: 2;
        transform: translateX(-5px);
        transition: all 0.3s ease;
      }
      .cta:hover:before {
        width: 100%;
        background: #ED7D7D;
      }
      .cta:hover svg {
        transform: translateX(0);
      }
      .cta:active,
      .cta:focus {
        outline: none;
      }
      .cta:active {
        transform: scale(0.95);
      }
      .align-center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
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
          </div>
        </div>
      </header>

      <!-- HOME -->
      <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
      </section>

      <section class="site-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 mb-5">
              <div class="block">
                <h2 class="mb-4">Se connecter</h2>
                <form onsubmit="return (verif_coord() && validateRecaptcha())" action="access.php" method="post">
                  <div class="rounded p-4 p-sm-5 my-4 mx-3" style="border: 1px solid grey;">
                    <div class="form-floating mb-4">
                      <label for="floatingEmail">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                      <p id="err_email"></p>
                    </div>
                    <div class="form-floating mb-4">
                      <label for="floatingPassword">Mot de passe</label>
                      <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Mot de passe">
                      <p id="err_pwd"></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label class="form-check-label" for="showPassword">Voir le mot de passe</label>
                      </div>
                      <div class="form-check">
                        <a class="cta" onclick='window.location.href="choice.php"' tabindex="0" style="text-decoration: none;">
                          <span>Mot de passe oublié</span>
                          <svg width="15px" height="10px" viewBox="0 0 13 10">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="8 1 12 5 8 9"></polyline>
                          </svg>
                        </a>
                      </div>
                    </div>
                    <div class="mb-4 align-center">
                      <div class="g-recaptcha" data-sitekey="6LdZGOMpAAAAAEQb1jRZLI40cNwyxptYVlFZjbwG"></div>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-4 btn_signup">Se connecter</button>
                    <div id="g_id_onload"
                      data-client_id="204342630863-cd854s477k19s0e6vuq9vt4i0tdvh846.apps.googleusercontent.com"
                      data-context="signin"
                      data-ux_mode="popup"
                      data-callback="loginCallback"
                      data-auto_prompt="false">
                    </div>
                    <style>
                      .google-signin-container {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        margin-top: 20px; /* Adjust as needed for spacing */
                      }
                      .google-signin-icon {
                        display: inline-block;
                        width: 40px;
                        height: 40px;
                        background: url('path/to/google-icon.png') no-repeat center center;
                        background-size: contain;
                        cursor: pointer;
                      }
                    </style>
                    <div class="google-signin-container">
                      <div class="google-signin-icon g_id_signin"
                        data-type="icon"
                        data-shape="circle"
                        data-theme="outline"
                        data-size="large">
                      </div>
                    </div>
                    <br>
                    <p class="text-center mb-0">Pas de compte? <a href="signup.php" style="text-decoration: none;">S'inscrire</a></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      
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
    <script src="login.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://accounts.google.com/gsi/client" async></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@4.0.0/build/cjs/index.min.js"></script>
    <script>
      function validateRecaptcha() {
        var response = grecaptcha.getResponse();
        if (response.length === 0) {
          alert("Please complete the reCAPTCHA");
          return false;
        }
        return true;
      }
      document.querySelector('.google-signin-btn').addEventListener('click', function() {
        google.accounts.id.prompt(); // Trigger the Google Sign-In prompt
      });
      function loginCallback(response){ 
        var jwtToken = response.credential;
        var credentials = jwtDecode(jwtToken);
        var gmail = credentials.email;
        var nom = credentials.family_name;
        var prenom = credentials.given_name;
        var picture = credentials.picture;
        $.ajax({
          type: "POST",
          url: "verif_email.php",
          data: { email: gmail},
          dataType: "json",
          success: function(response) {
              console.log("AJAX call succeeded");
              console.log("Response:", response);
              if(response){
                window.location.href = "accessByEmail.php?gmail=" + encodeURIComponent(gmail);
              }
              else{
                alert("No user found with this google account, please sign up");
              }
          },
          error: function(xhr, status, error) {
            console.error("AJAX call failed");
            console.error("Error:", error);
            console.error("Status:", status);
            console.error("XHR:", xhr);
          },
          complete: function() {
              console.log("AJAX call completed");
          }
        });
      }
    </script>
  </body>
</html>
