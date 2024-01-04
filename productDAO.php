<?php
require_once("Connection.php");
include("Classproducts.php");


class fetchingdata {
    private $db;
    public function __construct(){
        $this->db = DatabaseConnection::getInstance()->getConnection(); 
    }

    public function product(){
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

public function filter( $categoryFilter , $sortAlphabetically , $stockFilter , $searchQuery )
{
    $sql = 'SELECT * FROM products WHERE bl = 1';

    // Check if a category filter is provided
    if (!empty($categoryFilter)) {
        $sql .= " AND category_name = :categoryFilter";
    }

    // Apply sorting
    if ($sortAlphabetically) {
        $sql .= " ORDER BY productname ASC";
    }

    // Apply stock filter
    if ($stockFilter) {
        $sql .= " AND stock_quantity > 0"; // Adjust the condition as needed
    }

    // Apply search filter
    if (!empty($searchQuery)) {
        $sql .= " AND (productname LIKE :searchQuery OR descrip LIKE :searchQuery)";
    }

    $stmt = $this->db->prepare($sql);

    // Bind parameters
    if (!empty($categoryFilter)) {
        $stmt->bindParam(':categoryFilter', $categoryFilter, PDO::PARAM_STR);
    }

    if (!empty($searchQuery)) {
        $searchQuery = '%' . $searchQuery . '%';
        $stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_STR);
    }

    $stmt->execute();

    // Fetch results as associative array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $productObjects = [];
    foreach ($results as $result) {
        $productObjects[] = new Product(
            $result['reference'],
            $result['imgs'],
            $result['productname'],
            $result['barcode'],
            $result['purchase_price'],
            $result['final_price'],
            $result['price_offer'],
            $result['descrip'],
            $result['min_quantity'],
            $result['stock_quantity'],
            $result['category_name'],
            $result['bl'],
        );
    }

    return $productObjects;
}


public function get_Product($offset, $productsPerPage, $categoryFilter = '')
{
    $sql = 'SELECT * FROM products WHERE bl = 1';

    // Check if a category filter is provided
    if (!empty($categoryFilter)) {
        $sql .= " AND category_name = '$categoryFilter'";
    }

    $sql .= " LIMIT $offset, $productsPerPage";

    $stmt = $this->db->prepare($sql);
    $stmt->execute();

    // Fetch results as associative array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $productObjects = [];
    foreach ($results as $result) {
        $productObjects[] = new Product(
            $result['reference'],
            $result['imgs'],
            $result['productname'],
            $result['barcode'],
            $result['purchase_price'],
            $result['final_price'],
            $result['price_offer'],
            $result['descrip'],
            $result['min_quantity'],
            $result['stock_quantity'],
            $result['category_name'],
            $result['bl'],
        );
    }

    return $productObjects;
}

// public function get_Product($page, $limit, $sortAlphabetically, $searchQuery, $stockFilter, $category) {
//     $offset = ($page - 1) * $limit;
//     $searchFilter = '%' . htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8') . '%';

//     $query = "SELECT * FROM products WHERE bl = 1";

//     // Apply filters
//     if ($category !== null && !empty($category)) {
//         $categoryArray = json_decode($category, true);
//         if (is_array($categoryArray)) {
//             $categoryFilter = implode("','", $categoryArray);
//             $query .= " AND category_name IN ('$categoryFilter')";
//         }
//     }

//     if ($searchFilter != '') {
//         $query .= " AND (productname LIKE '$searchFilter' OR descrip LIKE '$searchFilter')";
//     }

//     if ($stockFilter) {
//         $query .= " AND stock_quantity < min_quantity";
//     }

//     // Apply sorting
//     if ($sortAlphabetically) {
//         $query .= " ORDER BY productname ASC";
//     }

//     // Pagination
//     $query .= " LIMIT $offset, $limit";

//     $productData = $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);

//     $products = array();
//     foreach ($productData as $data) {
//         $products[] = new Product(
//             $data["reference"],
//             $data["imgs"],
//             $data["productname"],
//             $data["barcode"],
//             $data["purchase_price"],
//             $data["final_price"],
//             $data["price_offer"],
//             $data["descrip"],
//             $data["min_quantity"],
//             $data["stock_quantity"],
//             $data["category_name"],
//             $data["bl"]
//         );
//     }

//     return $products;
// }



public function insert_product($Product, $imageFile) {
    $imagePath = "img/";
    $imageFileName = basename($imageFile);
    $imageFilePath = $imagePath . $imageFileName;

    move_uploaded_file($imageFile, $imageFilePath);

    $query = "INSERT INTO products 
              VALUES (0, '$imageFilePath', '".$Product->getProductname()."', ".$Product->getBarcode().",
                      ".$Product->getPurchase_price().", ".$Product->getFinal_price().", ".$Product->getPrice_offer().",
                      '".$Product->getDescrip()."', ".$Product->getMin_quantity().", ".$Product->getStock_quantity().",
                      '".$Product->getCategory_name()."', ".$Product->getBl().")";

    $stmt = $this->db->prepare($query);
    $stmt->execute();
}

    
    // `category_name`='".$Product->getCategory_name()."', you removed it bcs   there were no inputs to  update it w ktb9a empty :D , `imgs`='".$Product->getImgs()."' same for this  
    // and wa9ila bcs foreign key ? 
    public function update_product($Product){
        $query = "UPDATE `products` SET  `productname`='".$Product->getProductname()."',`barcode`=".$Product->getBarcode().",`purchase_price`=".$Product->getPurchase_price().",`final_price`=".$Product->getFinal_price().",`price_offer`=".$Product->getPrice_offer().",`descrip`='".$Product->getDescrip()."',`min_quantity`=".$Product->getMin_quantity().",`stock_quantity`=".$Product->getStock_quantity().",`bl`=".$Product->getBl()." WHERE `reference`= ".$Product->getReference();
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

    public function delete_product($id){
        $query = "UPDATE `products` SET `bl`= 0 WHERE `reference`=" . $id ;

        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }


    public function displayProductDetails($productId) {
        $sql = "SELECT * FROM Products WHERE reference = $productId";
        $stmt = $this->db->query($sql);
        
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($productData) {
            $product = new Product(
                $productData["reference"],
                $productData["imgs"],
                $productData["productname"],
                $productData["barcode"],
                $productData["purchase_price"],
                $productData["final_price"],
                $productData["price_offer"],
                $productData["descrip"],
                $productData["min_quantity"],
                $productData["stock_quantity"],
                $productData["category_name"],
                $productData["bl"]
            );
            
            return $product;
        }
    
        return null; // Return null if no product found
    }




    
//     public function filterProducts($page = 1, $recordsPerPage = 6)
//     {
//         $startFrom = ($page - 1) * $recordsPerPage;
    
//         // Base query
//         $query = "SELECT * FROM products WHERE bl = 1";
    
//         // Category filter
//         if (isset($_POST["category"]) && !empty($_POST["category"])) {
//             $category_array = json_decode($_POST["category"], true);
//             if (is_array($category_array)) {
//                 $category_filter = implode("','", $category_array);
//                 $query .= " AND category_name IN ('" . $category_filter . "')";
//             }
//         }
    
//         // Search filter
//         if (isset($_POST["search_query"]) && !empty($_POST["search_query"])) {
//             $search_query = $_POST["search_query"];
//             $query .= " AND (productname LIKE '%" . $search_query . "%' OR barcode LIKE '%" . $search_query . "%')";
//         }
    
//         // Sort filter
//         $sort_alphabetically = isset($_POST["sort_alphabetically"]) && $_POST["sort_alphabetically"] == 1;
//         if ($sort_alphabetically) {
//             $query .= " ORDER BY productname ASC";
//         }
    
//         // Count total products (ignoring filters for total count)
//         $totalProductsQuery = "SELECT COUNT(*) as total FROM products WHERE bl = 1";
//         $totalProductsResult = $this->db->query($totalProductsQuery);
//         $totalProducts = $totalProductsResult->fetchColumn();
    
//         // Pagination
//         $query .= " LIMIT $startFrom, $recordsPerPage";
    
//         // Execute filtered query
//         $productData = $this->db->query($query)->fetchAll();
//         $products = array();
    
//         foreach ($productData as $row) {
//             $product = new Product($row["reference"], $row["imgs"], $row["productname"], $row["barcode"], $row["purchase_price"], $row["final_price"], $row["price_offer"], $row["descrip"], $row["min_quantity"], $row["stock_quantity"], $row["category_name"], $row["bl"]);
//             $products[] = $product;
//         }
    
//         return [
//             'products' => $products,
//             'totalProducts' => $totalProducts,
//         ];
//     }
    
}


?>