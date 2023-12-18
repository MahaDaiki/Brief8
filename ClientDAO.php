<?php
require_once("Connection.php");
require_once("Client.php");




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
            $Client[] = new Client ($c["id"],$c["fullname"],$c["username"],$c["email"],$c["phonenumber"],$c["adresse"],$c["city"],$c["passw"],$c["valide"]);
         
        }
        return $Client;

    }
    public function insert_Clients($Client){
        $query= "INSERT INTO categories VALUES ('".$Client->getId()."','".$Client->getFullname()."','".$Client->getUsername()."','".$Client->getEmail()."',".$Client->getPhonenumber().",'".$Client->getAdresse()."','".$Client->getCity()."','".$Client->getPassw()."',".$Client->getValide().") ";
        $stmt = $this->db->query($query);
        $stmt -> execute();

    }
    public function login(){
        session_start(); 
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username = mysqli_real_escape_string($conn, $username);


    $adminResult = $conn->query("SELECT * FROM admins WHERE username = '$username'");

    if ($adminResult->num_rows > 0) {
        $adminRow = $adminResult->fetch_assoc();
        $adminStoredPassword = $adminRow["passw"];
    
        
        if ($password === $adminStoredPassword) {
            $_SESSION["admin_username"] = $username;
            $_SESSION["is_admin"] = true;

            header("Location: index.php");
            exit();
        } else {
            echo "Error: Incorrect admin password.";
        }
    } else {
        // Check if it's a regular user
        $userResult = $conn->query("SELECT * FROM clients WHERE username = '$username'");

        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $hashedPassword = $userRow["passw"];
            if (password_verify($password, $hashedPassword)) {
                $_SESSION["username"] = $username;
                header("Location: index.php");
                exit();
            } else {
                echo "Error: Incorrect password.";
            }
        } else {
            echo "Error: User not found.";
        }
    }




   
}
}
    public function delete_Client($id){
        $query = "UPDATE `clients` SET `valide`= 0 WHERE `id`=" . $id ;

        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

  


    
}


?>