<?php

namespace Younes\DriveLoc\Model;

class Reservation
{
    public $reservation_date;
    public $reservation_lieux;
    public $fk_user_id;
    public $fk_vehicule_id;

    public function __construct($reservation_date, $reservation_lieux, $fk_user_id, $fk_vehicule_id)
    {
        $this->reservation_date = $reservation_date;
        $this->reservation_lieux = $reservation_lieux;
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