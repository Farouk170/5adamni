<?php
    class user{
        private $id;
        private $cin;
        private $nom;
        private $prenom;
        private $date;
        private $email;
        private $image;
        private $role;
        private $tel;
        private $ban;
        private $pwd;

        function __construct($id,$cin,$nom,$prenom,$date,$email,$image,$role,$tel,$pwd){
            $this->id=$id;
            $this->cin=$cin;
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->date=$date;
            $this->email=$email;
            $this->image=$image;
            $this->role=$role;
            $this->pwd=$pwd;
            $this->tel=$tel;
            $this->ban=0;
        }
        public function get_id(){
            return $this->id;
        }
        public function get_cin(){
            return $this->cin;
        }
        public function get_nom(){
            return $this->nom;
        }
        public function get_prenom(){
            return $this->prenom;
        }
        public function get_date(){
            return $this->date;
        }
        public function get_email(){
            return $this->email;
        }
        public function get_image(){
            return $this->image;
        }
        public function get_role(){
            return $this->role;
        }
        public function get_pwd(){
            return $this->pwd;
        }
        public function get_tel(){
            return $this->tel;
        }
        public function get_ban(){
            return $this->ban;
        }
        public function set_ban($duree){
            $this->ban=$duree;
        }
    }
?>