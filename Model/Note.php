<?php 
class Note
{
private $id;
private $note;
private $idRep;
private $iduser;


function __construct(int $id,int $note,int $idRep,int $iduser){

    $this->id=$id;
   $this->note=$note;
    $this->iduser=$iduser;
    $this->idRep=$idRep;
 

} 


public function getIdRep() : int 
{
    return $this->idRep;
}
public function setIdRep(int $idanimal) 
{
    $this->idanimal=$idanimal;
}
public function getId() : int 
{
    return $this->id;
}
public function getNote() : int 
{
    return $this->note;
}
public function setNote(int $note) : void 
{
     $this->note=$note;
}

public function getIduser() : int 
{
    return $this->iduser;
}
function setId(string $id){
    $this->id=$id;
}


function setIduser(int $iduser)
{
    $this->iduser=$iduser;
}
}