<?php

use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Controller\UserController;

require_once __DIR__ . '/../../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db = DBConnection::getConnection()->conn;

    $user = new UserController($db);
    $user->setDb($db);
    $status = $user->login($_POST['email'], $_POST['password']);

    echo $status;
}