<?php

use Younes\DriveLoc\Helpers\Helpers;
use Younes\DriveLoc\Controller\AdminController;
use Younes\DriveLoc\Config\DBConnection;

require_once __DIR__ . '/../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$admin = new AdminController($db);

$adminData = $admin->validateUser();

if($adminData['fk_role_id'] != 1) {
    http_response_code(403);
    echo "You are not authorized to access this page";
    die();
}

$allthemes = $admin->getAllThemes();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Admin Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex" x-data="{ isModalOpen: false }">

<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="admin-home.php" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="admin-home.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="gestionVoitures.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-car mr-3"></i>
            Gestion des voitures
        </a>
        <a href="gestionReservation.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-table mr-1"></i>
            Gestion des reservation
        </a>
        <a href="gestionAvis.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-comments mr-3"></i>
            Gestion des avis
        </a>
        <a href="gestiondesthemes.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-blog mr-3"></i>
            Gestion des themes
        </a>
        <a href="gestiondesTags.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-tags mr-3"></i>
            Gestion des Tags
        </a>
        <a href="gestiondesComment.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-comment mr-3"></i>
            Gestion des Comment
        </a>
        <a href="gestiondesArticle.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-newspaper mr-3"></i>
            Gestion des Articles
        </a>
        <a href="../index.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
            <i class="fas fa-home mr-3"></i>
            Home
        </a>
        <a href="./actions/auth/logout.php" class="absolute w-full upgrade-btn bottom-0 text-white flex items-center justify-center py-4">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
    </nav>
</aside>

<div class="w-full flex flex-col h-screen overflow-y-hidden">
    <!-- Desktop Header -->
    <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
        <div class="w-1/2"></div>
        <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
            <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
            </button>
            <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
            <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                <a href="#" class="block px-4 py-2 account-link hover:text-white">Account</a>
                <a href="#" class="block px-4 py-2 account-link hover:text-white">Support</a>
                <a href="#" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
            </div>
        </div>
    </header>

    <!-- Mobile Header & Nav -->
    <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
        <div class="flex items-center justify-between">
            <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
            <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                <i x-show="!isOpen" class="fas fa-bars"></i>
                <i x-show="isOpen" class="fas fa-times"></i>
            </button>
        </div>

        <!-- Dropdown Nav -->
        <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
            <a href="admin-home.php" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="gestionVoitures.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-car mr-3"></i>
                Gestion des voitures
            </a>
            <a href="gestionReservation.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Gestion des reservation
            </a>
            <a href="gestiondesthemes.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-blog mr-3"></i>
                Gestion des themes
            </a>
            <a href="gestionAvis.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-comments mr-3"></i>
                Gestion des Avis
            </a>
            <a href="../index.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-home mr-3"></i>
                home
            </a>
            <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-cogs mr-3"></i>
                Support
            </a>
            <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-user mr-3"></i>
                My Account
            </a>
            <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Sign Out
            </a>
        </nav>
        <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> New Report
        </button> -->
    </header>

    <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" @click.away="isModalOpen = false">
        <div class="rounded-lg bg-white p-6">
            <h2 class="mb-4 text-2xl">Add theme</h2>
            <form action="./actions/theme/create_theme.php" method="POST" enctype="multipart/form-data">
                <div id="car-fields">
                    <div class="flex flex-col space-y-4">
                        <input class="rounded border border-gray-300 p-2" type="text" name="theme_nom" placeholder="Theme Nom" required />
                        <input class="rounded border border-gray-300 p-2" type="file" name="theme_image" required />
                    </div>
                </div>
                <div class="mt-3 flex justify-center">
                    <button type="button" class="mr-2 rounded bg-gray-500 px-4 py-2 text-white" @click="isModalOpen = false">Cancel</button>
                    <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white">Add theme</button>
                </div>
            </form>
        </div>
    </div>

    <div id="updateThemeModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="rounded-lg bg-white p-6">
            <h2 class="mb-4 text-2xl">Update Theme</h2>
            <form action="./actions/theme/update_theme.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="update_theme_id" name="theme_id" value="" />
                <div class="flex flex-col space-y-4">
                    <input class="rounded border border-gray-300 p-2" type="text" name="theme_nom" placeholder="Theme Nom" required />
                    <input class="rounded border border-gray-300 p-2" type="file" name="theme_image" required />
                </div>
                <div class="mt-3 flex justify-center">
                    <button type="button" class="mr-2 rounded bg-gray-500 px-4 py-2 text-white" onclick="closeUpdateModal()">Cancel</button>
                    <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white">Update Theme</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Content -->
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">Gestion des Theme</h1>
            <button class="bg-blue-500 text-white px-4 py-2 rounded" @click="isModalOpen = true">Add Theme</button>
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Client List
                </p>
                <div class="bg-white overflow-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-base">Theme Nom</th>
                            <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-base">Theme Image</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-base">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-700">
                        <!-- ...existing rows... -->
                        <?php
                        foreach($allthemes as $theme) {
                            echo Helpers::renderTheme($theme);
                        }
                        ?>
                        <!-- ...existing rows... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    function openUpdateModal() {
        document.getElementById('updateThemeModal').classList.remove('hidden');
    }

    function closeUpdateModal() {
        document.getElementById('updateThemeModal').classList.add('hidden');
    }

    function setModalId(btn) {
        let parent = btn.closest('tr');
        let id = parent.getAttribute('data-id');

        document.getElementById('update_theme_id').value = id;
        openUpdateModal();
    }
</script>


<!-- AlpineJS -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>
