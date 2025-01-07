<?php

namespace Younes\DriveLoc\Model;

use Younes\DriveLoc\Helpers\Validator;
use Exception;
class Commentaire
{
    public $commentaire;
    public $fk_user_id;
    public $fk_article_id;

    public function __construct($commentaire, $fk_user_id, $fk_article_id)
    {
        try {
            $this->commentaire = Validator::ValidateData($commentaire);
            $this->fk_user_id = Validator::ValidateData($fk_user_id);
            $this->fk_article_id = Validator::ValidateData($fk_article_id);
        } catch(Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}