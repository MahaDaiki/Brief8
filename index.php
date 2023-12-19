<?php
require_once("productDAO.php");
require_once("categoryDAO.php");
$product = new fetchingdata();
$Products = $product->get_product();

$Category = new CategoryDAO();
$Categories = $Category->get_category();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ELECTRO NACER - HOME</title>
    <link rel="stylesheet" type="text/css" href="assets/css/home.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
    
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark ">
    <div class="container">
        <a href="#" class="navbar-brand">NE</a>
        
        <!-- Add the burger menu button for smaller screens -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="Display.php" class="nav-link">items</a>
                </li>
            </ul>

            <img width="48" src="img/user-286-128.png" alt="profile" class="user-pic">

            <div class="menuwrp" id="subMenu">
                <div class="submenu">
                    <div class="userinfo">
                    <?php
            session_start();
            $displayName = '';
            $isAdmin = false;
           
            if (isset($_SESSION["admin_username"])) {
              $displayName = $_SESSION["admin_username"];
              $isAdmin = true;
            } elseif (isset($_SESSION["username"])) {
              $displayName = $_SESSION["username"];
              $isAdmin = false;
            } if (empty($displayName)) {
                echo '<a href="login.php">Login</a>';
            } else {
                ?>
                <div class="userinfo">
                    <img src="img/user-286-128.png" alt="user">
                    <h2>
                        <?php echo $displayName; ?>
                    </h2>
                    <hr>
                    <?php
                    if ($isAdmin) {
                        echo '<a href="adminpan.php">Admin Panel </a><br>';
                    }
                    echo '<a href="logout.php">Logout</a>'; 
                    ?>
                    <div>
    <?php
}
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="home-welcome-section">

<div class="home-welcome-p-container">
    <p class="home-welcome-p">ELECTRO NACER</p>
</div>


<div class="home-welcome-img-container">
    <img class="home-welcome-img" src="img/background.jpg">
</div>

</section>
<h3 style="color: rgb(0, 137, 236); margin: 50px;">
        CATEGORIES
        <small class="text-muted">Many and many categories and special pieces</small>
    </h3>
  
    <?php
         echo '<div class="card-deck " style="margin: 50px; ">';
         foreach ($Categories as $Category) {
             echo '<div class="card product-card" style="background: linear-gradient(to right, #64B5F6, #2196F3) ">';
             echo '<img class="card-img-top" src="' . $Category->getImgs() . '" alt="Card image cap">';
             echo '<div class="card-body">';
             echo '<h5 class="card-title">' . $Category->getCatname() . '</h5>';
             echo '<p class="card-text">' . $Category->getDescrip() . '</p>';
             echo '</div>';
             echo '</div>';
         }
         echo '</div>';
         ?>
     <script src="index.js"></script>
</body>
</html>