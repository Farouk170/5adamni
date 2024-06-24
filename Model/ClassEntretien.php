<?php
class Entretien {
    private $id;
    private $date_heure;
    private $lien;
    private $offre_id;
    private $id_te;

    function __construct($id, $date_heure, $lien, $offre_id, $id_te) {
        $this->id = $id;
        $this->date_heure = $date_heure;
        $this->lien = $lien;
        $this->offre_id = $offre_id;
        $this->id_te = $id_te;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_date_heure() {
        return $this->date_heure;
    }

    public function get_lien() {
        return $this->lien;
    }

    public function get_offre_id() {
        return $this->offre_id;
    }

    public function get_id_te() {
        return $this->id_te;
    }
}
?>
