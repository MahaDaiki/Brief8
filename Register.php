<?php
require_once("Registerconfig.php");
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="loginstyle.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<body>

<div class="login-box " >
  <h2>Register</h2>
  <form action="Registerconfig.php" method="post" >
    <div class="user-box">
        <ion-icon name="mail-outline"></ion-icon>
      <input type="name" name="fullname" required>
      <label>Full name</label>
    </div> 
    <div class="user-box">
        <ion-icon name="lock-closed-outline"></ion-icon>
          <input type="name" name="username" required="">
          <label>User Name</label>
        </div>
        <div class="user-box">
            <ion-icon name="mail-outline"></ion-icon>
          <input type="email" name="email" required>
          <label>Email</label>
        </div> 
        <div class="user-box">
            <ion-icon name="mail-outline"></ion-icon>
          <input type="tel" name="phonenumber" required>
          <label>Phonenumber</label>
        </div> 
        <div class="user-box">
            <ion-icon name="mail-outline"></ion-icon>
          <input type="address" name="address" required>
          <label>Address</label>
        </div> 
        <div class="user-box">
            <ion-icon name="mail-outline"></ion-icon>
          <input type="name" name="city" required>
          <label>City</label>
        </div> 
    <div class="user-box">
    <ion-icon name="lock-closed-outline"></ion-icon>
      <input type="password" name="password" required>
      <label>Password</label>
    </div>
    <div class="user-box">
        <ion-icon name="lock-closed-outline"></ion-icon>
          <input type="password" name="confirm_password" required>
          <label>Verify Password</label>
        </div>
    <button  type="submit">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Register
</button>
    <div >
      
    </div>
  </form>
</div>
<script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
<script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
  
</body>
</html>