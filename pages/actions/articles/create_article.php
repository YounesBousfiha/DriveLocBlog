<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Model\Article;
use Younes\DriveLoc\Helpers\Helpers;


require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO : This Article Creation method don't handle the Tags
    // TODO : in WriteArticle Page Select the Theme
    // INFO: The Request received with Informations need without image & the tags as a string
    //var_dump($_POST['selectedTags']);
    //var_dump($_FILES);
    $theme_id = 1;
    $userController = new UserController($db);
    $userData = $userController->ValidateUser();
    try {
        $article = new Article($_POST['title'], $_POST['body'], $_FILES['image'], $userData['user_id'] ,$theme_id);
        $userController->createArticle($article);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    //Helpers::redirect($_SERVER['HTTP_REFERER']);
}

