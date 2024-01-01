<?php
require_once("productDAO.php");
require_once("categoryDAO.php");
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
<body  style="background-color: #f0f0f0;">
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
                <a href="confirmation.php" class="btn btn-danger">View Cart</a>
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
    <div class="container mt-5">
        <h2 class="text-center">Shopping Cart</h2>

        <div id="cartItemsContainer" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4"></div>

        <div class="text-center mt-3">
            <div id="totalPrice" class="mb-3 h4"></div>
            
            <button class="btn btn-secondary ml-2" onclick="printReceipt()">Print Receipt</button>
        </div>
    </div>

    <script>
        // Retrieve cart items from local storage
        var cartItemsString = localStorage.getItem('cartItems');
        var cartItems = JSON.parse(cartItemsString) || [];

        // Display cart items
        var cartItemsContainer = document.getElementById('cartItemsContainer');

        if (cartItems.length > 0) {
            var totalPrice = 0;

            cartItems.forEach(function (item) {
                var cartItemDiv = document.createElement('div');
                cartItemDiv.classList.add('col');

                var cardDiv = document.createElement('div');
                cardDiv.classList.add('card', 'mb-3');

                var cardBodyDiv = document.createElement('div');
                cardBodyDiv.classList.add('card-body');

                var cartItemContentDiv = document.createElement('div');
                cartItemContentDiv.classList.add('cart-item', 'd-flex', 'align-items-center');
                cartItemContentDiv.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="img-thumbnail" style="width: 80px; height: 80px;">
                    <div class="ms-3">
                        <p>${item.name}</p>
                        <p>Price: DH${item.price}</p>
                        <p>Quantity: ${item.quantity}</p>
                    </div>
                `;

                cardBodyDiv.appendChild(cartItemContentDiv);
                cardDiv.appendChild(cardBodyDiv);
                cartItemDiv.appendChild(cardDiv);
                cartItemsContainer.appendChild(cartItemDiv);

                totalPrice += item.price * item.quantity;
            });

            // Display total price
            var totalPriceElement = document.getElementById('totalPrice');
            totalPriceElement.innerHTML = `<p>Total Price: DH${totalPrice.toFixed(2)}</p>`;
        } else {
            var emptyCartMessage = document.createElement('p');
            emptyCartMessage.classList.add('text-center', 'mt-3');
            emptyCartMessage.textContent = 'Your cart is empty.';
            cartItemsContainer.appendChild(emptyCartMessage);
        }

        // Function to print the receipt
        function printReceipt() {
            window.print();
        }

        window.addEventListener('beforeunload', function () {
        // Clear the local storage when the user leaves the page
        localStorage.removeItem('cartItems');
    });
    </script>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha384-YVYSSRjFZF8T6T9Jq05t9z2lwPBDy55S+JUGGqqzmh5e6sF3Xn2Itz2l+XzP5i9" crossorigin="anonymous"></script>
    <script src="filter.js"></script> 
<script src="index.js"></script>
<script src="cart.js"></script>
</body>
</html>