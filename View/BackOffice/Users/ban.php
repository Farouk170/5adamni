<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ban</title>
    <?php
        require_once "../../../Controller/UserController.php";
        $usrc=new UserC();
        $usrc->BanUser($_GET['cin'],$_GET['duree']);
    ?>
</head>
<body>
</body>
</html>