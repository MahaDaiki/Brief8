<?php
require_once("productDAO.php");
require_once("addconfig.php");
require_once("categoryDAO.php");
$product = new fetchingdata();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add</title>
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
            <span class="navbar-text">
    <a href="#" class="nav-link" data-toggle="modal" data-target="#cartModal">
        <i class="fas fa-shopping-cart"></i> 
    </a>
</span>
            <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cartItems">
            </div>
            <div class="modal-footer">
                <!-- <a href="confirmation.php" class="btn btn-danger">View Cart</a> -->
                <button type="button" class="btn btn-primary" onclick="checkout()">Checkout</button>
                
            </div>
        </div>
    </div>
</div>
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

<div class="container formedit   bg-light col-8 mt-5 rounded py-2">
    <h2 class="text-center mb-4">Add Items</h2>
    <form method="post" action="" enctype="multipart/form-data" class="my-5">
        <div class="items-container">
            <div class="item">
                <div class="form-group">
                    <label for="imgs">Image Upload:</label>
                    <input type="file" class="form-control-file" name="imgs[]">
                </div>
                <div class="form-group">
                    <label for="productname">Product Name:</label>
                    <input type="text" class="form-control" name="productname[]" required>
                </div>
                <div class="form-group">
                    <label for="barcode">Barcode:</label>
                    <input type="number" class="form-control" name="barcode[]" required>
                </div>
                <div class="form-group">
                    <label for="purchase_price">Purchase Price:</label>
                    <input type="number" class="form-control" name="purchase_price[]" required>
                </div>
                <div class="form-group">
                    <label for="final_price">Final Price:</label>
                    <input type="number" class="form-control" name="final_price[]" required>
                </div>
                <div class="form-group">
                    <label for="price_offer">Price Offer:</label>
                    <input type="number" class="form-control" name="price_offer[]">
                </div>
                <div class="form-group">
                    <label for="descrip">Description:</label>
                    <textarea class="form-control" name="descrip[]" required></textarea>
                </div>
                <div class="form-group">
                    <label for="min_quantity">Min Quantity:</label>
                    <input type="number" class="form-control" name="min_quantity[]" required>
                </div>
                <div class="form-group">
                    <label for="stock_quantity">Stock Quantity:</label>
                    <input type="number" class="form-control" name="stock_quantity[]" required>
                </div>
                <div class="form-group">
                    <label for="category_name">Category Name:</label>
                    <select class="form-control" name="category_name[]" required>
        <?php
        $categoryDAO = new CategoryDAO();
        $categories = $categoryDAO->get_category();
        foreach ($categories as $Category) {
            echo '<option value="' . $Category->getCatname() . '">' . $Category->getCatname() . '</option>';
        }
        ?>
    </select>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3 ">
            <button type="button" class="btn btn-primary" id="add-item-btn">Add Another Item</button>
            <button type="submit" class="btn btn-danger mx-5" name="addItem">Add Items</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var addItemButton = document.getElementById("add-item-btn");
        var itemsContainer = document.querySelector(".items-container");

        addItemButton.addEventListener("click", function () {
            var firstItem = itemsContainer.querySelector(".item");
            var newItem = firstItem.cloneNode(true);
            itemsContainer.appendChild(newItem);

            // Clear values in the cloned item
            newItem.querySelectorAll("input, textarea").forEach(function (element) {
                element.value = "";
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="index.js"></script>
</body>
</html>
