<?php

namespace Younes\DriveLoc\Helpers;

class Helpers
{
    public static function generateToken()
    {
        return bin2hex(random_bytes(32));
    }

    public static function redirect($url)
    {
        return header("Location:" . $url);
    }

    public static function ValidateData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function renderVehicule($vehicule)
    {
        return '
        <div class="bg-white rounded p-4 cursor-pointer hover:-translate-y-1 transition-all relative">
            <div class="mb-4 bg-gray-100 rounded p-2">
                <img src="https://readymadeui.com/images/product9.webp" alt="Product 1" class="aspect-[33/35] w-full object-contain" />
            </div>
            <div data-id="' . $vehicule['vehicule_id'] . '">
                <div class="flex gap-2">
                    <h5 class="text-base font-bold text-gray-800">' . $vehicule['vehicule_marque'] . '</h5>
                    <h6 class="text-base text-gray-800 font-bold ml-auto"> $' . $vehicule['vehicule_prix'] . '</h6>
                </div>
                <p class="text-gray-500 text-[13px] mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="flex items-center gap-2 mt-4">
                          <a href="details.php?id=' . $vehicule['vehicule_id'] . '"title="View Details">
    <div class="bg-blue-100 hover:bg-blue-200 w-12 h-9 flex items-center justify-center rounded cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-blue-600 inline-block" viewBox="0 0 64 64">
            <path d="M32 12C18.4 12 5.9 22 2 32c3.9 10 16.4 20 30 20s26.1-10 30-20c-3.9-10-16.4-20-30-20Zm0 34c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16Zm0-28a12 12 0 1 0 12 12A12 12 0 0 0 32 18Zm0 20a8 8 0 1 1 8-8 8 8 0 0 1-8 8Z"></path>
        </svg>
    </div>
</a>

                    <button type="button" onclick="setModalDataId(this)" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="text-sm px-2 h-9 font-semibold w-full bg-blue-600 hover:bg-blue-700 text-white tracking-wide ml-auto outline-none border-none rounded">Reserver</button>
                </div>
            </div>
        </div>';
    }

    public static function renderReservation($reservation)
    {
        return '
            <tr>
                <td class="w-1/6 text-left py-3 px-4">' . $reservation['vehicule_marque'] . '</td>
                <td class="w-1/6 text-left py-3 px-4">' . $reservation['vehicule_modele'] . '</td>
                <td class="w-1/6 text-left py-3 px-4">' . $reservation['vehicule_annee'] . '</td>
                <td class="w-1/6 text-left py-3 px-4">$' . $reservation['vehicule_prix'] . '</td>
                <td class="w-1/6 text-left py-3 px-4">' . $reservation['reservation_lieux'] . '</td>
                <td class="w-1/6 text-left py-3 px-4">' . $reservation['reservation_date'] . '</td>
                <td class="w-1/6 text-left py-3 px-4">
                    <span class="' . ($reservation['reservation_status'] == 'Pending' ? 'bg-yellow-200 text-yellow-800' : ($reservation['reservation_status'] == 'Approuve' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800')) . ' py-1 px-3 rounded-full text-xs">
                        ' . $reservation['reservation_status'] . '
                    </span>
                </td>
            </tr>';
    }

    public static function renderReservationForAdmin($reservation)
    {
        return '<tr>
                                    <td class="w-1/4 text-left py-3 ">' . $reservation['email'] . '</td>
                                    <td class="w-1/4 text-left py-3 px-4">' . $reservation['vehicule_marque'] . '</td>
                                    <td class="w-1/4 text-left py-3 px-4">$' . $reservation['vehicule_prix'] . '</td>
                                    <td class="text-left py-3 px-4">' . $reservation['categorie_nom'] . '</td>
                                    <td class="w-1/4 text-left py-3 px-4">' . $reservation['reservation_date'] . '</td>
                                    <td class="w-1/4 text-left py-3 px-4">' . $reservation['reservation_lieux'] . '</td>
                                    <td class="w-1/4 text-left py-3 px-4">
                                        <span class="' . ($reservation['reservation_status'] == 'Pending' ? 'bg-yellow-200 text-yellow-800' : ($reservation['reservation_status'] == 'Approuve' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800')) . ' text-white px-2 py-1 rounded-xl">
                        ' . $reservation['reservation_status'] . '</span>
                                    </td>
                                    <td class="text-left py-3 px-4 flex space-x-2">
                                        <button class="bg-green-500 text-white px-2 py-1 rounded flex items-center">
                                            <i class="fas fa-check"></i> <a href="./actions/reservation/approuve_reservation.php?id=' . $reservation['reservation_id'] . '">Approuver</a>
                                        </button>
                                        <button class="bg-red-500 text-white px-2 py-1 rounded flex items-center">
                                            <i class="fas fa-times"></i> <a href="./actions/reservation/reject_reservation.php?id=' . $reservation['reservation_id'] . '">Reject</a>
                                        </button>
                                    </td>
                                </tr>';
    }

