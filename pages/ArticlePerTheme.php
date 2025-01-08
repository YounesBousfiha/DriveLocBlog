<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Helpers\Validator;
use Younes\DriveLoc\Helpers\Helpers;
use Younes\DriveLoc\Config\DBConnection;

require_once __DIR__ . '/../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$userController = new UserController($db);

if(isset($_GET['theme_id'])) {
    try {
        $articles = $userController->getArticlesPerTheme(Validator::ValidateData($_GET['theme_id']));
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    var_dump($articles);
} else {
    // Helpers::redirect('http://localhost/DriveLoc/pages/Blog.php');
}

