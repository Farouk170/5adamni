<?php
    require_once __DIR__. "/../config/connexion.php";
    require_once __DIR__. "/../Model/CV.php";
   
class educationC{
        
        public function ajouter_edu($education){
            $pdo = openDB();
            try {
                $query = $pdo->prepare(
                    "INSERT INTO education (id_diplom,ecole, date_edu, diplom, diplom_jpg, id_user) VALUES (:id_diplom,:ecole, :date_edu, :domain_diplom, :diplom_jpg, :id_user)");
                $id_user=4;
                $success = $query->execute([
                    'id_diplom' => $education->getId_diplom(),
                    'ecole' => $education->getEcole(),
                    'date_edu' => $education->getDate_edu(),
                    'diplom' => $education->getDiplom(),
                    'diplom_jpg' => $education->getDiplom_jpg(),
                    'id_user'=>$id_user
                ]);
        
                if ($success) {
                    echo "L education a été ajoutée avec succès.";
                } else {
                    echo "Échec de l'ajout du education";
            } 
        }
        catch (PDOException $e) {
            echo "Erreur lors de l'ajout du education : " . $e->getMessage();
        }
    }


        function supprimer_edu($id_education)
        {
            $pdo =openDB();
        
            $query =$pdo ->prepare("DELETE FROM education WHERE id_education = :id_education");
            $query ->bindValue (':id_education',$id_education);
        
            try{
                $query ->execute();
            }
            catch (PDOException $e)
            {
                $e ->getMessage();
            }
    }

    public function modifier_edu($id_education, $ecole, $date_edu, $diplom, $id_diplom,$diplom_jpg) {
        try {
            $db = openDB();
            $stmt = $db->prepare("UPDATE education SET id_diplom = :id_diplom, ecole = :ecole, date_edu = :date_edu, diplom = :diplom, diplom_jpg = :diplom_jpg WHERE id_education = :id_education");
            $fileTmpPath = $_FILES["diplom_jpg"]["tmp_name"];
            $fileContent = file_get_contents($fileTmpPath);
            $stmt->bindParam(':id_diplom', $id_diplom);
            $stmt->bindParam(':id_education', $id_education);
            $stmt->bindParam(':ecole', $ecole);
            $stmt->bindParam(':date_edu', $date_edu);
            $stmt->bindParam(':diplom', $diplom);
            $stmt->bindParam(':diplom_jpg', $fileContent, PDO::PARAM_LOB);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} 

class experienceC{
        
            public function ajouter_exp($experience){
                $pdo = openDB();
                try {
                    $query = $pdo->prepare(
                        "INSERT INTO experience (poste, entreprise, date_exp, tache, id_user) VALUES (:poste, :entreprise, :date_exp, :tache, :id_user)"
                    );
                    $id_user=4;
                    $success = $query->execute([
                       
                        'poste' => $experience->getPoste(),
                        'entreprise' => $experience->getEntreprise(),
                        'date_exp' => $experience->getDate_exp(),
                        'tache' => $experience->getTache(),
                        'id_user'=>$id_user
                    ]);
            
                    if ($success) {
                        echo "L experience a été ajoutée avec succès.";
                    } else {
                        echo "Échec de l'ajout du experience";
                } 
            }
            catch (PDOException $e) {
                echo "Erreur lors de l'ajout du experience : " . $e->getMessage();
            }
        }
    
    
            function supprimer_exp($id_experience)
            {
                $pdo =openDB();
            
                $query =$pdo ->prepare("DELETE FROM experience WHERE id_experience = :id_experience");
                $query ->bindValue (':id_experience',$id_experience);
            
                try{
                    $query ->execute();
                }
                catch (PDOException $e)
                {
                    $e ->getMessage();
                }
        }
    
        public function modifier_exp($id_experience,$poste,$entreprise,$date_exp,$tache) {
            try {
                $db = openDB();
                $stmt =$db->prepare("UPDATE experience SET poste = :poste, entreprise = :entreprise, date_exp = :date_exp, tache = :tache  WHERE id_experience=:id_experience");
                $stmt->BindParam(':id_experience',$id_experience);
                $stmt->bindParam(':poste', $poste);
                $stmt->bindParam(':entreprise', $entreprise);
                $stmt->bindParam(':date_exp', $date_exp);
                $stmt->bindParam(':tache', $tache);
                $stmt->execute();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        
            }
            
class diplom{

            public function ajouter_diplom($type_d){
                $pdo = openDB();
                try {
                    $query = $pdo->prepare(
                        "INSERT INTO type_diplom (type_d) VALUES (:type_d)");
            
                    $success = $query->execute([
                       
                        'type_d' => $type_d->getType_d()]);
            
                    if ($success) {
                        echo "Le diplome a été ajoutée avec succès.";
                    } else {
                        echo "Échec de l'ajout du diplome";
                } 
            }
            catch (PDOException $e) {
                echo "Erreur lors de l'ajout du diplome : " . $e->getMessage();
            }
        }
        function supprimer_exp($id_type_diplom)
        {
            $pdo =openDB();
        
            $query =$pdo ->prepare("DELETE FROM type_diplom WHERE id_type_diplom = :id_type_diplom");
            $query ->bindValue (':id_type_diplom',$id_type_diplom);
        
            try{
                $query ->execute();
            }
            catch (PDOException $e)
            {
                $e ->getMessage();
            }
    }



        }
?>