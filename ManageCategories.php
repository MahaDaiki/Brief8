<?php
require_once("ManageConfig.php");
require_once("categoryDAO.php");
require_once("manageadd.php");
$category = new CategoryDAO();
$Categories = $category->get_category();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manage</title>
    <link rel="stylesheet" type="text/css" href="assets/css/home.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
    
</head>
<body  style="background: linear-gradient(to bottom, #f0f0f0, #6ab1e7)">
<nav class="navbar navbar-expand-sm navbar-dark ">
    <div class="container">
        <a href="#" class="navbar-brand">NE</a>
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
<div class="container mt-5">
    <h2 class="mb-4">Manage Categories</h2>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Category Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($Categories as $category) { ?>
        <tr>
            <td><?php echo $category->getCatname(); ?></td>
            <td><?php echo $category->getDescrip(); ?></td>
            <td><img src="<?php echo $category->getImgs(); ?>" alt="Category Image" style="max-width: 100px;"></td>
            <td>
            |
             <a href="editcat.php?category_name=<?php echo $category->getCatname(); ?>">Edit</a>
                    |
                
            </td>
        </tr>
    <?php } ?>
</tbody>
    </table>

    <div class="container formedit bg-light col-8 mt-5 rounded py-2">
    <h3 class="mt-4 d-flex justify-content-center">Add Categories</h3>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="items-container">
            <div class="item">
                <div class="form-group">
                    <label for="new_category_name">Category Name:</label>
                    <input type="text" class="form-control" name="catname[]" required>
                </div>
                <div class="form-group">
                    <label for="new_description">Description:</label>
                    <textarea class="form-control" name="descrip[]" required></textarea>
                </div>
                <div class="form-group">
                    <label for="new_image">Image:</label>
                    <input type="file" class="form-control-file" name="imgs[]">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button type="button" class="btn btn-primary " id="add-category-btn">Add Another Category</button>
            <button type="submit" class="btn btn-danger mx-5" name="add">Add Categories</button>
        </div>
    </form>
</div>
            </div>

<footer class=" bg-primary text-light text-center text-lg-start mt-4">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:ElectroNacer
    </div>

  </footer>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var addCategoryButton = document.getElementById("add-category-btn");
        var itemsContainer = document.querySelector(".items-container");
        var firstItem = itemsContainer.querySelector(".item");

        addCategoryButton.addEventListener("click", function () {
            var newItem = firstItem.cloneNode(true);
            newItem.querySelectorAll("input, textarea").forEach(function (element) {
                element.value = "";
            });
            itemsContainer.appendChild(newItem);
        });
    });
</script>

<script src="index.js"></script>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>


  
