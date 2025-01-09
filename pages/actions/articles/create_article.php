<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Model\Article;
use Younes\DriveLoc\Helpers\Validator;
use Younes\DriveLoc\Helpers\Helpers;


require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO : This Article Creation method don't handle the Tags
    // INFO: The Request received with Informations need without image & the tags as a string
    //var_dump($_POST['selectedTags']);
    //var_dump($_FILES);
    $theme_id = Validator::ValidateData($_POST['theme_id']);
    $userController = new UserController($db);
    $userData = $userController->ValidateUser();
    try {
        $article = new Article($_POST['title'], $_POST['body'], $_FILES['image'], $userData['user_id'] ,$theme_id);
        $userController->createArticle($article);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    header('Location: http://localhost:63342/DriveLocBlog/pages/ArticlePerTheme.php?theme_id='.$theme_id);
}

