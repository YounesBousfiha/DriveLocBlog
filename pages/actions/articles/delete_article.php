<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Helpers\Validator;
use Younes\DriveLoc\Config\DBConnection;

require_once '../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

// TODO: write a Condition to check the user role before processing the deletion

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $adminController = new AdminController($db);

    try {
        $adminController->deleteArticle(Validator::ValidateData($_GET['id']));
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

