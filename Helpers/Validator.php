<?php

namespace Younes\DriveLoc\Helpers;

class Validator
{
    public static function ValidateData($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function ValidateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}