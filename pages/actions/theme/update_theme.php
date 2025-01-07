<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Helpers\Helpers;
use Younes\DriveLoc\Helpers\Validator;


require_once '../../../vendor/autoload.php';

$admin = new AdminController(DBConnection::getConnection()->conn);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $theme_id = Validator::ValidateData($_POST['theme_id']);
        $theme_nom = Validator::ValidateData($_POST['theme_nom']);
        $theme_image = Validator::ValidateImage($_FILES['theme_image']);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    if(move_uploaded_file($_FILES['theme_image']['tmp_name'], 'images/' . $_FILES['theme_image']['name'])) {
        echo 'File Uploaded';
    } else {
        echo 'Error Uploading File';
    }

    $admin->updateTheme($theme_id, $theme_nom, $theme_image);
    Helpers::redirect("http://localhost:63342/DriveLoc/pages/gestionTheme.php");
}

