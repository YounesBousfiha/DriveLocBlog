<?php

use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;
use Younes\DriveLoc\Helpers\Helpers;

require_once __DIR__ . '/../../../vendor/autoload.php';

$admin = new AdminController(DBConnection::getConnection()->conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicule_id = $_POST['vehicule_id'];
    $data = [
        'vehicule_marque' => $_POST['vehicule_marque'],
        'vehicule_modele' => $_POST['vehicule_modele'],
        'fk_categorie_id' => $_POST['fk_categorie_id'],
        'vehicule_prix' => $_POST['vehicule_prix'],
        'vehicule_annee' => $_POST['vehicule_annee']
    ];

    $admin->updateVehicule($vehicule_id, $data);
    Helpers::redirect('gestionVoitures.php');
}

$vehicule = $admin->getVehicule($_GET['id']);
$categories = $admin->getAllCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-family-karla flex">
<div class="w-full flex flex-col h-screen overflow-y-hidden">
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Edit Vehicle</h1>
        <form action="update_vehicule.php" method="POST">
            <input type="hidden" name="vehicule_id" value="<?php echo $vehicule['vehicule_id']; ?>">
            <div class="flex flex-col space-y-4">
                <input class="border border-gray-300 p-2 rounded" type="text" name="vehicule_marque" value="<?php echo $vehicule['vehicule_marque']; ?>" placeholder="Make" required>
                <input class="border border-gray-300 p-2 rounded" type="text" name="vehicule_modele" value="<?php echo $vehicule['vehicule_modele']; ?>" placeholder="Model" required>
                <select class="border border-gray-300 p-2 rounded" name="fk_categorie_id" required>
                    <?php
                    foreach ($categories as $categorie) {
                        $selected = $categorie['categorie_id'] == $vehicule['fk_categorie_id'] ? 'selected' : '';
                        echo "<option value=\"{$categorie['categorie_id']}\" $selected>{$categorie['categorie_nom']}</option>";
                    }
                    ?>
                </select>
                <input class="border border-gray-300 p-2 rounded" type="number" name="vehicule_prix" value="<?php echo $vehicule['vehicule_prix']; ?>" placeholder="Price" required>
                <input class="border border-gray-300 p-2 rounded" type="number" name="vehicule_annee" value="<?php echo $vehicule['vehicule_annee']; ?>" placeholder="Year" required>
            </div>
            <div class="flex justify-end mt-4">
                <a href="gestionVoitures.php" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Vehicle</button>
            </div>
        </form>
    </main>
</div>
</body>
</html>