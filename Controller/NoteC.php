<?php

require_once "../../../config/connexion.php";
//require_once '..\..\Model\Note.php';

class NoteC
{



    function Noter($note)
    {
        $config = openDB();
        try {
            $querry = $config->prepare('
                INSERT INTO note
                (note,idRep,id_user )
                VALUES
                (:note,:idRep,:iduser)
                ');

            $rs = $querry->execute([

                'note' => $note->getNote(),
                'idRep' => $note->getIdRep(),
                'iduser' => $note->getIduser()




            ]);
            if ($rs) {
                echo "U Noted this reponse";
            } else {
                echo "ERROR";
            }
        } catch (PDOException $th) {
            $th->getMessage();
        }
    }

    function getNotes($idRep)
    {
        $config = openDB();
        try {
            $query = $config->prepare('SELECT AVG(note) AS average_note FROM note WHERE idRep = :idRep');
            $query->execute(['idRep' => $idRep]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $average_note = number_format($result['average_note'], 1);
            return $average_note;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function SupprimerNote($id, $iduser)
    {
        $sql = "DELETE FROM note WHERE idRep= :id AND id_user=:iduser";
        $db = openDB();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        $req->bindValue(':iduser', $iduser);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    function CheckNote($iduser, $idRep): int
    {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "5adamni";
        $conn = new mysqli($servername, $username, $password, $dbname);

     
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT COUNT(*) as total FROM Note WHERE idRep = $idRep AND id_user = $iduser";  
        $result = $conn->query($sql);
        if (!$result) {
            die("Error executing query: " . $conn->error);
        }

        $row = $result->fetch_assoc();
        $total = $row['total'];


        $conn->close();

        if ($total == 0) {
            return 0;
        } else

            return 1;


    }



}