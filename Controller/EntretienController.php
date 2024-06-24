<?php
    require_once __DIR__ . "/../config/connexion.php";
    require_once __DIR__ . "/../Model/ClassEntretien.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    session_start();


    class EntretienController {


        public function getEntretienById($id_entretien) {
            try {
                $pdo = openDB();
                $requete = "SELECT * FROM entretiens WHERE id = :id_entretien";
                $statement = $pdo->prepare($requete);
                $statement->bindParam(':id_entretien', $id_entretien, PDO::PARAM_INT);
                $statement->execute();
    
                // Récupérer les détails de l'entretien
                $entretien = $statement->fetch(PDO::FETCH_ASSOC);
                return $entretien;
            } catch (PDOException $e) {
                echo "Erreur lors de la récupération de l'entretien : " . $e->getMessage();
                return null;
            }
        }
        public function readEntretiens($startIndex, $itemsPerPage,$id){ 
            try { 
                $pdo = openDB(); 
                $query = "SELECT e.id, e.date_heure, e.lien, e.id_entre, c.idOffre, t.type_entretien, o.titreOffre, o.compOffre, u.nom ,u.prenom 
                          FROM entretiens e 
                          INNER JOIN candidature c ON e.offre_id = c.idCandidature 
                          INNER JOIN type_entretiens t ON e.id_te = t.id_te 
                          INNER JOIN offre o ON c.idOffre = o.idOffre 
                          INNER JOIN users u ON c.idUser = u.id 
                          WHERE id_user = :id_user or id_entre = :id_user 
                          LIMIT :startIndex, :itemsPerPage"; 
                $statement = $pdo->prepare($query); 
                $statement->bindValue(':startIndex', $startIndex, PDO::PARAM_INT); 
                $statement->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT); 
                $statement->bindValue(':id_user', $id, PDO::PARAM_INT); 
                $statement->execute(); 
                return $statement->fetchAll(PDO::FETCH_ASSOC); 
            } 
            catch (PDOException $e) { 
                echo "Erreur lors de la récupération des entretiens : " . $e->getMessage(); 
                return []; 
            } 
        } 
        public function readEntretiensall($startIndex, $itemsPerPage){ 
            try { 
                $pdo = openDB(); 
                $query = "SELECT e.id, e.date_heure, e.lien, e.id_entre, c.idOffre, t.type_entretien, o.titreOffre, o.compOffre, u.nom ,u.prenom 
                          FROM entretiens e 
                          INNER JOIN candidature c ON e.offre_id = c.idCandidature 
                          INNER JOIN type_entretiens t ON e.id_te = t.id_te 
                          INNER JOIN offre o ON c.idOffre = o.idOffre 
                          INNER JOIN users u ON c.idUser = u.id 
                          LIMIT :startIndex, :itemsPerPage"; 
                $statement = $pdo->prepare($query); 
                $statement->bindValue(':startIndex', $startIndex, PDO::PARAM_INT); 
                $statement->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT); 
                $statement->execute(); 
                return $statement->fetchAll(PDO::FETCH_ASSOC); 
            } 
            catch (PDOException $e) { 
                echo "Erreur lors de la récupération des entretiens : " . $e->getMessage(); 
                return []; 
            } 
        } 
        public function countEntretiens(){
            try {   
                $pdo = openDB();
                $query = "SELECT COUNT(*) FROM entretiens WHERE id_user = :id_user";
                $statement = $pdo->prepare($query);
                $statement->bindValue(':id_user', $_SESSION['id'], PDO::PARAM_INT);
                $statement->execute();
                // Utilisez fetchColumn() pour récupérer le nombre total d'entretiens
                $totalEntretiens = $statement->fetchColumn();
                return $totalEntretiens;
            } catch (PDOException $e) {
                echo "Erreur lors du comptage des entretiens : " . $e->getMessage();
                return false;
            }
        }

        public function deleteEntretien($id_entretien) {
            try {
                $pdo = openDB();
                $query = "DELETE FROM entretiens WHERE id = :id_entretien";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':id_entretien', $id_entretien, PDO::PARAM_INT);
                $statement->execute();
                return true;
            } catch (PDOException $e) {
                echo "Erreur lors de la suppression de l'entretien : " . $e->getMessage();
                return false;
            }
        }



        public function addEntretien($date_heure, $lien, $offre_id, $id_te,$user_id,$entre_id) {
            try {
                $pdo = openDB();
                $requete = "INSERT INTO entretiens (date_heure, lien, offre_id, id_te, id_user,id_entre) VALUES (:date_heure, :lien, :offre_id, :id_te, :id_user,:id_entre)";
                $statement = $pdo->prepare($requete);
                $statement->bindParam(':date_heure', $date_heure, PDO::PARAM_STR);
                $statement->bindParam(':lien', $lien, PDO::PARAM_STR);
                $statement->bindParam(':offre_id', $offre_id, PDO::PARAM_INT);
                $statement->bindParam(':id_te', $id_te, PDO::PARAM_INT);
                $statement->bindParam(':id_user', $user_id, PDO::PARAM_INT);
                $statement->bindParam(':id_entre', $entre_id, PDO::PARAM_INT);
                
                if ($statement->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                echo "Erreur PDO : " . $e->getMessage();
                return false;
            }
        }
        
        

        public function send_email($email, $name, $date, $poste, $type) {
            $Username = 'cashogo.tn@gmail.com';
            $Password = 'sznc taqr oqzc lpjk';
            $mail_sender = new MailSender($Username, $Password);
    
            $email_to_send_to = $email;
            
            $subject = "Nouvel entretien pour $name";
            $msg = "Cher M(me) $name,<br>Vous avez été retenu pour un entretien de type $type le $date pour le poste de $poste.<br>Connectez-vous rapidement sur votre compte sur www.bytequest.com afin d'en savoir plus sur les modalités de votre futur RV.<br><br> A bientôt sur ByteQuest !";
    
            $mail_send_res = $mail_sender->send_normal_mail($email_to_send_to, $subject, $msg);
    
            if ($mail_send_res == "mail sent") {
            } else {
                return "error : " . $mail_send_res;
            }
        }



        public function updateEntretien($id_entretien, $nouveau_type, $nouvelle_date_heure, $nouveau_lien_meet) {
            try {
                $pdo = openDB();
                $requete = "UPDATE entretiens SET id_te=?, date_heure=?, lien=? WHERE id=?";
                $statement = $pdo->prepare($requete);
                $statement->execute([$nouveau_type, $nouvelle_date_heure, $nouveau_lien_meet, $id_entretien]);
        
                return true;
            } catch (PDOException $e) {
                echo "Erreur lors de la modification de l'entretien : " . $e->getMessage();
                return false;
            }
        }

        public function searchEntretiensByDate($inputDate, $past = false) {
            try {
                $pdo = openDB();
                if ($past) {
                    $query = "SELECT e.id, e.date_heure, e.lien, c.idOffre, t.type_entretien, o.titreOffre, o.compOffre, u.nom 
                            FROM entretiens e 
                            INNER JOIN candidature c ON e.offre_id = c.idCandidature 
                            INNER JOIN type_entretiens t ON e.id_te = t.id_te 
                            INNER JOIN offre o ON c.idOffre = o.idOffre 
                            INNER JOIN users u ON c.idUser = u.id 
                            WHERE DATE(e.date_heure) < DATE(:inputDate)";
                } else {
                    $query = "SELECT e.id, e.date_heure, e.lien, c.idOffre, t.type_entretien, o.titreOffre, o.compOffre, u.nom 
                            FROM entretiens e 
                            INNER JOIN candidature c ON e.offre_id = c.idCandidature 
                            INNER JOIN type_entretiens t ON e.id_te = t.id_te 
                            INNER JOIN offre o ON c.idOffre = o.idOffre 
                            INNER JOIN users u ON c.idUser = u.id 
                            WHERE DATE(e.date_heure) >= DATE(:inputDate)";
                }
                $statement = $pdo->prepare($query);
                $statement->bindParam(':inputDate', $inputDate, PDO::PARAM_STR);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Erreur lors de la recherche des entretiens par date : " . $e->getMessage();
                return [];
            }
        }

        public function searchEntretiensByDate2($inputDate) {
            try {
                $pdo = openDB();
                $query = "SELECT e.id, e.date_heure, e.lien, c.idOffre, t.type_entretien, o.titreOffre, o.compOffre, u.nom 
                        FROM entretiens e 
                        INNER JOIN candidature c ON e.offre_id = c.idCandidature 
                        INNER JOIN type_entretiens t ON e.id_te = t.id_te 
                        INNER JOIN offre o ON c.idOffre = o.idOffre 
                        INNER JOIN users u ON c.idUser = u.id 
                        WHERE DATE(e.date_heure) = DATE(:inputDate)";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':inputDate', $inputDate, PDO::PARAM_STR);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Erreur lors de la recherche des entretiens par date : " . $e->getMessage();
                return [];
            }
        }
        


        
    public function filterEntretiensByOffreEntrepriseCandidat($searchTerm) {
        try {
            $pdo = openDB();
            $query = "SELECT e.id, e.date_heure, e.lien, c.idOffre, t.type_entretien, o.titreOffre, o.compOffre, u.nom 
                    FROM entretiens e 
                    INNER JOIN candidature c ON e.offre_id = c.idCandidature 
                    INNER JOIN type_entretiens t ON e.id_te = t.id_te 
                    INNER JOIN offre o ON c.idOffre = o.idOffre 
                    INNER JOIN users u ON c.idUser = u.id 
                    WHERE o.titreOffre LIKE :searchTerm 
                    OR o.compOffre LIKE :searchTerm 
                    OR u.nom LIKE :searchTerm"; // Ajout de la recherche par nom du candidat
            $statement = $pdo->prepare($query);
            $searchTerm = "%".$searchTerm."%";
            $statement->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la recherche des entretiens par Offre, Entreprise ou Candidat : " . $e->getMessage();
            return [];
        }
    }


    public function getAllEntretiens() {
        try {
            // Connexion à la base de données
            $pdo = openDB();
            
            // Requête pour récupérer les données des entretiens
            $query = "SELECT e.date_heure, e.lien, t.type_entretien, o.titreOffre, o.compOffre, u.nom 
            FROM entretiens e 
            INNER JOIN candidature c ON e.offre_id = c.idCandidature 
            INNER JOIN type_entretiens t ON e.id_te = t.id_te 
            INNER JOIN offre o ON c.idOffre = o.idOffre 
            INNER JOIN users u ON c.idUser = u.id
            WHERE id_user=:id_user or id_entre = :id_user";

            $statement = $pdo->prepare($query);
            $statement->bindValue(':id_user', $_SESSION['id'], PDO::PARAM_INT);
            $statement->execute();
            $entretiens = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            // Retourner les entretiens
            return $entretiens;
        } catch (PDOException $e) {
            // En cas d'erreur, afficher un message d'erreur et retourner une liste vide
            echo "Erreur lors de la récupération des entretiens : " . $e->getMessage();
            return [];
        }
    }



    
    public function getDistinctEntretienTypes() {
        try {
            $pdo = openDB();
            $query = "SELECT DISTINCT type_entretien FROM type_entretiens";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $types = $statement->fetchAll(PDO::FETCH_COLUMN);
            return $types;
        } catch (PDOException $e) {
            
            return [];
        }
    }
    
    
    public function filterEntretiensByType($type) {
        try {
            $pdo = openDB();
            $query = "SELECT e.id, e.date_heure, e.lien, c.idOffre, t.type_entretien, o.titreOffre, o.compOffre, u.nom 
                    FROM entretiens e 
                    INNER JOIN candidature c ON e.offre_id = c.idCandidature 
                    INNER JOIN type_entretiens t ON e.id_te = t.id_te 
                    INNER JOIN offre o ON c.idOffre = o.idOffre 
                    INNER JOIN users u ON c.idUser = u.id 
                    WHERE t.type_entretien = :type";
            $statement = $pdo->prepare($query);
            $statement->bindParam(':type', $type, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la recherche des entretiens par type : " . $e->getMessage();
            return [];
        }
    }
    
    
        
        
}     

    

    class MailSender
    {
        private $user_name, $password, $email_to_send_to, $subject, $msg;
    
        public function __construct($user_name, $password)
        {
            $this->user_name = $user_name;
            $this->password = $password;
        }
    
        public function set_user_name($val)
        {
            $this->user_name = $val;
        }
    
        public function get_user_name()
        {
            return $this->user_name;
        }
    
        public function set_password($val)
        {
            $this->password = $val;
        }
    
        public function get_password()
        {
            return $this->password;
        }
    
        public function set_email_to_send_to($val)
        {
            $this->email_to_send_to = $val;
        }
    
        public function get_email_to_send_to()
        {
            return $this->email_to_send_to;
        }
    
        public function set_subject($val)
        {
            $this->subject = $val;
        }
    
        public function get_subject()
        {
            return $this->subject;
        }
    
        public function set_msg($val)
        {
            $this->msg = $val;
        }
    
        public function get_msg()
        {
            return $this->msg;
        }
    
        function send_normal_mail($email_to_send_to, $email_subject, $email_msg){
            $mail = new PHPMailer(true);
            
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username =  $this->get_user_name(); # 'cashogo.tn@gmail.com';
                $mail->Password = $this->get_password(); # 'sznc taqr oqzc lpjk';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
    
                $mail->setFrom($mail->Username);
    
                $mail->addAddress($email_to_send_to);
    
                $mail->isHTML(true);
                $mail->Subject = $email_subject;
                $mail->Body    = $email_msg;
    
                $mail->send();
                #echo 'Message has been sent';
                return "mail sent";
            }
            catch (Exception $e) {
                #echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return "$mail->ErrorInfo";
            }
        }
    
        
    
    }

?>