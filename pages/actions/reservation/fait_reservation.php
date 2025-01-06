<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Model\Reservation;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Helpers\Helpers;


require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['reservation_date'];
    $lieux = $_POST['reservation_lieux'];
    $vehicule_id = $_POST['vehicule_id'];

    var_dump($_POST);

    $reservation = new UserController($db);
    $user = $reservation->validateUser();
    $fk_user_id = $user['user_id'];

    $reservationData = new Reservation($date, $lieux, $fk_user_id, $vehicule_id);

    $reservation->setDb($db);
    $status = $reservation->createReservation($reservationData);

    Helpers::redirect('http://localhost:63342/DriveLoc/pages/myReservation.php');

}