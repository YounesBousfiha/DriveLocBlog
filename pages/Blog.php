<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Config\DBConnection;

require_once '../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$userController = new UserController($db);

$allblogs = $userController->getAllArticles();