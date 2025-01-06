<?php

namespace Younes\DriveLoc\Model;

class Avis
{
    public $avis_rating;
    public $fk_user_id;
    public $fk_vehicule_id;

    public function __construct($avis_rating, $fk_user_id, $fk_vehicule_id)
    {
        $this->avis_rating = $avis_rating;
        $this->fk_user_id = $fk_user_id;
        $this->fk_vehicule_id = $fk_vehicule_id;
    }

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}