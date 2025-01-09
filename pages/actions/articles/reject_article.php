<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;

require_once __DIR__. '/../../../vendor/autoload.php';
// TODO: Verification s'il admin

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = DBConnection::getConnection()->conn;
    $adminController = new AdminController($db);
    $adminController->rejectArticle($_GET['id']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}