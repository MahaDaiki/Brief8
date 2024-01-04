<?php
require_once("productDAO.php");
require_once("Classproducts.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productManager = new fetchingdata();

    // Get the count of products submitted
    $loopCount = count($_POST['productname']);

    // Loop through the submitted data
    for ($i = 0; $i < $loopCount; $i++) {
        // Retrieve values from the form
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

        $product = new Product(
            null, 
            $imageFilePath,
            $productname,
            $barcode,
            $purchase_price,
            $final_price,
            $price_offer,
            $descrip,
            $min_quantity,
            $stock_quantity,
            $category_name,
            1
        );

        // Insert the product into the database
        $productManager->insert_Product($product, $imageFilePath);
    }
}
?>
