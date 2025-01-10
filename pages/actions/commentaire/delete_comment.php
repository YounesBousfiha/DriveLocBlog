<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Helpers\Validator;
use Younes\DriveLoc\Config\DBConnection;

require_once '../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $adminController = new AdminController($db);
    $adminController->deleteCommentaire(Validator::ValidateData($_GET['comment_id']));
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}