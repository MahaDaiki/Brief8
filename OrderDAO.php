<?php

require_once("Connection.php");
require_once("ClassOrder.php");

class OrderDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::getInstance()->getConnection();
    }

    public function getOrderById($orderId)
    {
        $query = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$orderId]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Order(
                $row['id'],
                $row['creation_date'],
                $row['shipping_date'],
                $row['delivery_date'],
                $row['total_price'],
                $row['bl'],
                $row['client_id']
            );
        } else {
            return null;
        }
    }

    public function insertOrder(Order $order)
    {
        $query = "INSERT INTO orders (total_price, bl, client_id) 
        VALUES (" . $order->getTotal_price() . ", " . $order->getBl() . ", " . $order->getClient_id() . ")";

        $this->pdo->exec($query);

        return $this->pdo->lastInsertId();
    }

    public function deleteOrder($orderId)
    {
        $query = "UPDATE orders SET bl = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$orderId]);
    }
}
?>
