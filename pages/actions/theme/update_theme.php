<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Helpers\Helpers;
use Younes\DriveLoc\Helpers\Validator;

require_once '../../../vendor/autoload.php';

$admin = new AdminController(DBConnection::getConnection()->conn);

