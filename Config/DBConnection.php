<?php 


namespace Younes\DriveLoc\Config;

use PDO;
use PDOException;

class DBConnection {
    private static $hasInstance = null;
    public $conn;

    private function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=DriveLoc', 'root', 'MyStr0ng!Passw0rd');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed : " . $e->getMessage();
        }
    }

    public static function getConnection() {
        if(self::$hasInstance == null) {
            self::$hasInstance = new DBconnection();
        }
        return self::$hasInstance;
    }

    public function __clone(){}
}

?>