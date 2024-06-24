<?php
class TypeEntretien {
    private $id_te;
    private $type_entretien;
    private $description;

    function __construct($id_te, $type_entretien, $description) {
        $this->id_te = $id_te;
        $this->type_entretien = $type_entretien;
        $this->description = $description;
    }

    public function get_id_te() {
        return $this->id_te;
    }

    public function get_type_entretien() {
        return $this->type_entretien;
    }

    public function get_description() {
        return $this->description;
    }
}
?>
