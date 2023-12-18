<?php 
require_once("db_config.php");
class DatabaseConnection {
    private $pdo;
    private static $instance;
    

public function __construct(){ 
    $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
public static function getInstance() {
    if (!self::$instance) {
        self::$instance = new DatabaseConnection();
    }
    return self::$instance;
}
public function getConnection() {
    return $this->pdo;
}
}




?>