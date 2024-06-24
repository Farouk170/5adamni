<?php
class Reclamation
{
    private string $idRec;

    private string $categorieRec;
    private string $titleRec;
    private string $textRec;
    private string $dateRec;
    private string $imgRec;
    
    private string $statRec;
    private string $idUser;

    private string $archiveRec;

    private string $archiveBackRec;

    public function __construct($categorieRec = '', $titleRec = '', $textRec = '', $dateRec = '', $imgRec = '', $statRec='', $idUser='', $archiveRec='', $archiveBackRec='')
    {
        $this->categorieRec = $categorieRec;
        $this->titleRec = $titleRec;
        $this->textRec = $textRec;
        $this->dateRec = $dateRec;
        $this->imgRec = $imgRec;
        $this->statRec = $statRec;
        $this->idUser = $idUser;
        $this->archiveRec = $archiveRec;
        $this->archiveBackRec = $archiveBackRec;
    }



    public function getCategorieRec()
    {
        return $this->categorieRec;
    }

    public function getTitleRec()
    {
        return $this->titleRec;
    }
    public function getTextRec()
    {
        return $this->textRec;
    }

    public function getDateRec()
    {
        return $this->dateRec;
    }

    public function getImgRec()
    {
        return $this->imgRec;
    }
    public function getStatRec()
    {
        return $this->statRec;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }
    public function getArchiveRec()
    {
        return $this->archiveRec;
    }
    public function getArchiveBackRec()
    {
        return $this->archiveBackRec;
    }
}




?>