<?php

class education{
    private int $id_education;
    private int $id_diplom;
    private int $id_user;
    private string $ecole;
    private int $date_edu;
    private string $diplom;
    private string $diplom_jpg;
    
   
     public function __construct($ecole,$date_edu,$diplom,$diplom_jpg,$id_user){
        $this->ecole=$ecole;
        $this->date_edu=$date_edu;
        $this->diplom=$diplom;
        $this->diplom_jpg=$diplom_jpg;
        $this->id_user=$id_user;

     }
     public function getId_diplom(){
        return  $this->Id_diplom;
    }

     public function getId_education(){
        return  $this->Id_education;
    }
    
    public function getEcole(){
        return  $this->ecole;
    }

    public function getDate_edu(){
        return $this->date_edu;
    }
    public function getDiplom(){
        return  $this->diplom;
    }

    public function getDiplom_jpg(){
        return $this->diplom_jpg;
    }
    public function getId_user(){
        return $this->id_user;
    }
   
}

class experience{
    private int $id_experience;
    private int $id_user;
    private string $poste;
    private string $entreprise;
    private int $date_exp;
    private string $tache;
    
   
     public function __construct($poste,$entreprise,$date_exp,$tache,$id_user){
        $this->poste=$poste;
        $this->entreprise=$entreprise;
        $this->date_exp=$date_exp;
        $this->tache=$tache;
        $this->id_user=$id_user;

     }

     public function getId_experience(){
        return  $this->Id_experience;
    }
    
    public function getPoste(){
        return  $this->poste;
    }

    public function getEntreprise(){
        return $this->entreprise;
    }
    public function getDate_exp(){
        return  $this->date_exp;
    }

    public function getTache(){
        return $this->tache;
    }
    public function getId_user(){
        return $this->id_user;
    }


   
}
class diplome{
    private $type_d;

    public function __construct($type_d){
        $this->type_d=$type_d;
        
     }

     public function getType_d(){
        return  $this->Type_d;
    }
   
}


?>