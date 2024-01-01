<?php
session_start();

require_once("Connection.php");
require_once("OrderDAO.php");
require_once("OrderProductDAO.php");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit();
}

$clientId = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON data']);
    exit();
}

try {
    // Calculate the total price based on the items in the cart
    $totalPrice = 0;
    $orderProductDAO = new OrderProductDAO();

    foreach ($data as $item) {
        $quantity = $item['quantity'];
        $productRef = $item['reference'];

        $productPrice = $orderProductDAO->getProductPriceByReference($productRef);

        if ($productPrice !== null) {
            $totalPrice += $productPrice * $quantity;
        } else {
            echo json_encode(['success' => false, 'error' => 'Unable to fetch product price']);
            exit();
        }
    }

    // Create Order object
    $order = new Order(0, null, null, null, $totalPrice, 1, $clientId);

    // Insert into the orders table
    $orderDAO = new OrderDAO();
    $orderId = $orderDAO->insertOrder($order);

    if ($orderId !== null) {
        foreach ($data as $item) {
            $productRef = $item['reference'];
            $quantity = $item['quantity'];

            $orderProductDAO->insertOrderProduct($orderId, $productRef, $quantity);
        }

        echo json_encode(['success' => true, 'order_id' => $orderId]);
        // header("Location: confirmation.php?order_id=$orderId");
  
      
    } else {
        echo json_encode(['success' => false, 'error' => 'Unable to insert into orders table']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>