<?php

use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Controller\UserController;

require_once __DIR__ . '/../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$userController = new UserController($db);

$userData = $userController->ValidateUser();

$favoris = $userController->getFavoris($userData['user_id']);

var_dump($favoris);

?>

