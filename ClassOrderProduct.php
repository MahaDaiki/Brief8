<?php
class OrderProduct {
    
    private $order_id;
    private $product_ref;
    private $quantity;
    
    public function __construct($order_id, $product_ref, $quantity){
        $this->order_id = $order_id;
        $this->product_ref = $product_ref;
        $this->quantity = $quantity;
    }

    /**
     * Get the value of order_id
     */ 
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Get the value of product_ref
     */ 
    public function getProductRef()
    {
        return $this->product_ref;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }
}
?>