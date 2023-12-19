<?php
require_once("Loginconfig.php")
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

<div class="login-box">
  <h2>Login</h2>
  <form action="Loginconfig.php" method="post">
    <div class="user-box">
        <ion-icon name="mail-outline"></ion-icon>
      <input type="text" name="username" required>
      <label>User name</label>
    </div>
    <div class="user-box">
    <ion-icon name="lock-closed-outline"></ion-icon>
      <input type="password" name="password" required>
      <label>Password</label>
    </div>
    <button type="submit" class="btn btn-outline-primary">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Login
</button><button class="btn btn-outline-primary" class="register" onclick="window.location.href='Register.php'" >Register</button>
    <div >
      
    </div>
  </form>
</div>
<script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
<script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
  
</body>
</html>