<?php
require_once "../../../../config/connexion.php";
require_once __DIR__. "/../../../../Model/CV.php";
require_once __DIR__. "/../../../../Controller/CVC.php";
require_once __DIR__. "/../../../../Controller/UserController.php";
session_start();
if(!isset($_SESSION['id'])) {
    header("location: ../../login.php");
    exit;
}
if(!isset($_SESSION['idComp'])) {
    header("location: ../../login.php");
    exit;
}
$usrc = new UserC();
$user = $usrc->GetUserById($_SESSION['idComp']);
try {
    $conn = openDB();
    $query = $conn->prepare("SELECT e.id_education, e.ecole, e.date_edu, e.diplom, t.id_type_diplom, t.type_d, e.diplom_jpg
                FROM education e 
                JOIN type_diplom t 
                ON e.id_diplom = t.id_type_diplom WHERE id_user = :id_user ;");
    $id_user=$user['id'];
    $query->execute(['id_user' => $id_user]);

    $query->execute();
    $edu = $query->fetchAll();
    foreach($edu as $idd){
    $id = $idd['id_education'];
    }
} catch (PDOException $e) {
    echo 'echec de connexion:' . $e->getMessage();
}
try {
    $conn2 = openDB();
    $query2 = $conn2->prepare("SELECT * FROM experience WHERE id_user = :id_user");
    $id_user=$user['id'];
    $query2->execute(['id_user' => $id_user]);
    $exp = $query2->fetchAll();
} catch (PDOException $e) {
    echo 'echec de connexion:' . $e->getMessage();
}
?>
<head>
    <title>5adamni</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="../../logo-mini.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    
            /* GENERAL */
            * {
                margin: 0;
                box-sizing: border-box;
            }

            body {
                font-family: Roboto;
                font-weight: 300;
                font-size: .9rem;
                line-height: 1.5;
            }

            a {
                text-decoration: none;
                color: #bd1010;
            }

            a:hover {
                text-decoration: underline;
            }

            p {
                margin: 0 0 1rem;
            }

            h1 {
                margin: 0 0 1rem;
                font-size: 2.5rem;
                margin-bottom: .5rem;
            }

            h2 {
                margin: 0 0 1rem;
                letter-spacing: 1px;
                text-transform: uppercase;
            }

            .text-blue {
                color: #bd1010;
            }

            .text-darkblue {
                color: #fff;
            }

            .text-uppercase {
                text-transform: uppercase;
            }

            .icon {
                margin-right: .5rem;
            }

            .cv-container {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-template-areas: "left-column right-column right-column";
                width: 1200px;
                margin: 100px auto;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            }

            .section {
                margin-bottom: 1.5rem;
            }
            .left-column {
                grid-area: left-column;
                padding: 50px;
                background-color: #bd1010;
                color: white;
            }

            .portait {
                border-radius: 50%;
                max-width: 250px;
                margin: auto;
                display: block;
                margin-bottom: 50px;
            }

            .skills {
                list-style-type: none;
                padding: 0;
                font-size: 1.1rem;
                letter-spacing: 1px;
                margin: 0 0 1rem;
            }

            /* RIGHT COLUMN */
            .right-column {
                grid-area: right-column;
                display: grid;
                grid-template-rows: 250px 1fr;
                grid-template-areas: "header" "content";
            }

            /* HEADER */
            .header {
                grid-area: header;
                padding: 50px;
                background-color: #F2F2F2;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .infos {
                columns: 2;
                list-style-type: none;
                padding: 0;
            }

            /* CONTENT */
            .content {
                grid-area: content;
                padding: 50px;
            }

            .experience-list {
                list-style-type: circle;
            }

            .print-btn {
                width: 150px;
                height: 45px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: white;
                border: 1px solid rgb(213, 213, 213);
                border-radius: 10px;
                gap: 10px;
                font-size: 16px;
                cursor: pointer;
                overflow: hidden;
                font-weight: 500;
                box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.065);
                transition: all 0.3s;
            }
            
    .printer-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 100%;
    }
    .printer-container {
    height: 50%;
    width: 100%;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    }

    .printer-container svg {
    width: 100%;
    height: auto;
    transform: translateY(4px);
    }
    .printer-page-wrapper {
    width: 100%;
    height: 50%;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    }
    .printer-page {
    width: 70%;
    height: 10px;
    border: 1px solid black;
    background-color: white;
    transform: translateY(0px);
    transition: all 0.3s;
    transform-origin: top;
    }
    .print-btn:hover .printer-page {
    height: 16px;
    background-color: rgb(239, 239, 239);
    }
    .print-btn:hover {
    background-color: rgb(239, 239, 239);
    }
    .button-w {
        display :flex;
        align-items:center;
        justify-content:center;
    }
    .img{
        width: 178;
        height: 54;
    }
    .img-profile {
        border-radius: 50%;
        background-color: black;
        width: 220px; /* Make sure the div has a fixed width */
        height: 220px; /* Make sure the div has a fixed height */
        overflow: hidden; /* Ensure the image stays within the circular div */
        display: flex; /* Center the image inside the div */
        align-items: center; /* Center the image vertically */
        justify-content: center; /* Center the image horizontally */
        margin-left: 10px;
    }

    .img-profile img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the entire div */
        border-radius: 50%;
    }

