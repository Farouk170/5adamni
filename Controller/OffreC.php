<?php
    include __DIR__.'/../config/connexion.php';
   
    class OffreC{
        
        public function listeOffres($id)
        {
            $pdo =openDB();
            {
                try
                {
                    $query = $pdo ->prepare (
                        'select * FROM offre where idUser=:idUser'
                    );
                    $query ->execute([
                   
                        'idUser' => $id
                    ]);
                    $result = $query ->fetchAll();  // fetchAll :  recuperer le resultat d'execution 
                    /*CODE PLUS REDUITS  remplace les 3 lignes ci dessus
                *********    $result = $pdo -> query ("SLECT *FROM adherent"); ************/
                    return $result;
                }catch(PDOException $e){
                    $e->getMessage();
                }
            }
        }
        public function AllOffers()
        {
            $pdo =openDB();
            {
                try
                {
                    $query = $pdo ->prepare (
                        'select * FROM offre '
                    );
                    $query ->execute();
                    $result = $query ->fetchAll();  // fetchAll :  recuperer le resultat d'execution 
                    /*CODE PLUS REDUITS  remplace les 3 lignes ci dessus
                *********    $result = $pdo -> query ("SLECT *FROM adherent"); ************/
                    return $result;
                }catch(PDOException $e){
                    $e->getMessage();
                }
            }
        }
        
        public function ajouterOffre($Offre){
            $pdo = openDB();
            try {
                $query = $pdo->prepare(
                    "INSERT INTO offre (titreOffre, logo, descOffre, salaireOffre, typeContrat, localOffre, dateP_offre, dateEx_offre, compOffre, nvEttude, expOffre, catgOffre, statutOffre, nbPostes, langOffre, cleOffre, latitude, longitude,idUser)
                    VALUES (:titreOffre, :logo, :descOffre, :salaireOffre, :typeContrat, :localOffre, :dateP_offre, :dateEx_offre, :compOffre, :nvEttude, :expOffre, :catgOffre, :statutOffre, :nbPostes, :langOffre, :cleOffre, :latitude, :longitude, :idUser)"
                );
                
        
                $success = $query->execute([
                   
                    'titreOffre' => $Offre->getTitreOffre(),
                    'logo' => $Offre->getLogo(),
                    'descOffre' => $Offre->getDescOffre(),
                    'salaireOffre' => $Offre->getSalaireOffre(),
                    'typeContrat' => $Offre->getTypeContrat(),
                    'localOffre' => $Offre->getLocalOffre(),
                    'dateP_offre' => $Offre->getDateP_offre(),
                    'dateEx_offre' => $Offre->getDateEx_offre(),
                    'compOffre' => $Offre->getCompOffre(),
                    'nvEttude' => $Offre->getNvEtude(),
                    'expOffre' => $Offre->getExpOffre(),
                    'catgOffre' => $Offre->getCatgOffre(),
                    'statutOffre' => $Offre->getStatutOffre(),
                    'nbPostes' => $Offre->getNbPostes(),
                    'langOffre' => $Offre->getLangOffre(),
                    'cleOffre' => $Offre->getCleOffre(),
                    'latitude' => $Offre->getLatitude(),
                    'longitude' => $Offre->getLongitude(),
                    'idUser' => $Offre->getIdUser()
                ]);
        
                if ($success) {
                    // Inséré avec succès
                    echo "L'offre a été ajoutée avec succès.";
                } else {
                    // Échec de l'insertion
                    echo "Échec de l'ajout de l'offre.";
                }
            } catch (PDOException $e) {
                // Gestion des erreurs
                echo "Erreur lors de l'ajout de l'offre : " . $e->getMessage();
            }
        }


        public function supprimerOffre($idOffre)
        {
            $sql ="DELETE FROM offre WHERE idOffre = :idOffre"; 
            $pdo =openDB();
        
            $query =$pdo ->prepare($sql);
            $query ->bindValue (':idOffre',$idOffre);
        
            try{
                $query ->execute();
                //ou bien execute(['num]=>$num); fi blaset bindValue
        
            }catch (PDOException $e)
            {
                $e ->getMessage();
            }
        }


public function details($idOffre)
{
$sql ="SELECT *FROM offre WHERE idOffre =$idOffre";
$pdo = openDB();

    try{
    $query =$pdo->prepare($sql);
    $query ->execute();

    $adherent =$query->fetch();
    return $adherent;

    }catch (PDOException $e)
    {
    $e ->getMessage();
    }   
}

function recupererOffre($idOffre){
    $sql="SELECT * from offre where idOffre=$idOffre";
    $db = openDB();
    try{
        $liste=$db->query($sql);
        return $liste;
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }
}

function recupererTitreOffre($idOffre) {
    $sql = "SELECT * FROM offre WHERE idOffre = :idOffre";
    $db = openDB();
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idOffre', $idOffre, PDO::PARAM_INT);
        $stmt->execute();
        $offre = $stmt->fetch(PDO::FETCH_ASSOC);
        return $offre;
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

function modifierOffre($Offre, $idOffre){
    $sql="UPDATE offre SET  titreOffre=:titreOffre, descOffre=:descOffre, salaireOffre=:salaireOffre, typeContrat=:typeContrat, localOffre=:localOffre, dateP_offre=:dateP_offre, dateEx_offre=:dateEx_offre, compOffre=:compOffre, nvEttude=:nvEttude, expOffre=:expOffre, catgOffre=:catgOffre, statutOffre=:statutOffre, nbPostes=:nbPostes, langOffre=:langOffre, cleOffre=:cleOffre WHERE idOffre=:idOffre";
   
    var_dump($sql);
    
    $db = openDB();
    try{		
        $req=$db->prepare($sql);

        
        $titreOffre = $Offre->getTitreOffre();
        //$logo = $Offre->getLogo();
        $descOffre = $Offre->getDescOffre();
        $salaireOffre = $Offre->getSalaireOffre();
        $typeContrat = $Offre->getTypeContrat();
        $localOffre = $Offre->getLocalOffre();
        $dateP_offre = $Offre->getDateP_offre();
        $dateEx_offre = $Offre->getDateEx_offre();
        $compOffre = $Offre->getCompOffre();
        $nvEttude = $Offre->getNvEtude();
        $expOffre = $Offre->getExpOffre();
        $catgOffre = $Offre->getCatgOffre();
        $statutOffre = $Offre->getStatutOffre();
        $nbPostes = $Offre->getNbPostes();
        $langOffre = $Offre->getLangOffre();
        $cleOffre = $Offre->getCleOffre();
       
        
    

        $req->bindValue(':idOffre',$idOffre);
        
        $datas = array(':idOffre'=>$idOffre,':titreOffre'=>$titreOffre,':descOffre'=>$descOffre,':salaireOffre;'=>$salaireOffre,':typeContrat'=>$typeContrat,':localOffre'=>$localOffre,':dateP_offre'=>$dateP_offre,':dateEx_offre'=>$dateEx_offre,':localOffre'=>$localOffre,':compOffre'=>$compOffre,':nvEttude'=>$nvEttude,':expOffre'=>$expOffre,':catgOffre'=>$catgOffre,':statutOffre'=>$statutOffre,':nbPostes'=>$nbPostes,':langOffre'=>$langOffre,':cleOffre'=>$cleOffre  );
        $req->bindValue(':idOffre',$idOffre);
        
        $req->bindValue(':titreOffre',$titreOffre);
       // $req->bindValue(':logo',$logo);
        $req->bindValue(':descOffre',$descOffre);
        $req->bindValue(':salaireOffre',$salaireOffre); 
        $req->bindValue(':typeContrat',$typeContrat); 
        $req->bindValue(':localOffre',$localOffre);
        $req->bindValue(':dateP_offre',$dateP_offre);
        $req->bindValue(':dateEx_offre',$dateEx_offre);
        $req->bindValue(':compOffre',$compOffre);
        $req->bindValue(':nvEttude',$nvEttude);
        $req->bindValue(':expOffre',$expOffre);
        $req->bindValue(':catgOffre',$catgOffre);
        $req->bindValue(':statutOffre',$statutOffre);
        $req->bindValue(':nbPostes',$nbPostes);
        $req->bindValue(':langOffre',$langOffre);
        $req->bindValue(':cleOffre',$cleOffre); 

        var_dump($req);

    
        $req->execute();
        echo $req->rowCount() . " records UPDATED successfully";
        
    }
    catch (PDOException $e){
        echo " Erreur ! ".$e->getMessage();
        echo " Les datas : " ;
        print_r($datas);
    }
}  


public function rechercherParTitre($id,$titre) {
    $pdo = openDB();
    try {
        $query = $pdo->prepare(
            "SELECT * FROM offre WHERE titreOffre LIKE :titre && idUser=:idUser"
        );

        $query->execute([
            'titre' => "%$titre%",
            'idUser' => $id
        ]);

        $resultats = $query->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    } catch (PDOException $e) {
        // Gérer les erreurs
        echo "Erreur lors de la recherche par titre : " . $e->getMessage();
    }
}
public function rechercherParTitreAll($titre){
    $pdo = openDB();
    try{
        $query = $pdo->prepare(
            "SELECT * FROM offre WHERE titreOffre LIKE :titre"
        );

        $query->execute([
            'titre' => "%$titre%"
        ]);

        $resultats = $query->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    }
    catch (PDOException $e){
        // Gérer les erreurs
        echo "Erreur lors de la recherche par titre : " . $e->getMessage();
    }
}



public function listeCandidatures($idOffre)
{
    $pdo = openDB();
    try
    {
        $query = $pdo->prepare('SELECT * FROM candidature WHERE idOffre = :idOffre');
        $query->execute(array(':idOffre' => $idOffre));
        $result = $query->fetchAll();  // fetchAll : récupérer le résultat d'exécution 
        return $result;
    }
    catch(PDOException $e)
    {
        // Afficher l'erreur et arrêter l'exécution du script
        die("Erreur lors de la récupération des candidatures : " . $e->getMessage());
    }
}
public function listeCandidaturesPostulant($idUser)
{
    $pdo = openDB();
    try
    {
        $query = $pdo->prepare('SELECT * FROM candidature WHERE idUser = :idUser');
        $query->execute(array(':idUser' => $idUser));
        $result = $query->fetchAll();  // fetchAll : récupérer le résultat d'exécution 
        return $result;
    }
    catch(PDOException $e)
    {
        // Afficher l'erreur et arrêter l'exécution du script
        die("Erreur lors de la récupération des candidatures : " . $e->getMessage());
    }
}



public function supprimerCandidature($idCandidature)
{
    $sql ="DELETE FROM candidature WHERE idCandidature = :idCandidature"; 
    $pdo =openDB();

    $query =$pdo ->prepare($sql);
    $query ->bindValue (':idCandidature',$idCandidature);

    try{
        $query ->execute();
        //ou bien execute(['num]=>$num); fi blaset bindValue

    }catch (PDOException $e)
    {
        $e ->getMessage();
    }
}
public function ajouterCandidature($candidature) {
    $pdo = openDB();
    try {
        $query = $pdo->prepare(
            "INSERT INTO candidature (dateCandidature, cvOffre, idOffre, idUser, etatCandidature)
            VALUES (:dateCandidature, :cvOffre, :idOffre, :idUser, :etatCandidature)"
        );

        $success = $query->execute([
            'dateCandidature' => $candidature->getDateCandidature(),
            'cvOffre' => $candidature->getCvOffre(),
            'idOffre' => $candidature->getId_offre(),
            'idUser' => $candidature->getIdUser(),
            'etatCandidature' => 'en cours de traitement'
        ]);

        if ($success) {
            // Inséré avec succès
            echo "La candidature a été ajoutée avec succès.";
        } else {
            // Échec de l'insertion
            echo "Échec de l'ajout de la candidature.";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de l'ajout de la candidature : " . $e->getMessage();
    }
}


        public function incrementerScoreOffre($idOffre) {
            $pdo = openDB();
            try {
                // Préparez la requête pour mettre à jour le score de l'offre
                $query = $pdo->prepare(
                    "UPDATE offre SET scoreOffre = scoreOffre + 1 WHERE idOffre = :idOffre"
                );
    
                // Liaison de la valeur de l'identifiant de l'offre
                $query->bindParam(':idOffre', $idOffre, PDO::PARAM_INT);
    
                // Exécution de la requête
                $query->execute();
            } catch (PDOException $e) {
                // Gestion des erreurs
                echo "Erreur lors de l'incrémentation du score de l'offre : " . $e->getMessage();
            }
        }

       

        public function incrementerScoreOffre_2($titreOffre) {
            $pdo = openDB();
            try {
                // Préparez la requête pour mettre à jour le score de l'offre
                $query = $pdo->prepare(
                    "UPDATE offre SET scoreOffre = scoreOffre + 1 WHERE titreOffre = :titreOffre"
                );
        
                // Liaison de la valeur du titre de l'offre
                $query->bindParam(':titreOffre', $titreOffre, PDO::PARAM_STR);
        
                // Exécution de la requête
                $query->execute();
            } catch (PDOException $e) {
                // Gestion des erreurs
                echo "Erreur lors de l'incrémentation du score de l'offre : " . $e->getMessage();
            }
        }

        public function mettreAJourEtatCandidature($idCandidature, $nouvelEtat) {
            $pdo = openDB();
            try {
                if (!empty($nouvelEtat)){
                    $query = $pdo->prepare(
                        "UPDATE candidature SET etatCandidature = :nouvelEtat WHERE idCandidature = :idCandidature"
                    );
        
                    $query->bindParam(':nouvelEtat', $nouvelEtat, PDO::PARAM_STR);
                    $query->bindParam(':idCandidature', $idCandidature, PDO::PARAM_INT);
                    $query->execute();
                    
                    echo "L'état de la candidature a été mis à jour avec succès.";
                } else {
                    echo "Le nouvel état de la candidature n'est pas valide.";
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la mise à jour de l'état de la candidature : " . $e->getMessage();
            }
        }
        public function countOffres(){
            $pdo = openDB();
            try {
                $query = $pdo->prepare(
                    "SELECT COUNT(*) AS totalOffres FROM offre"
                );

                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);

                return $result['totalOffres'];
            } catch (PDOException $e) {
                // Gérer les erreurs
                echo "Erreur lors du comptage des offres : " . $e->getMessage();
            }
        }
        public function AfficherOffreForum()
        {
            $pdo =openDB();
            {
                try
                {
                    $query = $pdo ->prepare (
                        'SELECT * FROM offre ORDER BY scoreOffre DESC LIMIT 3'
                    );
                    $query ->execute();
                    $result = $query ->fetchAll();
                    return $result;
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
            }
        }
        
}

    
?>