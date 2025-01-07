<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Helpers\Validator;

require_once '../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$adminController = new AdminController($db);

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $tag_id = Validator::ValidateData($_GET['id']);
    $adminController->deleteTag($tag_id);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}