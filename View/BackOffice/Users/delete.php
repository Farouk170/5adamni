<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <?php
        require_once __DIR__."../../../../Controller/UserController.php";
        $usrc=new UserC();
        $usrc->DeleteUser($_GET['cin']);
    ?>
</head>
<body>
</body>
</html>