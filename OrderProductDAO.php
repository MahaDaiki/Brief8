<?php

require_once("Connection.php");
require_once("ClassOrderProduct.php");

class OrderProductDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = DatabaseConnection::getInstance()->getConnection();
    }

    public function getAllOrderProducts() {
        $query = "SELECT * FROM orderproduct";
        $result = $this->pdo->query($query);

        $orderpsData = $result->fetchAll(PDO::FETCH_ASSOC);
        $orderps = [];

        foreach ($orderpsData as $row) {
            $orderps[] = new OrderProduct(
                $row['order_id'],
                $row['product_ref'],
                $row['quantity']
            );
        }

        return $orderps;
    }

    public function insertOrderProduct($orderId, $productRef, $quantity) {
        $query = "INSERT INTO orderproduct (order_id, product_ref, quantity) 
                  VALUES (" . $orderId . ", " . $productRef . ", " . $quantity . ")";
                  

        $this->pdo->exec($query);

        return $this->pdo->lastInsertId();
    }

    public function deleteOrderProduct($order_id) {
        $query = "DELETE FROM orderproduct WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$order_id]);
    }

    public function getProductPriceByReference($productRef) {
        $query = "SELECT final_price FROM products WHERE reference = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$productRef]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['final_price'];
        } else {
            return null;
        }
    }
    public function getOrderProducts($orderId)
{
    $query = "SELECT * FROM orderproduct WHERE order_id = ?";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute([$orderId]);

    $orderProductsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $orderProducts = [];

    foreach ($orderProductsData as $row) {
        $orderProducts[] = new OrderProduct(
            $row['order_id'],
            $row['product_ref'],
            $row['quantity']
        );
    }

    return $orderProducts;
}
}
?>
