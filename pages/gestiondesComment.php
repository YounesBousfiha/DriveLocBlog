<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Model\Commentaire;
use Younes\DriveLoc\Config\DBConnection;

$db = DBConnection::getConnection()->conn;

$userController = new UserController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userdata = $userController->validateUser();
    $fk_user_id = $userdata['user_id'];
    $commentaireInstance = new Commentaire($_POST['commentaire'], $fk_user_id, $_POST['fk_article_id']);
    $userController->createComment($commentaireInstance);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>