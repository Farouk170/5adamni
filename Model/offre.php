<?php

class Offre{
  //  private int $idOffre;
    private string $titreOffre;
    private string $logo;
    private string $descOffre;
    private float $salaireOffre;
    private string $typeContrat;
    private string $localOffre;
    private string $dateP_offre;
    private string $dateEx_offre;
    private string $compOffre;
    private string $nvEtude;
    private string $expOffre;
    private string $catgOffre;
    private string $statutOffre;
    private int $nbPostes;
    private string $langOffre;
    private string $cleOffre;
    private string $latitude;
    private string $longitude;
    private int $idUser;


   
     public function __construct($titreOffre,$logo,$descOffre,$salaireOffre,$typeContrat,$localOffre,$dateP_offre,$dateEx_offre,$compOffre,$nvEtude,
     $expOffre,$catgOffre,$statutOffre,$nbPostes,$langOffre,$cleOffre,$latitude,$longitude,$idUser ){
      // $this->idOffre=$idOffre;
       $this->titreOffre=$titreOffre;
       $this->logo=$logo;
       $this->descOffre=$descOffre;
       $this->salaireOffre=$salaireOffre;
       $this->typeContrat=$typeContrat;
       $this->localOffre=$localOffre;
       $this->dateP_offre=$dateP_offre;
       $this->dateEx_offre=$dateEx_offre;
       $this->compOffre=$compOffre;
       $this->nvEtude=$nvEtude;
       $this->expOffre=$expOffre;
       $this->catgOffre=$catgOffre;
       $this->statutOffre=$statutOffre;
       $this->nbPostes=$nbPostes;
       $this->langOffre=$langOffre;
       $this->cleOffre=$cleOffre;
       $this->latitude=$latitude;
       $this->longitude=$longitude;
       $this->idUser=$idUser;

     }

    

     

     public function getIdUser(){
        return  $this->idUser;
    }
     public function getLatitude(){
        return  $this->latitude;
    }

    public function getLongitude(){
        return  $this->longitude;
    }



    public function getTitreOffre(){
        return  $this->titreOffre;
    }

    public function getLogo(){
        return $this->logo;
    }
    public function getDescOffre(){
        return  $this->descOffre;
    }

    public function getSalaireOffre(){
        return $this->salaireOffre;
    }

    public function getTypeContrat(){
        return  $this->typeContrat;
    }
    public function getLocalOffre(){
        return  $this->localOffre;
    }
    public function getDateP_offre(){
        return $this->dateP_offre;
    }
    public function getDateEx_offre(){
        return $this->dateEx_offre;
    }
    public function getCompOffre(){
        return $this->compOffre;
    }
    public function getNvEtude(){
        return  $this->nvEtude;
    } 
    public function getExpOffre(){
        return $this->expOffre;
    } 
    public function getCatgOffre(){
        return $this->catgOffre;
    }
    public function getStatutOffre(){
        return $this->statutOffre;
    }
    public function getNbPostes(){
        return $this->nbPostes;
    }
    public function getLangOffre(){
        return $this->langOffre;
    }
    public function getCleOffre(){
        return  $this->cleOffre;
    }


}




?>