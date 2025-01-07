<?php

namespace Younes\DriveLoc\Helpers;

use Exception;

class Validator
{
    public static function ValidateData($data) {

        if(empty($data)) {
            throw new Exception("Variable is Empty");
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function ValidateImage($file) {
        $allowedEXT = ['png', 'jpg', 'webp'];
        $allowedSize = 2 * 1024 * 1024;

        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if(!in_array($fileType, $allowedEXT)) {
            throw new Exception("File type invalid");
        }

        if($fileSize > $allowedSize) {
            throw new Exception("File size exceed the limit");
        }
        $uploadDir = '/images/';

        if(!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777,true);
        }


        return $uploadDir . basename($fileName);
    }

    public static function ValidateEmail($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email Format");
        }
        return $email;
    }
}