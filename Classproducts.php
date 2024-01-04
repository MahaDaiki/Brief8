<?php
class Product {
    private $reference;
    private $imgs;
    private $productname;
    private $barcode;
    private $purchase_price;	
    private $final_price;	
    private $price_offer;	
    private $descrip;	
    private $min_quantity;	
    private $stock_quantity;	
    private $category_name;	
    private $bl;
    

    public function __construct( $reference , $imgs , $productname, $barcode, $purchase_price, $final_price , $price_offer , $descrip , $min_quantity , $stock_quantity ,$category_name , $bl ){
        $this->reference = $reference;
        $this->imgs = $imgs;
        $this->productname = $productname;
        $this->barcode = $barcode;
        $this->purchase_price = $purchase_price;
        $this->final_price = $final_price;  
        $this->price_offer = $price_offer;
        $this->descrip = $descrip; 
        $this->min_quantity = $min_quantity;
        $this->stock_quantity = $stock_quantity;
        $this->category_name = $category_name;
        $this->bl = $bl;
    }
    



    /**
     * Get the value of reference
     */ 
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Get the value of imgs
     */ 
    public function getImgs()
    {
        return $this->imgs;
    }

    /**
     * Get the value of productname
     */ 
    public function getProductname()
    {
        return $this->productname;
    }

    /**
     * Get the value of barcode
     */ 
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * Get the value of purchase_price
     */ 
    public function getPurchase_price()
    {
        return $this->purchase_price;
    }

    /**
     * Get the value of final_price
     */ 
    public function getFinal_price()
    {
        return $this->final_price;
    }

    /**
     * Get the value of price_offer
     */ 
    public function getPrice_offer()
    {
        return $this->price_offer;
    }

    /**
     * Get the value of descrip
     */ 
    public function getDescrip()
    {
        return $this->descrip;
    }

    /**
     * Get the value of min_quantity
     */ 
    public function getMin_quantity()
    {
        return $this->min_quantity;
    }

    /**
     * Get the value of stock_quantity
     */ 
    public function getStock_quantity()
    {
        return $this->stock_quantity;
    }

    /**
     * Get the value of category_name
     */ 
    public function getCategory_name()
    {
        return $this->category_name;
    }

    /**
     * Get the value of bl
     */ 
    public function getBl()
    {
        return $this->bl;
    }
}
?>