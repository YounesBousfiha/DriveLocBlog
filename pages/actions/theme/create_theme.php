<?php

use Younes\DriveLoc\Model\Theme;
use Younes\DriveLoc\Helpers\Helpers;
use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;


require_once '../../../vendor/autoload.php';

$admin = new AdminController(DBConnection::getConnection()->conn);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminData = $admin->validateUser();
    if($adminData['role_id'] != 1) {
        http_response_code(403);
    }
    $fk_user_id = $adminData['user_id'];
    $theme = new Theme($_POST['theme_nom'], $_FILES['theme_image'], $fk_user_id);

    if(move_uploaded_file($_FILES['theme_image']['tmp_name'], 'images/' . $_FILES['theme_image']['name'])) {
        echo 'File Uploaded';
    } else {
        echo 'Error Uploading File';
    }

    $admin->createTheme($theme);
    Helpers::redirect("http://localhost:63342/DriveLoc/pages/gestionTheme.php");
}