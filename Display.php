<?php
require_once("productDAO.php");
require_once("categoryDAO.php");
$product = new fetchingdata();
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$limit = 8;
$sortAlphabetically = isset($_POST['sort_alphabetically']) ? (bool)$_POST['sort_alphabetically'] : false;
$searchQuery = isset($_POST['search_query']) ? $_POST['search_query'] : '';
$stockFilter = isset($_POST['stock_filter']) ? $_POST['stock_filter'] : false;
$category = isset($_POST["category"]) ? $_POST["category"] : null;
$Products = $product->get_Product($page, $limit, $sortAlphabetically, $searchQuery, $stockFilter, $category);
$Category = new CategoryDAO();
$Categories = $Category->get_category();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" />
    
    <link rel="stylesheet" href="style.css">
    <title>Products</title>
</head>
<body  style="background: linear-gradient(to bottom, #f0f0f0, #6ab1e7)">
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

<div class="container">
        <div class="row">
            <!-- Category Filter Section -->
            <div class="col-md-3">
                <div class="list-group mt-4">
                    <h3>Category</h3>
                    <?php
                    if ($isAdmin) {
                        echo '<div class="my-2">
                        <a class="btn btn-outline-primary" href=add.php>ADD</a>
                        <a class="btn btn-outline-danger mx-3" href=ManageCategories.php>Manage</a>
                        </div>';
    }
    ?>
                    <label>
                        <input type="checkbox" class="common_selector" id="sort_alphabetically"> Sort Alphabetically
                    </label>
                    <label>
                        <input type="checkbox" class="common_selector" id="stock_filter"> Stock Filter
                    </label>
                    <?php
                    foreach ($Categories as $Category) {
                        echo '<div class="list-group-item checkbox">
                                <label>
                                    <input type="checkbox" class="common_selector category" value="' . $Category->getCatname() . '">
                                    <img src="' . $Category->getImgs() . '" alt="Category Image" style="width: 50px; height: 50px;">
                                    ' . $Category->getCatname() . '
                                </label>
                            </div>';
                    }
                    ?>
                </div>
            </div>
            <!-- Product Display Section -->

            <div class="col-md-9 mt-3">
                <div class="input-group round-5 mt-2">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            <div>
                <div class="container row mt-4">
                    <?php
                    foreach ($Products as $Product) {
                        echo '
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card h-100 border-0 shadow product-card p-3">
                                <a href="product_details.php?reference=' . $Product->getReference() . '" class="text-decoration-none text-dark">
                                    <img src="' . $Product->getImgs() . '" alt="' . $Product->getProductname() . '" class="card-img-top">
                                    <h5 class="card-title text-decoration-none text-dark">' . $Product->getProductname() . '</h5>
                                    <h6 class="card-subtitle mb-2 text-danger">Price: ' . $Product->getFinal_price() . 'DH</h6>
                                    <h6 class="card-subtitle mb-2 text-danger">DISCOUNT: ' . $Product->getPrice_offer() . ' DH</h6>
                                    <p class="card-text">
                                        <strong>Description:</strong> ' . $Product->getDescrip() . '<br>
                                        <strong>Category:</strong> ' . $Product->getCategory_name() . '<br>
                                    </p>
                                </a>
                                
                                <div class="d-flex mt-3 justify-content-center gap-2">
                                <button class="btn btn-primary btn-sm add-to-cart"
                                data-product-reference="' . $Product->getReference() . '"
                                data-product-image="'. $Product->getImgs() .'"
                                data-product-name="' . $Product->getProductname() . '"
                                data-product-price="' . $Product->getFinal_price() . '"
                                onclick="addToCart(this)">
                          Order
                        </button>';
                            
                               if ($isAdmin) {
                           echo '<br><a href="Edit.php?product_id=' . $Product->getReference() . '" class="btn btn-danger">Edit</a>';   
                        
                    }
                    echo    '</div> </div>
                     </div>';
                     
                }
                    ?>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php

echo '<div class="pagination">';
$totalPages = ceil(count($Products) / $limit);
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<a href="#" onclick="filter_data(' . $i . ')">' . $i . '</a>';
}
echo '</div>'; ?>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="filter.js"></script> 
<script src="index.js"></script>
<script src="cart.js"></script>
</body>
</html>