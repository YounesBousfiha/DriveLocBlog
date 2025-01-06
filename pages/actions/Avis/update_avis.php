<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Config\DBConnection;

require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$user = new UserController($db);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['avis_id']) && isset($_POST['avis_rating'])) {
        $avis_id = $_POST['avis_id'];
        $avis_rating = $_POST['avis_rating'];
        $user->updateAvis($avis_id, $avis_rating);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}





