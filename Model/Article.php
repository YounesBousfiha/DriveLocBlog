<?php

namespace Younes\DriveLoc\Model;

use Younes\DriveLoc\Helpers\Validator;
use Exception;
class Article
{
    public $article_title;
    public $article_content;
    public $article_image;

    public $fk_user_id;
    public $fk_theme_id;

    public $tags;

    public function __construct($article_title, $article_content, $article_image, $tags, $fk_user_id, $fk_theme_id)
    {
        try {
            $this->article_title = Validator::ValidateData($article_title);
            $this->article_content = Validator::ValidateData($article_content);
            $this->article_image = Validator::ValidateImage($article_image);
            $this->fk_user_id = Validator::ValidateData($fk_user_id);
            $this->fk_theme_id = Validator::ValidateData($fk_theme_id);
            $this->tags = $tags;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


}