<?php

namespace Younes\DriveLoc\Model;

use Younes\DriveLoc\Helpers\Validator;
use Exception;

class Tags
{
    public $tag_nom;

    public function __construct($tag_nom)
    {
        try {
            $this->tag_nom = Validator::ValidateData($tag_nom);
        } catch(Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}