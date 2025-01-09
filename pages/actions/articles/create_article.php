<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Model\Article;
use Younes\DriveLoc\Helpers\Validator;
use Younes\DriveLoc\Helpers\Helpers;


require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tags = json_decode($_POST['selectedTags']);

    try {
        $theme_id = Validator::ValidateData($_POST['theme_id']);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    $userController = new UserController($db);
    $userData = $userController->ValidateUser();
    try {
        $article = new Article($_POST['title'], $_POST['body'], $_FILES['image'], $tags, $userData['user_id'] ,$theme_id);
        $userController->createArticle($article);
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }

    //header('Location: http://localhost:63342/DriveLocBlog/pages/ArticlePerTheme.php?theme_id='.$theme_id);
}

