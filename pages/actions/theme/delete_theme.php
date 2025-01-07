<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Helpers\Helpers;
use Younes\DriveLoc\Config\DBConnection;

require_once '../../../vendor/autoload.php';

$admin = new AdminController(DBConnection::getConnection()->conn);

$admin->deleteTheme($_GET['id']);

Helpers::redirect("http://localhost:63342/DriveLoc/pages/gestionTheme.php");
