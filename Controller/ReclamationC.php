<?php
require_once "../../../config/connexion.php";

class ReclamationC
{



    public function listeReclamations()
    {
        $sql = "SELECT * FROM reclamation ORDER BY dateRec DESC";
        $db = openDB();
        try {
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo "Erreur ! " . $e->getMessage();
            return [];
        }
    }
    public function listeReclamationsById($idUser)
    {
        $sql = "SELECT * FROM reclamation WHERE idUser=$idUser ORDER BY dateRec DESC";
        $db = openDB();
        try {
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo "Erreur ! " . $e->getMessage();
            return [];
        }
    }


    public function ajouterReclamation($Reclamation)
    {
        $pdo = openDB();
        try {
            $query = $pdo->prepare(
                "INSERT INTO reclamation (categorieRec, titleRec, textRec, dateRec, imgRec, statRec, idUser, archiveRec, archiveBackRec)
                    VALUES (:categorieRec, :titleRec, :textRec, :dateRec, :imgRec, :statRec, :idUser, :archiveRec, :archiveBackRec)"
            );
            

            $success = $query->execute([
                'categorieRec' => $Reclamation->getCategorieRec(),
                'titleRec' => $Reclamation->getTitleRec(),
                'textRec' => $Reclamation->getTextRec(),
                'dateRec' => $Reclamation->getDateRec(),
                'imgRec' => $Reclamation->getImgRec(),
                'statRec' => $Reclamation->getStatRec(),
                'idUser' =>  $Reclamation->getIdUser(),
                'archiveRec' =>  $Reclamation->getArchiveRec(),
                'archiveBackRec' =>  $Reclamation->getArchiveBackRec(),

            ]);

            if ($success) {
                // Inséré avec succès
                echo "La réclamation a été ajoutée avec succès.";
                echo '<script>window.location.href = "reclamationIndex.php";</script>';
            } else {
                // Échec de l'insertion
                echo "Échec de l'ajout de la réclamation.";
            }
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Erreur lors de l'ajout de la réclamation : " . $e->getMessage();
        }
    }
    public function ajouterReponse($reponse){
        $pdo = openDB();
        try {
            $query = $pdo->prepare(
                "INSERT INTO reponse (idRec, dateRep, textRep, idUser)
                VALUES (:idRec, NOW(), :textRep, :idUser)"
            );
         
            $success = $query->execute([
                'idRec' => $reponse->getIdRec(),
                'textRep' => $reponse->getTextRep(),     
                'idUser' => $reponse->getIdUser(), 
         
            ]);

            if ($success) {
                // Inséré avec succès
                echo "La reponse a été ajoutée avec succès.";
            } else {
                // Échec de l'insertion
                echo "Échec de l'ajout de la reponse.";
            }
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo "Erreur lors de l'ajout de la candidature : " . $e->getMessage();
        }
    }


    public function supprimerReclamation($idRec)
    {
        $sql = "DELETE FROM reclamation WHERE idRec = :idRec";
        $pdo = openDB();

        $query = $pdo->prepare($sql);
        $query->bindValue(':idRec', $idRec);

        try {
            $query->execute();
            //ou bien execute(['num]=>$num); fi blaset bindValue

        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    function recupererReclamation($idRec)
    {
        $sql = "SELECT * from reclamation where idRec=$idRec";
        $db = openDB();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }


    public function modifierReclamation($Reclamation, $idRec)
    {
        $sql = "UPDATE reclamation SET categorieRec=:categorieRec, titleRec=:titleRec, textRec=:textRec  WHERE idRec=:idRec";

        $db = openDB();
        try {
            $req = $db->prepare($sql);

            // Récupération des valeurs de l'objet $Reclamation
            $categorieRec = $Reclamation->getCategorieRec();
            $titleRec = $Reclamation->getTitleRec();
            $textRec = $Reclamation->getTextRec();


            // Liaison des valeurs avec les paramètres dans la requête
            $req->bindValue(':idRec', $idRec);
            $req->bindValue(':categorieRec', $categorieRec);
            $req->bindValue(':titleRec', $titleRec);
            $req->bindValue(':textRec', $textRec);


            // Exécution de la requête
            $req->execute();

            echo $req->rowCount() . " records UPDATED successfully";

        } catch (PDOException $e) {
            echo " Erreur ! " . $e->getMessage();
        }
    }
    public function modifierStatutReclamation($idRec, $newStatut)
    {
        $sql = "UPDATE reclamation SET statRec = :newStatut WHERE idRec = :idRec";

        $db = openDB();
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':idRec', $idRec);
            $req->bindValue(':newStatut', $newStatut);
            $req->execute();
        } catch (PDOException $e) {
            echo "Erreur ! " . $e->getMessage();
        }
    }
    public function modifierEtatArchive($idRec, $newEtat)
    {
        $sql = "UPDATE reclamation SET archiveRec = :newEtat WHERE idRec = :idRec";

        $db = openDB();
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':idRec', $idRec);
            $req->bindValue(':newEtat', $newEtat);
            $req->execute();
        } catch (PDOException $e) {
            echo "Erreur ! " . $e->getMessage();
        }
    }
    public function modifierEtatArchiveBack($idRec, $newEtat)
    {
        $sql = "UPDATE reclamation SET archiveBackRec = :newEtat WHERE idRec = :idRec";

        $db = openDB();
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':idRec', $idRec);
            $req->bindValue(':newEtat', $newEtat);
            $req->execute();
        } catch (PDOException $e) {
            echo "Erreur ! " . $e->getMessage();
        }
    }

    public function recupererReclamationParId($idRec)
    {
        $pdo = openDB();
        try {
            $query = $pdo->prepare("SELECT * FROM reclamation WHERE idRec = :idRec");
            $query->bindParam(':idRec', $idRec, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erreur lors de la récupération de la réclamation : ' . $e->getMessage());
            return false;
        }
    }
    // Méthode pour obtenir les réponses recommandées complexes

}
?>