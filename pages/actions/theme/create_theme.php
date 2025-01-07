<?php

use Younes\DriveLoc\Model\Theme;
use Younes\DriveLoc\Helpers\Helpers;
use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;


require_once '../../../vendor/autoload.php';

$admin = new AdminController(DBConnection::getConnection());

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $theme = new Theme($_POST['theme_nom'], $_POST['theme_image'], $_POST['fk_user_id']);
    $admin->createTheme($theme);
    Helpers::redirect("http://localhost:63342/DriveLoc/pages/gestionTheme.php");
}