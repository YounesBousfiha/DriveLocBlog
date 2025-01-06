<?php


namespace Younes\DriveLoc\Model;


use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Helpers\Helpers;

class Vehicule {
    
    private $vehicule_id;
    private $vehicule_marque;
    private $vehicule_modele;
    private $vehicule_disponibilite;
    private $vehicule_prix;
    private $fk_categorie_id;
    private $fk_user_id = 1;



    public function __construct()
    {
        
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}
?>