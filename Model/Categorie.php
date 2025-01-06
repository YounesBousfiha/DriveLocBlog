<?php

namespace Younes\DriveLoc\Model;

class Categorie {
    public $categorie_nom;


    public function __construct($categorie_nom) {
        $this->categorie_nom = $categorie_nom;
    }

    public function __get($property) {
            return $this->$property;
    }
}
