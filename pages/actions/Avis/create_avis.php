<?php

use Younes\DriveLoc\Model\Avis;
use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Config\DBConnection;

require_once __DIR__ . '/../../../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $avis = $_POST['avis'];
    $fk_user_id = $_POST['fk_user_id'];
    $fk_vehicule_id = $_POST['fk_vehicule_id'];

    $avisData = new Avis($avis, $fk_user_id, $fk_vehicule_id);

    $avisController = new UserController($db);
    $avisController->createAvis($avisData);
    header('Location: all_avis.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Avis</title>
</head>
<body>
    <form action="create_avis.php" method="POST">
        <label for="avis">Avis</label>
        <input type="text" name="avis" id="avis">
        <label for="fk_user_id">User ID</label>
        <input type="text" name="fk_user_id" id="fk_user_id">
        <label for="fk_vehicule_id">Vehicule ID</label>
        <input type="text" name="fk_vehicule_id" id="fk_vehicule_id">
        <button type="submit">Create Avis</button>
    </form>
</body>
</html>
