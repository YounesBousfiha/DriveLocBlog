<?php

namespace Younes\DriveLoc\Model;

use Younes\DriveLoc\Helpers\Validator;

class Favoris
{
    public $fk_user_id;
    public $fk_article_id;

    public function __construct($fk_user_id, $fk_article_id)
    {
        $this->fk_user_id = Validator::ValidateData($fk_user_id);
        $this->fk_article_id = Validator::ValidateData($fk_article_id);
    }

}