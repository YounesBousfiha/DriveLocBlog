<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Model\Commentaire;
use Younes\DriveLoc\Config\DBConnection;


require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$userController = new UserController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userdata = $userController->validateUser();
    $fk_user_id = $userdata['user_id'];
    $commentaireInstance = new Commentaire($_POST['commentaire_content'], $fk_user_id, $_POST['article_id']);
    $userController->createCommentaire($commentaireInstance);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}