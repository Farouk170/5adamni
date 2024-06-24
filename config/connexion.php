<?php
if (!function_exists('openDB')) {
    function openDB() {
        $server = "localhost";
        $user = "root";
        $pwd = "";
        $DB = "5adamni";
        try {
            $pdo = new PDO(
                "mysql:host=$server;dbname=$DB", $user, $pwd,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            echo "DB not open: " . $e->getMessage();
        }
        return $pdo;
    }
}
?>