<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Model\Tags;
use Younes\DriveLoc\Config\DBConnection;


require_once '../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$adminController = new AdminController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tags_nom = $_POST['tags'];
    foreach ($tags_nom as $tag_nom) {
        $tagInstance = new Tags($tag_nom['tag_nom']);
        $adminController->createTag($tagInstance);
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
