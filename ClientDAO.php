<?php
require_once("Connection.php");
require_once("ClassClient.php");




class ClientDAO {
    private $db;
    public function __construct(){
        $this->db = DatabaseConnection::getInstance()->getConnection(); 
    }

    public function get_Clients(){
        $query = "SELECT * FROM clients";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $clientData = $stmt->fetchAll();
        $Client = array();
        foreach ($clientData as $c) { 
            $Client[] = new Client ($c["id"],$c["fullname"],$c["username"],$c["email"],$c["phonenumber"],$c["address"],$c["city"],$c["passw"],$c["valide"]);
         
        }
        return $Client;

    }
    public function insert_Clients($Client){
        $query= "INSERT INTO clients VALUES ('".$Client->getId()."','".$Client->getFullname()."','".$Client->getUsername()."','".$Client->getEmail()."',".$Client->getPhonenumber().",'".$Client->getAddress()."','".$Client->getCity()."','".$Client->getPassw()."',".$Client->getValide().") ";
        $stmt = $this->db->prepare($query);
        $stmt -> execute();

    }
    
    public function  login($username, $password) {

        session_start();
        $query = "SELECT id, username, passw FROM clients WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            // User found, verify hashed password
            if (password_verify($password, $user['passw'])) {
                // Authentication successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            }
        }
        return false;
    
    }



    public function delete_Client($id){
        $query = "UPDATE `clients` SET `valide`= 0 WHERE `id`=" . $id ;

        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

  


    
}


?>