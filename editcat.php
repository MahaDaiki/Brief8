<?php
require_once("categoryDAO.php");
require_once("ManageConfig.php");
$categories = new CategoryDAO();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background: linear-gradient(to bottom, #6ab1e7,#023364)">
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

            <div class="menuwrp" id="subMenu"  style="z-index: 99">
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
<?php if ($categoryDetails) : ?>
<div class="container">
    <form method="post" action="" enctype="multipart/form-data" class="bg-light p-4 rounded formedit my-5 justify-content-center text-center">
        <h2 class="mb-4 text-center">Edit Category</h2>

        <div class="mb-3">
            <label for="new_catname" class="form-label">Category Name:</label>
     <h3> <?php echo $category->getCatname(); ?></h3>
        </div>

        <div class="mb-3">
            <label for="new_description" class="form-label">Description:</label>
            <textarea class="form-control form-control-sm p-4 " id="new_description" name="new_description"><?php echo $category->getDescrip(); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="new_image" class="form-label">Image:</label>
            <input type="file" class="form-control-file ml-5" id="new_image" name="new_image">
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <button type="submit" class="btn btn-danger" name="delete">Delete</button><hr>
                </form>
        <a href="ManageCategories.php">Back to Categories -></a>
        </div>
    </form>
</div>
<?php endif; ?>


<footer class=" bg-primary text-light text-center text-lg-start mt-4">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:ElectroNacer
    </div>

  </footer>
<script src="index.js"></script>
</body>
</html>
