<?php
class Reponse
{
    private string $idRec; // Clé étrangère à partir de la table Reclamation
    
    private string $textRep;

    private string $idUser;

    // Le constructeur ne nécessite pas idRep, car il est auto-incrémenté par la base de données
    public function __construct($idRec, $textRep, $idUser)
    {
        $this->idRec = $idRec;
     
        $this->textRep = $textRep;

        $this->idUser = $idUser;
    }
    // Getters et setters


    public function getTextRep()
    {
        return $this->textRep;
    }
    public function getIdRec()
    {
        return $this->idRec;
    }
    public function getIdUser()
    {
        return $this->idUser;
    }
}

?>