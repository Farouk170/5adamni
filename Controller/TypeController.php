<?php
    require_once __DIR__ . "/../config/connexion.php";
    require_once __DIR__ . "/../Model/ClassType.php";

    class TypeController {
        
        public function getAllTypes() {
            try {
                $pdo = openDB();
                $requete = $pdo->query("SELECT * FROM type_entretiens");
                $types_entretiens = $requete->fetchAll(PDO::FETCH_ASSOC); 
               
                return $types_entretiens;
                
            } catch (PDOException $e) {
                    throw $e;
            }
        }
        

        public function getTypeById($id_entretien) {
            try {
                $pdo = openDB();
                $requete = "SELECT * FROM type_entretiens WHERE id_te = :id_entretien";
                $statement = $pdo->prepare($requete);
                $statement->bindParam(':id_entretien', $id_entretien, PDO::PARAM_INT);
                $statement->execute();
                
                // Vérifier si un type d'entretien correspondant à l'ID a été trouvé
                if ($statement->rowCount() > 0) {
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    $type_entretien = new TypeEntretien($row['id_te'], $row['type_entretien'], $row['description']);
                    return $type_entretien;
                } else {
                    // Aucun type d'entretien trouvé avec cet ID
                    return null;
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la récupération du type d'entretien : " . $e->getMessage();
                return null;
            }
        }
        
        public function readTypes($startIndex, $itemsPerPage) {
            try {
                $pdo = openDB();
                $query = "SELECT * FROM type_entretiens LIMIT :startIndex, :itemsPerPage";
                $statement = $pdo->prepare($query);
                $statement->bindValue(':startIndex', $startIndex, PDO::PARAM_INT);
                $statement->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Erreur lors de la récupération des types d'entretiens : " . $e->getMessage();
                return [];
            }
        }
    
        public function countTypes() {
            try {
                $pdo = openDB();
                $query = "SELECT COUNT(*) FROM type_entretiens";
                $statement = $pdo->query($query);
                $totalTypes = $statement->fetchColumn();
                return $totalTypes;
            } catch (PDOException $e) {
                echo "Erreur lors du comptage des types d'entretiens : " . $e->getMessage();
                return false;
            }
        }

        public function deleteType($id_te) {
            try {
                $pdo = openDB();
                $requete = "DELETE FROM type_entretiens WHERE id_te=:id_te";
                $statement = $pdo->prepare($requete);
                $statement->bindParam(':id_te', $id_te, PDO::PARAM_INT);
        
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

        public function addType($type_entretien, $description) {
            try {
                $pdo = openDB();
                $query = "INSERT INTO type_entretiens (type_entretien, description) VALUES (:type_entretien, :description)";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':type_entretien', $type_entretien, PDO::PARAM_STR);
                $statement->bindParam(':description', $description, PDO::PARAM_STR);
                
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

        public function updateType($id_te, $newType, $newDescription) {
            try {
                $pdo = openDB();
                $query = "UPDATE type_entretiens SET type_entretien = :newType, description = :newDescription WHERE id_te = :id_te";
                $statement = $pdo->prepare($query);
                $statement->bindParam(':id_te', $id_te, PDO::PARAM_INT);
                $statement->bindParam(':newType', $newType, PDO::PARAM_STR);
                $statement->bindParam(':newDescription', $newDescription, PDO::PARAM_STR);
                
                return $statement->execute();
            } catch (PDOException $e) {
                echo "Erreur PDO : " . $e->getMessage();
                return false;
            }
        }
        
        
    }
?>
