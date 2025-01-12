<?php

namespace Younes\DriveLoc\Controller;

use Younes\DriveLoc\Helpers\Helpers;

use Exception; 
use PDO;

trait AuthController {
    private $db;
    private $tableAuth = 'users';

    public function setDb($db) {
        $this->db = $db;
    }
    public function isExist($email)
    {
        $isFound = false;
        $sql = "SELECT * FROM {$this->tableAuth} WHERE email = :email";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':email', $email);
            if ($stm->execute()) {
                if ($stm->rowCount() > 0) {
                    $isFound = true;
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $isFound;
    }

    public function signup($newuserInstance)
    {
        $isExist = $this->isExist($newuserInstance->__get('email'));
        if(!$isExist) {
            $sql = "INSERT INTO {$this->tableAuth} (nom, prenom, email, password, fk_role_id) VALUES (:nom, :prenom, :email, :password, :fk_role_id)";
            $hashed_password = password_hash($newuserInstance->__get('password'), PASSWORD_DEFAULT);
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(':nom', $newuserInstance->__get('nom'));
                $stm->bindValue(':prenom', $newuserInstance->__get('prenom'));
                $stm->bindValue(':email', $newuserInstance->__get('email'));
                $stm->bindValue(':password', $hashed_password);
                $stm->bindValue(':fk_role_id', $newuserInstance->__get('fk_role_id'));
                if($stm->execute()) {
                    header("Location: http://localhost:63342/DriveLoc/pages/login.html");
                    return true;
                }
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        } else {
            return "Email Already Used, Choose Another Address Email.";
        }
    }

    public function login($email, $password)
    {
        $isExist = $this->isExist($email);
        if ($isExist) {
            $sql = "SELECT * FROM {$this->tableAuth} WHERE email = :email";

            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(':email', $email);
                if ($stm->execute()) {
                    $data = $stm->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($password, $data['password'])) {
                        $token = Helpers::generateToken();
                        setcookie("auth_token", $token, time() + 3600, '/');
                        $sql = "UPDATE {$this->tableAuth} SET token = :token WHERE email = :email";
                        $stm = $this->db->prepare($sql);
                        $stm->bindValue(':token', $token);
                        $stm->bindValue(':email', $email);
                        $stm->execute();
                        if ($data['fk_role_id'] == 1) {
                            header("Location: http://localhost:63342/DriveLocBlog/pages/admin-home.php");
                        } else {
                            header("Location: http://localhost:63342/DriveLocBlog/index.php");
                        }
                    }
                }
            } catch (Exception $e) {
                echo "Error : " . $e->getMessage();
            }
        } else {
            return "Email or Password are incorrect";
        }
    }

    public function validateUser() {
        $token = $_COOKIE['auth_token'];
        if($token) {

            $sql = "SELECT * FROM {$this->tableAuth} WHERE token = :token";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(':token', $token);
                if($stm->execute()) {
                    return $stm->fetch();
                } else {
                    return null;
                }
            } catch (Exception $e)
            {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Your are not Authenticated !";
        }
    }

    public function isLoggedIn() {
        $token = $_COOKIE['auth_token'];
        if($token) {
            return true;
        } else {
            return false;
        }
    }

    public static function logout() {
        setcookie("auth_token", "", time() - 3600, '/');
        Helpers::redirect('http://localhost:63342/DriveLocBlog/index.php');
    }
}

?>