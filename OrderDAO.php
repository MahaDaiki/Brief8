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
    public function getAllOrders()

   { $query = "SELECT * FROM orders WHERE bl = 1 ";
    $stmt = $this->pdo->query($query);

    $ordersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $orders = array();
    foreach ($ordersData as $row) {
        $order = new Order(
            $row['id'],
            $row['creation_date'],
            $row['shipping_date'],
            $row['delivery_date'],
            $row['total_price'],
            $row['bl'],
            $row['client_id']
        );
        $orders[] = $order;
    }

    return $orders;
}


public function getOrderClient($orderId)
{
    $query = "
    SELECT 
        orders.id AS order_id,
        products.productname AS product_name,
        clients.fullname AS client_name,
        orderproduct.quantity,
        (orderproduct.quantity * products.final_price) AS final_price
    FROM orders
    JOIN orderproduct ON orders.id = orderproduct.order_id
    JOIN products ON orderproduct.product_ref = products.reference
    JOIN clients ON orders.client_id = clients.id
    WHERE orders.id = ?
";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute([$orderId]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
?>
