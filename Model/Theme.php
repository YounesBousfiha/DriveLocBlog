<?php

namespace Younes\DriveLoc\Model;

use Younes\DriveLoc\Helpers\Validator;
use Exception;
class Theme
{
    public $theme_nom;
    public $theme_image;

    public $fk_user_id;

    public function __construct($theme_nom, $theme_image, $fk_user_id)
    {
        try {
            $this->theme_nom = Validator::ValidateData($theme_nom);
            $this->theme_image = Validator::ValidateImage($theme_image);
            $this->fk_user_id = Validator::ValidateData($fk_user_id);
        } catch(Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


}