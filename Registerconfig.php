<?php
require_once("ClientDAO.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $fullName = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
 

   
    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    function isValidPhoneNumber($phoneNumber) {
        $pattern = "/^[0-9]{10}$/";
        return preg_match($pattern, $phoneNumber) === 1;
    }

    if ($password !== $confirm_password) {
        $errors['password'] = "Error: Passwords do not match.";
    }
   
    if (!isValidEmail($email)) {
        $errors['email'] = "Error: Invalid email address.";
    }

    if (!isValidPhoneNumber($phoneNumber)) {
        $errors['phonenumber'] = "Error: Invalid phone number.";
    }
     $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
    // Create a new user instance
    try{
    $Client = new Client (0,$fullName, $username,$email, $phoneNumber,$address,$city,$hashedpassword,1 );

    // Create a new instance of UserDAO and add the user to the database
    $ClientDAO = new ClientDAO();
    $ClientDAO->insert_Clients($Client);
    

}
catch (Exception $e){
    echo '<script>';
    echo 'alert("' . addslashes($e->getMessage()) . '");';
    echo '</script>';

}

    
}
?>


   
