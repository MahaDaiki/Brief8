<?php
require_once("productDAO.php");
require_once("Editconfig.php");
require_once("categoryDAO.php");
$product = new fetchingdata();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Products</title>
</head>
<body>
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


<div class="container">
<form method="post" action="" class="bg-light p-4 rounded formedit my-5">
    <h2 class="mb-4 text-center">Edit Product</h2>

    <?php if ($productDetails) : ?>
         <div class="mb-3">
                <label for="productName" class="form-label">Product Name:</label>
                <input type="text" class="form-control form-control-sm" id="productName" name="productname" value="<?php echo $productDetails->getProductname(); ?>">
            </div>

            <div class="mb-3">
                <label for="barcode" class="form-label">Barcode:</label>
                <input type="text" class="form-control form-control-sm" id="barcode" name="barcode" value="<?php echo $productDetails->getBarcode(); ?>">
            </div>
    <div class="mb-3">
        <label for="purchasePrice" class="form-label">Purchase Price:</label>
        <input type="text" class="form-control form-control-sm" id="purchasePrice" name="purchase_price" value="<?php echo $productDetails->getPurchase_price(); ?>">
    </div>

    <div class="mb-3">
        <label for="finalPrice" class="form-label">Final Price:</label>
        <input type="text" class="form-control form-control-sm" id="finalPrice" name="final_price" value="<?php echo $productDetails->getFinal_price(); ?>">
    </div>

    <div class="mb-3">
        <label for="priceOffer" class="form-label">Price Offer:</label>
        <input type="text" class="form-control form-control-sm" id="priceOffer" name="price_offer" value="<?php echo $productDetails->getPrice_offer(); ?>">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control form-control-sm" id="description" name="descrip"><?php echo $productDetails->getDescrip(); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="minQuantity" class="form-label">Min Quantity:</label>
        <input type="text" class="form-control form-control-sm" id="minQuantity" name="min_quantity" value="<?php echo $productDetails->getMin_quantity(); ?>">
    </div>

    <div class="mb-3">
        <label for="stockQuantity" class="form-label">Stock Quantity:</label>
        <input type="text" class="form-control form-control-sm" id="stockQuantity" name="stock_quantity" value="<?php echo $productDetails->getStock_quantity(); ?>">
    </div>
<?php endif; ?>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary" name="update">Update</button>
        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
    </div>
    
<a href="category.php">View All Items</a>
</form>
</div>


<footer class=" bg-primary text-light text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:ElectroNacer
    </div>

  </footer>

<script src="index.js"></script>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>