<?php
require_once "../../../config/connexion.php";

class ReponseC
{
    // Méthode pour lister toutes les réponses
    public function listeReponses()
    {
        $pdo = openDB();
        try {
            $query = $pdo->prepare('SELECT * FROM reponse');
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            // Logger l'erreur ou renvoyer une exception
            error_log('Erreur lors de la liste des réponses : ' . $e->getMessage());
            return false;
        }
    }

    // Méthode pour ajouter une réponse




    // Méthode pour supprimer une réponse
    public function supprimerReponse($idRep)
    {
        $pdo = openDB();
        try {
            $query = $pdo->prepare("DELETE FROM reponse WHERE idRep = :idRep");
            $query->bindParam(':idRep', $idRep, PDO::PARAM_INT);

            $query->execute();

            // Vérifier si la suppression a réussi
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            // Logger l'erreur
            error_log('Erreur lors de la suppression de la réponse : ' . $e->getMessage());
            return false;
        }
    }

    // Méthode pour récupérer une réponse par son ID
    public function recupererReponse($idRep)
    {
        $pdo = openDB();
        try {
            $query = $pdo->prepare("SELECT * FROM reponse WHERE idRep = :idRep");
            $query->bindParam(':idRep', $idRep, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Logger l'erreur
            error_log('Erreur lors de la récupération de la réponse : ' . $e->getMessage());
            return false;
        }
    }
    public function recupererDetailsReponse($idRec)
    {
        $pdo = openDB();
        try {
            $query = $pdo->prepare(
                "SELECT idRep, textRep FROM reponse WHERE idRec = :idRec"
            );
            $query->bindParam(':idRec', $idRec, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur lors de la récupération des détails de la réponse : ' . $e->getMessage();
            return false;
        }
    }

    // Méthode pour modifier une réponse
    public function modifierReponse($idRep, $textRep)
    {
        $pdo = openDB();
        try {
            $query = $pdo->prepare(
                "UPDATE reponse SET textRep = :textRep WHERE idRep = :idRep"
            );
            $query->bindParam(':idRep', $idRep, PDO::PARAM_INT);
            $query->bindParam(':textRep', $textRep, PDO::PARAM_STR);
            $query->execute();
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            echo 'Erreur lors de la modification de la réponse : ' . $e->getMessage();
            return false;
        }
    }
    public function recupererReponsesParReclamation($idRec)
    {
        $pdo = openDB();
        try {
            // Préparez la requête SQL pour récupérer toutes les réponses associées à une réclamation spécifique
            $query = $pdo->prepare("SELECT * FROM reponse WHERE idRec = :idRec");

            // Liez le paramètre idRec à la valeur fournie
            $query->bindParam(':idRec', $idRec, PDO::PARAM_INT);

            // Exécutez la requête
            $query->execute();

            // Récupérez et renvoyez toutes les réponses sous forme de tableau associatif
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Loggez l'erreur en cas de problème
            error_log('Erreur lors de la récupération des réponses : ' . $e->getMessage());
            return false;
        }
    }

    public function getSuggestionsByTitleAndCategory($titleRec, $categorieRec)
    {
        $pdo = openDB();
        try {
   
            $query = $pdo->prepare(
                'SELECT textRep 
                 FROM reponse 
                 JOIN reclamation ON reponse.idRec = reclamation.idRec
                 WHERE reclamation.titleRec = :titleRec
                 AND reclamation.categorieRec = :categorieRec'
            );

           
            $query->bindParam(':titleRec', $titleRec);
            $query->bindParam(':categorieRec', $categorieRec);

            
            $query->execute();

           
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          
            error_log('Erreur lors de la récupération des suggestions : ' . $e->getMessage());
            return false;
        }
    }




}
