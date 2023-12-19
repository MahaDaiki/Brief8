<?php
require_once("ClientDAO.php");
require_once("AdminDAO.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $clientDAO = new ClientDAO();
    $adminDAO = new AdminDAO();

    if ($clientDAO->login($username, $password)) {
        // Client authentication successful
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } elseif ($adminDAO->login($username, $password)) {
        // Admin authentication successful
        $_SESSION['admin_username'] = $username;
        $_SESSION['is_admin'] = true; // Set the 'is_admin' session variable for admin users
        header('Location: index.php');
        exit();
    } else {
        // Authentication failed for both clients and admins
        echo 'Invalid username or password';
    }
}
?>