<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Model\vehicule;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Helpers\Helpers;

require_once __DIR__ . '/../../../vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = DBConnection::getConnection()->conn;
    $admin = new AdminController($db);

    $cars = $_POST['cars'];

    $user = $admin->validateUser();

    foreach ($cars as $car) {
        $car['fk_user_id'] = $user['user_id'];
        $admin->createVehicule($car);
    }
}