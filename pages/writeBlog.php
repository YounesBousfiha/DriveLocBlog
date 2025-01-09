<?php

use Younes\DriveLoc\Controller\UserController;
use Younes\DriveLoc\Config\DBConnection;

require_once __DIR__ . '/../vendor/autoload.php';

$db = DBConnection::getConnection()->conn;

$userController = new UserController($db);

$alltags = $userController->getAllTags();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Write Article</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet">
</head>
<body>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Write an Article</h1>
    <form action="./actions/articles/create_article.php" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" required>
        </div>
        <div class="mb-4">
            <label for="body" class="block text-sm font-medium text-gray-700">Article Body</label>
            <textarea id="body" name="body" rows="10" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
        </div>
        <div class="mb-4">
            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
            <div class="mt-1 grid grid-cols-6 gap-4 border border-gray-300 rounded-md shadow-sm p-2">
                <?php foreach ($alltags as $index => $tag): ?>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="tag_<?php echo $tag['tag_id']; ?>" name="tags[]" value="<?php echo $tag['tag_nom']; ?>" class="h-4 w-4 text-indigo-600 border-gray-300 rounded" onclick="updateSelectedTags()">
                        <label for="tag_<?php echo $tag['tag_id']; ?>" class="ml-2 block text-sm text-gray-900"><?php echo $tag['tag_nom']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <input type="hidden" id="selectedTags" name="selectedTags">
        <div class="mb-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
        </div>
    </form>
</div>
<script>
    function updateSelectedTags() {
        const checkboxes = document.querySelectorAll('input[name="tags[]"]:checked');
        const selectedTags = Array.from(checkboxes).map(cb => cb.value);
        document.getElementById('selectedTags').value = selectedTags.join(',');
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>