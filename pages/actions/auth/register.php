<?php


use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Model\User;

require_once __DIR__ . '/../../../vendor/autoload.php';


$db = DBConnection::getConnection()->conn;

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = new UserController($db);
    $userData = new User($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']);
    $user->setDb($db);
    $status = $user->signup($userData);

    echo $status;
}
?>