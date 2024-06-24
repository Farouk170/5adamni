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
        if(isset($_SESSION['code'])){
            if(isset($_POST['code'])){
                if($_SESSION['code']==$_POST['code']){
                    unset($_SESSION['code']);
                    echo '<script>window.location.href = "confirm_pwd.php";</script>';
                }
                else{
                    echo "Code incorrect";
                }
            }
        }
        else{
            echo '<script>window.location.href = "reset_pass.php";</script>';
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


        <!-- Log In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <form onsubmit="return verif_coord();" action="" method="post">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="../../FrontOffice/View/home.php" class="">
                                    <h3 class="text-primary"><img src="logo.svg"></h3>
                                </a>
                                <h3>Insert your code</h3>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="code" placeholder="" name="code">
                                <label for="floatingPassword">Code</label>
                                <p id="err_code"></p>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Next</button>
                            <p class="text-center mb-0">Want to log in with password? <a href="login.php">Log In</a></p>
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
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        function verif_code(){
        var req = document.getElementById('code');
        req.setAttribute('required', true);
        var st = document.getElementById('code').value;
        var cin = /^[0-9]+$/;
        if(st.length!=8){
        document.getElementById("code").style.borderColor = "red";
        document.getElementById("err_code").style.color = "red";
        document.getElementById("err_code").innerHTML = "Code must be of 8 characters";
        }
        else{
        document.getElementById("code").style.borderColor = "";
        document.getElementById("err_code").style.color = "";
        document.getElementById("err_code").innerHTML = "";
        return true;
        }
        return false;
    }
        function verif_coord(){
            return (verif_code());
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('code').addEventListener('keyup', verif_code);
        });
    </script>
</body>

</html>