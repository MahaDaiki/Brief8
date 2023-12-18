<?php
require_once("Connection.php");
require_once("products.php");


class fetchingdata {
    private $db;
    public function __construct(){
        $this->db = DatabaseConnection::getInstance()->getConnection(); 
    }

    public function get_product(){
        $query = "SELECT * FROM products WHERE bl = 1";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $productData = $stmt->fetchAll();
        $Products = array();
        foreach ($productData as $P) {
            $Products[] = new Product ($P["reference"],$P["imgs"],$P["productname"],$P["barcode"],$P[ "purchase_price"], $P["final_price"] , $P["price_offer"] , $P["descrip"] , $P["min_quantity"] , $P["stock_quantity"] , $P["category_name"] , $P["bl"]);
         
        }
        return $Products;

    }
    public function insert_product($Products){
        $query= "INSERT INTO products VALUES (0,'".$Products->getImgs()."','".$Products->getProductname()."',".$Products->getBarcode().",".$Products->getPurchase_price().",".$Products->getFinal_price().",".$Products->getPrice_offer().",'".$Products->getDescrip()."',".$Products->getMin_quantity().",".$Products->getStock_quantity().",'".$Products->getCategory_name()."',".$Products->getBl().") ";
       echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();

    }

    public function update_product($Product){
        $query = "UPDATE `products` SET `imgs`='".$Product->getImgs()."',`productname`='".$Product->getProductname()."',`barcode`=".$Product->getBarcode().",`purchase_price`=".$Product->getPurchase_price().",`final_price`=".$Product->getFinal_price().",`price_offer`=".$Product->getPrice_offer().",`descrip`='".$Product->getDescrip()."',`min_quantity`=".$Product->getMin_quantity().",`stock_quantity`=".$Product->getStock_quantity().",`category_name`='".$Product->getCategory_name()."',`bl`=".$Product->getBl()." WHERE `reference`= ".$Product->getReference();
        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

    public function delete_product($id){
        $query = "UPDATE `products` SET `bl`= 0 WHERE `reference`=" . $id ;

        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }
    public function filter_product(){
        if (isset($_POST["category"]) && !empty($_POST["category"])) {
            $category_array = json_decode($_POST["category"], true);
            if (is_array($category_array)) {
                $category_filter = implode("','", $category_array);
                $query .= " AND category_name IN ('" . $category_filter . "')";
            }
        }
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $productData = $stmt->fetchAll();
        $Products = array();
        foreach ($productData as $P) {
            $Products[] = new Product ($P["reference"],$P["imgs"],$P["productname"],$P["barcode"],$P[ "purchase_price"], $P["final_price"] , $P["price_offer"] , $P["descrip"] , $P["min_quantity"] , $P["stock_quantity"] , $P["category_name"] , $P["bl"]);
         
        }
        return $Products;


    }

}


?>