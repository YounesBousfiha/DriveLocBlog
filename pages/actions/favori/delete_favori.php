<?php

use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Helpers\Validator;

require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$userController = new UserController($db);

try {
    $favorisId = Validator::ValidateData($_GET['article_id']);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

if($userController->deleteFromFavoris($favorisId)) {
    header('Location: http://localhost:63342/DriveLocBlog/pages/myFavoris.php');
} else {
    echo 'Error: Could not delete from favoris';
}
