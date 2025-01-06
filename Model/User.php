<?php


namespace Younes\DriveLoc\Model;

class User {
    private $nom;
    private $prenom;
    private $email;
    private $password;
    public $fk_role_id = 2;

    public function __construct($nom, $prenom, $email, $password) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
    }

    public function __get($property) {
            return $this->$property;
    }

    public function __set($property, $value) {
            $this->$property = $value;
    }
}