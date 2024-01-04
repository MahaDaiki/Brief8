<?php
require_once("productDAO.php");
require_once("categoryDAO.php");

$productDAO = new fetchingdata();

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    if (isset($_POST['update'])) {
        $productName = $_POST['productname'];
        $barcode = $_POST['barcode'];
        $purchasePrice = $_POST['purchase_price'];
        $finalPrice = $_POST['final_price'];
        $priceOffer = $_POST['price_offer'];
        $descrip = $_POST['descrip'];
        $minQuantity = $_POST['min_quantity'];
        $stockQuantity = $_POST['stock_quantity'];

        $product = new Product($productId, '', $productName, $barcode, $purchasePrice, $finalPrice, $priceOffer, $descrip, $minQuantity, $stockQuantity, '', 1);

        $productDAO->update_product($product);

        echo '<script>alert("Product updated successfully!");</script>';
    }

    if (isset($_POST['delete'])) {
        $fetchingData = new FetchingData();
        $fetchingData->delete_product($productId);

        echo '<script>alert("Product deleted successfully!");</script>';
        header("Location: Display.php");
    }

    
    $productDetails = $productDAO->displayProductDetails($productId);
   
    if (!$productDetails) {
        header("Location: Edit.php");
        
    }
}
?>