    public static function renderVehiculeForAdmin($vehicule)
    {
        return '<tr>
                <td class="w-1/4 text-left py-3 px-4">' . $vehicule['vehicule_marque'] . '</td>
                <td class="w-1/4 text-left py-3 px-4">' . $vehicule['vehicule_modele'] . '</td>
                <td class="w-1/4 text-left py-3 px-4">' . $vehicule['vehicule_prix'] . '</td>
                <td class="w-1/4 text-left py-3 px-4">' . $vehicule['vehicule_disponibilite'] . '</td>
                <td class="text-left py-3 px-4 flex space-x-2">
                    <a class="bg-yellow-500 text-white px-2 py-1 rounded flex items-center" href="./actions/vehicule/update_vehicule.php?id=' . $vehicule['vehicule_id'] . '">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="bg-red-500 text-white px-2 py-1 rounded flex items-center" href="./actions/vehicule/delete_vehicule.php?id=' . $vehicule['vehicule_id'] . '">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>';
    }

    public static function renderCategories($categorie)
    {
        return '<tr>
                                    <td class="w-1/4 text-left py-3 px-4">' . $categorie['categorie_id'] . '</td>
                                    <td class="w-1/4 text-left py-3 px-4">' . $categorie['categorie_nom'] . '</td>
                                    <td class="text-left py-3 px-4 flex space-x-2">
                                        <a class="bg-red-500 text-white px-2 py-1 rounded flex items-center" href="./actions/categorie/delete_categorie.php?id=' . $categorie['categorie_id'] . '"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>';
    }

    public static function renderAvisForAdmin($avis)
    {
        return '                                <tr>
                                    <td class="w-1/8 text-left py-3 px-4">' . $avis['prenom'] . '</td>
                                    <td class="w-1/8 text-left py-3 px-4">' . $avis['nom'] . '</td>
                                    <td class="w-1/8 text-left py-3 px-4">' . $avis['email'] . '</td>
                                    <td class="w-1/8 text-left py-3 px-4">$' . $avis['vehicule_prix'] . '</td>
                                    <td class="w-1/8 text-left py-3 px-4">' . $avis['vehicule_marque'] . '</td>
                                    <td class="w-1/8 text-left py-3 px-4">' . $avis['avis_rating'] . '</td>
                                </tr>';
    }

    public static function renderAvis($avis, $Owner)
    {
        $user_id = $avis['fk_user_id'];
        $isOwner = $Owner['user_id'] == $user_id;
        return '
        <div data-id="'. $avis['avis_id'].'" class="flex flex-col items-center bg-white p-4 rounded-lg shadow-md">
            <p id="user-name" class="text-lg font-medium">User: <span class="font-bold">' . $avis['fullname'] . '</span></p>
            <p id="user-rating" class="text-lg font-medium">Rating: <span class="font-bold">' . $avis['avis_rating'] . '</span> stars</p>
            ' . ($isOwner ? '
            <div class="flex space-x-2 mt-2">
                    <button type="submit" onclick="SetAvisid(this)" data-modal-target="EditAvis" data-modal-toggle="EditAvis" class="bg-yellow-500 text-white px-2 py-1 rounded flex items-center">
                        <i class="fas fa-edit"></i>
                    </button>
                <a class="bg-red-500 text-white px-2 py-1 rounded flex items-center" href="./actions/Avis/delete_avis.php?id=' . $avis['avis_id'] . '">
                    <i class="fas fa-trash"></i>
                </a>
            </div>' : '') . '
        </div>';
    }

    public static function renderTheme($theme) {
        return '
        <tr>
                                    <td class="w-1/4 text-left py-3 px-4">' . $theme['theme_nom'] . '</td>
                                    <td class="w-1/4 text-left py-3 px-4">
                                        <img src="https://placehold.co/600x400@2x.png" alt="theme image" class="w-20 h-20 object-cover rounded-lg">
                                        </td>
                                    <td class="text-left py-3 px-4 flex space-x-2">
                                    
                                        <button class="bg-yellow-500 text-white px-2 py-1 rounded flex items-center">
                                            <a href="./actions/theme/update_theme.php?id=' . $theme['theme_id'] . '"><i class="fas fa-sync-alt"></i></a>
                                        </button>
                                        
                                        <button class="bg-red-500 text-white px-2 py-1 rounded flex items-center">
                                            <a href="./actions/theme/delete_theme.php?id=' . $theme['theme_id'] . '"><i class="fas fa-times"></i> </a>
                                        </button>
                                        
                                    </td>
                                </tr>
                                
        ';
    }

}