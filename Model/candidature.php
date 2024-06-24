<?php

class candidature{
  //  private int $idOffre;
    private string $dateCandidature;
    private string $cvOffre;
    private int $id_offre;
    private int $idUser;
   
     public function __construct($dateCandidature,$cvOffre,$id_offre,$idUser){
       $this->dateCandidature=$dateCandidature;
       $this->cvOffre=$cvOffre;
       $this->id_offre=$id_offre;
       $this->idUser=$idUser;
     }

    
    public function getDateCandidature(){
        return  $this->dateCandidature;
    }

    public function getCvOffre(){
        return $this->cvOffre;
    }

    public function getId_offre(){
        return  $this->id_offre;
    }
    public function getidUser(){
      return  $this->idUser;
  }

    

   
    
   }
?>