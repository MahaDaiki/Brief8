<?php
require_once("productDAO.php");
if (isset($_SESSION["admin_username"])) {
    $displayName = $_SESSION["admin_username"];
    $isAdmin = true;
} elseif (isset($_SESSION["username"])) {
    $displayName = $_SESSION["username"];
    $isAdmin = false;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loopCount = count($_POST['productname']); 

    for ($i = 0; $i < $loopCount; $i++) {
        $productname = $_POST['productname'][$i];
        $barcode = $_POST['barcode'][$i];
        $purchase_price = $_POST['purchase_price'][$i];
        $final_price = $_POST['final_price'][$i];
        $price_offer = $_POST['price_offer'][$i];
        $descrip = $_POST['descrip'][$i];
        $min_quantity = $_POST['min_quantity'][$i];
        $stock_quantity = $_POST['stock_quantity'][$i];
        $category_name = $_POST['category_name'][$i];

        // Handle image upload
        $imagePath = "img/";
        $imageFileName = $_FILES['imgs']['name'][$i];
        $imageFilePath = $imagePath . $imageFileName;

        move_uploaded_file($_FILES['imgs']['tmp_name'][$i], $imageFilePath);

        // Create an instance of your product class
        $Products = new fetchingdata(); 

        // Assign values directly to class properties
        $Products->productname = $productname;
        $Products->barcode = $barcode;
        $Products->purchase_price = $purchase_price;
        $Products->final_price = $final_price;
        $Products->price_offer = $price_offer;
        $Products->descrip = $descrip;
        $Products->min_quantity = $min_quantity;
        $Products->stock_quantity = $stock_quantity;
        $Products->category_name = $category_name;

        // You can now use $Products as needed, for example:
        $productManager = new fetchingdata(); 
        $productManager->insert_product($Products, $imageFilePath);
    }
}
?>