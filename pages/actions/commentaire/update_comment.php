<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Helpers\Validator;
use Younes\DriveLoc\Config\DBConnection;

require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$userController = new UserController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentID = Validator::ValidateData($_POST['comment_id']);
    $commentContent = Validator::ValidateData($_POST['comment_content']);
    $userController->updateCommentaire($commentID, $commentContent);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}