</style>
</head>
<div class="button-w" id="button-w">
<button class="print-btn" onclick="printCV()">
  <span class="printer-wrapper">
    <span class="printer-container">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 92 75">
        <path
          stroke-width="5"
          stroke="black"
          d="M12 37.5H80C85.2467 37.5 89.5 41.7533 89.5 47V69C89.5 70.933 87.933 72.5 86 72.5H6C4.067 72.5 2.5 70.933 2.5 69V47C2.5 41.7533 6.75329 37.5 12 37.5Z"
        ></path>
        <mask fill="white" id="path-2-inside-1_30_7">
          <path
            d="M12 12C12 5.37258 17.3726 0 24 0H57C70.2548 0 81 10.7452 81 24V29H12V12Z"
          ></path>
        </mask>
        <path
          mask="url(#path-2-inside-1_30_7)"
          fill="black"
          d="M7 12C7 2.61116 14.6112 -5 24 -5H57C73.0163 -5 86 7.98374 86 24H76C76 13.5066 67.4934 5 57 5H24C20.134 5 17 8.13401 17 12H7ZM81 29H12H81ZM7 29V12C7 2.61116 14.6112 -5 24 -5V5C20.134 5 17 8.13401 17 12V29H7ZM57 -5C73.0163 -5 86 7.98374 86 24V29H76V24C76 13.5066 67.4934 5 57 5V-5Z"
        ></path>
        <circle fill="black" r="3" cy="49" cx="78"></circle>
      </svg>
    </span>

    <span class="printer-page-wrapper">
      <span class="printer-page"></span>
    </span>
  </span>
  Imprimer
</button>
</div>

<script>
    function printCV() {
        window.print();
        }


        
</script>
<body>

    <div class="cv-container">
        <div class="left-column">
            <?php
                $imageSrc = !empty($user['image']) ? 'data:image/png;base64,' . base64_encode($user['image']) : 'unknown.jpg';
            ?>
            <div class="img-profile">
                <img class="portait" src="<?php echo $imageSrc; ?>" alt="Image de l'utilisateur">
            </div>
            <br>
            <div class="section">
                <p>
                    <i class="icon fab fa-linkedin text-darkblue"></i><?php echo $user['prenom']. "-".$user['nom'] ?>
                </p>
            </div>
            <div class="section">
            <h2>À PROPOS</h2>
            <?php 
                $tache = null;
                foreach ($exp as $experience) { 
                    if($experience != NULL) {
                        $tache = $experience['tache'];
                        break;
                    }
                }
            ?>
            <p>
                Le <strong><?php if($tache != NULL) { echo $tache; } ?></strong> est une de mes passions : j’aime intégrer ou imaginer des interfaces modernes, les rendre responsive et les dynamiser avec des animations élégantes. Mes deux technos de coeur sont <strong>Angular</strong> et <strong>Bootstrap</strong>, que j’utilise depuis plus de 6 ans. Je suis aussi Fullstack : PHP, MySQL, Doctrine…
            </p>
            </div>
            
        </div>
        <div class="right-column">
            <div class="header">
                <div class="logo-div">
                <h1><?php echo $user['prenom']; ?> <span class="text-blue text-uppercase"><?php echo $user['nom'] ?></span></h1><img class="img" src="logo.png">
                </div>
                <p>Freelance Front-end Developer</p>
                <ul class="infos">
                    <li><i class="icon fas fa-at text-blue"></i> <a href="<?php echo $user['email']?>"><?php echo $user['email']?></a></li>
                    <li><i class="icon fas fa-phone text-blue"></i>+216 <?php echo $user['tel']?></li>
                    <li><i class="icon fas fa-map-marker-alt text-blue"></i> Tunis, Ariana, Technopole Ghazela, Esprit 2088</li>
                    <li><i class="icon fas fa-calendar-alt text-blue"></i> <?php echo $user['date_naissance']?></li>
                </ul>
            </div>
            <div class="content">
                    <!--////////////////////////////////////////////////////////////////////////////////////////////-->
                <div class="section">
                    <h2>Experiences <br><span class="text-blue">professionnelles</span></h2>
                    <?php foreach ($exp as $experience) : ?>
                        <p>
                            <strong><?php echo date('F Y', strtotime($experience['date_exp'])); ?><strong>
                            <br>
                            <?php echo $experience['poste'] ?> chez <em><?php echo $experience['entreprise'] ?></em>
                        </p>
                        <ul class="experience-list">
                            <?php foreach (explode(',', $experience['tache']) as $responsibility) : ?>
                                <li><?php echo $responsibility ?></li>
                            <?php endforeach; ?>
                    <br><br>
                        </ul>
                    <?php endforeach; ?>
                </div>
                    <!--////////////////////////////////////////////////////////////////////////////////////////////-->
                <div class="section">
                    <h2>Études <br><span class="text-blue">& formations</span></h2>
                    <?php foreach ($edu as $education) : ?>
                        <p>
                            <strong><?php echo date('F Y', strtotime($education['date_edu'])); ?><strong>
                            <br>
                            <?php echo $education['type_d'] ?> chez <em><?php echo $education['ecole'] ?></em>
                        </p>
                        <ul class="education-list">
                            <?php foreach (explode(',', $education['diplom']) as $domain) : ?>
                                <li><?php echo $domain ?></li>
                            <?php endforeach; ?>
                    <br><br>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</body>

