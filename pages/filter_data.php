<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Helpers\Helpers;

require_once __DIR__ . '/../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;
$user = new UserController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categorie_id'])) {
    $categorie_id = $_POST['categorie_id'];
    if ($categorie_id === '' || $categorie_id == '0') {
        $allvehicules = $user->getAllVehicules();
    } else {
        $allvehicules = $user->vehiculesPerCategory($categorie_id);
    }
    foreach ($allvehicules as $vehicule) {
        echo Helpers::renderVehicule($vehicule);
    }
    exit;
}
?>