<?php
require_once("Connection.php");
require_once("Admin.php");


class AdminDAO {
    private $db;
    public function __construct(){
        $this->db = DatabaseConnection::getInstance()->getConnection(); 
    }

    public function get_Admins(){
        $query = "SELECT * FROM admins";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $AdminData = $stmt->fetchAll();
        $Admin = array();
        foreach ($AdminData as $A) {  
            $Admin[] = new Admin ($A["id"],$A["username"],$A["email"],$A["passw"]);
         
        }
        return $Admin;

    }
    public function insert_Clients($Admin){
        $query= "INSERT INTO admins VALUES ('".$Admin->getId()."','".$Admin->getUsername()."','".$Admin->getEmail()."','".$Admin->getPassw()."',) ";
        $stmt = $this->db->query($query);
        $stmt -> execute();

    }
    public function login($username, $password) {
        session_start();
    
        $query = "SELECT id, username, passw FROM admins WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($admin) {
            if ($password === $admin['passw']) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                return true;
            }
        }
    
        return false;
    }




  


    
}


?>