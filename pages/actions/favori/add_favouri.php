<?php


use Younes\DriveLoc\Model\Favoris;
use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Helpers\Validator;
use Younes\DriveLoc\Config\DBConnection;

require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $article_id = $_POST['article_id'];
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    $userController = new UserController($db);
    $userData = $userController->ValidateUser();
    try {
        $favori = new Favoris($userData['user_id'], $article_id);
        $userController->addToFavoris($favori);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    //header('Location: http://localhost:63342/DriveLocBlog/pages/ArticlePerTheme.php?theme_id='.$theme_id);
}


