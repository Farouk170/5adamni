<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="logo-mini.svg" rel="icon">
    <title>5adamni</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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
        session_start();
        if(isset($_SESSION['login_error'])) {
            echo '<script>alert("' . $_SESSION['login_error'] . '");</script>';
            unset($_SESSION['login_error']);
        }
    ?>
    <?php
      require_once "../../Controller/UserController.php";
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
            echo '<script>window.location.href = "../FrontOffice/postulant/";</script>';
          } else {
            echo '<script>window.location.href = "../FrontOffice/entreprise/";</script>';
          }
        }
      }
    ?>
    <style>

    .align-center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
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


        <!-- Log In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <form onsubmit="return (verif_coord() && validateRecaptcha());" action="access.php" method="post">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="../../FrontOffice/View/home.php" class="">
                                    <h3 class="text-primary"><img src="logo.svg"></h3>
                                </a>
                                <h3>Log In</h3>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="" name="email">
                                <label for="floatingInput">Email address</label>
                                <p id="err_email"></p>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="pwd" placeholder="" name="pwd">
                                <label for="floatingPassword">Password</label>
                                <p id="err_pwd"></p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="showPassword">
                                    <label class="form-check-label" for="exampleCheck1">Show password</label>
                                </div>
                                <a href="reset_pass.php">Forget Password</a>
                            </div>
                            <div class="mb-4 align-center">
                                <div class="g-recaptcha" data-sitekey="6LdZGOMpAAAAAEQb1jRZLI40cNwyxptYVlFZjbwG"></div>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Log In</button>
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
                            <p class="text-center mb-0">Don't have an Account? <a href="signup.php">Sign Up</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Log In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://accounts.google.com/gsi/client" async></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@4.0.0/build/cjs/index.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="login.js"></script>
    <script>
      function validateRecaptcha() {
        var response = grecaptcha.getResponse();
        if (response.length === 0) {
          alert("Please complete the reCAPTCHA");
          return false;
        }
        return true;
      }
    </script>
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