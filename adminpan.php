<?php
require_once("AdminDAO.php");
require_once("ClientDAO.php");
require_once("OrderProductDAO.php");
require_once('OrderDAO.php');
$Admin = new AdminDAO();
$Admins = $Admin->get_Admins();

$Clients = new ClientDAO();
$Client = $Clients->get_Clients();
$order = new OrderDAO();
$orders = $order->getAllOrders();


if (isset($_GET['cancel_order'])) {
    $orderIdToCancel = $_GET['cancel_order'];

    $orderDao = new OrderDAO();
    $orderpDao= new OrderProductDAO();
    $orderDao->deleteOrder($orderIdToCancel);
    // $orderpDao->deleteOrderProduct($orderIdToCancel);
    header("Location: adminpan.php");
    

}
if (isset($_GET['delete_user'])) {
    $userToDelete = $_GET['delete_user'];
    $Clients->delete_Client($userToDelete);
 
    header("Location: adminpan.php"); 

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background: linear-gradient(to bottom, #6ab1e7,#023364)">
<nav class="navbar navbar-expand-sm navbar-dark ">
    <div class="container">
        <a href="#" class="navbar-brand">NE</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="home.php" class="nav-link">Home</a>
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
        <h2 class="mb-4 text-center">Admin Panel</h2>
        <h3 class="mb-4 text-center">Users</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
             foreach ($Client as $Clients){
                    echo "<tr>";
                    echo "<td>".$Clients->getid()."</td>";
                    echo "<td>". $Clients->getFullname() ."</td>";
                    echo "<td>". $Clients->getUsername() ."</td>";
                    echo "<td>". $Clients->getEmail() ."</td>";
                    echo "<td>". $Clients->getPhonenumber() ."</td>";
                    echo "<td>". $Clients->getAddress() ."</td>";
                    echo "<td>". $Clients->getCity() ."</td>";
                    echo "<td>";
                    echo "<a href='adminpan.php?delete_user={$Clients->getid()}' class='btn btn-danger btn-sm mr-2'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-5">
        <h3 class="mt-5 text-center">Admins</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($Admins as $Admin) {
                    echo "<tr>";
                    echo "<td>".$Admin->getId()."</td>";
                    echo "<td>".$Admin->getUsername()."</td>";
                    echo "<td>".$Admin->getEmail()."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
    <div class="container mt-5">
    <h3 class="mt-5 text-center">Orders</h3>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Order ID</th>
                <th>Creation Date</th>
                <th>Shipping Date</th>
                <th>Delivery Date</th>
                <th>Total Price</th>
                <th>BL</th>
                <th>Client ID</th>
                <th>---</th>
            </tr>
        </thead>
        <tbody>
            <?php
          foreach ($orders as $order) {
            echo "<tr>";
            echo "<td>" . $order->getId() . "</td>";
            echo "<td>" . $order->getCreation_date() . "</td>";
            echo "<td>" . $order->getShipping_date() . "</td>";
            echo "<td>" . $order->getDelivery_date() . "</td>";
            echo "<td>" . $order->getTotal_price() . "</td>";
            echo "<td>" . $order->getBl() . "</td>";
            echo "<td>" . $order->getClient_id() . "</td>";
            // echo "<td>" . $order->getUsername() . " </td>";
            echo "<td>";
            echo "<a href='order_details.php?order_id={$order->getId()}' class='btn btn-info btn-sm mr-2'>Detail</a>";
            echo "  <a href='adminpan.php?cancel_order={$order->getId()}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to cancel this order?')\">Cancel</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

    <footer class=" bg-primary text-light text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:ElectroNacer
    </div>

  </footer>

<script src="index.js"></script>
</body>
</html>
