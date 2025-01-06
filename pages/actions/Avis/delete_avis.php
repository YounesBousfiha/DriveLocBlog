<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Config\DBConnection;

require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$user = new UserController($db);

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['id'])) {
        $avis_id = $_GET['id'];
        $user->deleteAvis($avis_id);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
