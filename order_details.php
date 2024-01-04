<?php
require_once("OrderDAO.php");
require_once("OrderProductDAO.php");

$orderDao = new OrderDAO();
$orderProductDao = new OrderProductDAO();

if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    // Get order details
    $order = $orderDao->getOrderById($orderId);

    if ($order) {
        // Get order products
        $orderProducts = $orderProductDao->getOrderProducts($orderId);
        $orderClientDetails = $orderDao->getOrderClient($orderId);
    } else {
        echo "Order not found.";
        exit;
    }
}
// } else {
//     echo "Invalid order ID.";
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
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
                        <a href="Display.php" class="nav-link">Items</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#cartModal">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </span>
                <!-- ... Your user information ... -->
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center">Order Details</h1>

        <!-- Order Information table -->
        <h2>Order Information</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Creation Date</th>
                    <th>Shipping Date</th>
                    <th>Delivery Date</th>
                    <th>Total Price</th>
                    <th>BL</th>
                    <th>Client ID</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($order): ?>
        <tr>
            <td><?php echo $order->getId(); ?></td>
            <td><?php echo $order->getCreation_date(); ?></td>
            <td><?php echo $order->getShipping_date(); ?></td>
            <td><?php echo $order->getDelivery_date(); ?></td>
            <td><?php echo $order->getTotal_price(); ?></td>
            <td><?php echo $order->getBl(); ?></td>
            <td><?php echo $order->getClient_id(); ?></td>
        </tr>
    <?php endif; ?>
            </tbody>
        </table>
        <table class="table container">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Final Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $orderClientDetails['client_name']; ?></td>
                    <td><?php echo $orderClientDetails['product_name']; ?></td>
                    <td><?php echo $orderClientDetails['quantity']; ?></td>
                    <td><?php echo $orderClientDetails['final_price']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
        <!-- Order Products table -->
        <h2 class="text-center ">Order Products</h2>
        <table class="table container">
            <thead>
                <tr>
                    <th>Product Reference</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($orderProducts): ?>
                    <?php foreach ($orderProducts as $product): ?>
                        <tr>
                            <td><?php echo $product->getProductRef(); ?></td>
                            <td><?php echo $product->getQuantity(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
   
    <footer class=" bg-primary text-light text-center text-lg-start mt-4">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:ElectroNacer
    </div>

  </footer>
</body>
</html>
