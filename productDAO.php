<?php
require_once("Connection.php");
require_once("Classproducts.php");


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
public function get_Product($page, $limit, $sortAlphabetically, $searchQuery, $stockFilter, $category) {
    $offset = ($page - 1) * $limit;
    $searchFilter = '%' . htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8') . '%';

    $query = "SELECT * FROM products WHERE bl = 1";

    // Apply filters
    if ($category !== null && !empty($category)) {
        $categoryArray = json_decode($category, true);
        if (is_array($categoryArray)) {
            $categoryFilter = implode("','", $categoryArray);
            $query .= " AND category_name IN ('$categoryFilter')";
        }
    }

    if ($searchFilter != '') {
        $query .= " AND (productname LIKE :searchFilter OR descrip LIKE :searchFilter)";
    }

    if ($stockFilter) {
        $query .= " AND stock_quantity < min_quantity";
    }

    // Apply sorting
    if ($sortAlphabetically) {
        $query .= " ORDER BY productname ASC";
    }

    // Pagination
    $query .= " LIMIT :offset, :limit";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':searchFilter', $searchFilter, PDO::PARAM_STR);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

    $stmt->execute();
    $productData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $products = array();
    foreach ($productData as $data) {
        $products[] = new Product(
            $data["reference"],
            $data["imgs"],
            $data["productname"],
            $data["barcode"],
            $data["purchase_price"],
            $data["final_price"],
            $data["price_offer"],
            $data["descrip"],
            $data["min_quantity"],
            $data["stock_quantity"],
            $data["category_name"],
            $data["bl"]
        );
    }

    return $products;
}



    public function insert_product($Products, $imageFile){
        $imagePath = "img/";
        $imageFileName = basename($Products->getImgs()); 
        $imageFilePath = $imagePath . $imageFileName;
        move_uploaded_file($Products->getImgs(), $imageFilePath);
           
        $query= "INSERT INTO products VALUES (0,'$imageFilePath','".$Products->getProductname()."',".$Products->getBarcode().",".$Products->getPurchase_price().",".$Products->getFinal_price().",".$Products->getPrice_offer().",'".$Products->getDescrip()."',".$Products->getMin_quantity().",".$Products->getStock_quantity().",'".$Products->getCategory_name()."',".$Products->getBl().") ";
        $stmt = $this->db->query($query);
         $stmt -> execute();

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
        $stmt -> execute();
        $row = $stmt->fetchAll();
        $Products = array();
        foreach ($row as $P) {
            $Products[] = new Product ($P["reference"],$P["imgs"],$P["productname"],$P["barcode"],$P[ "purchase_price"], $P["final_price"] , $P["price_offer"] , $P["descrip"] , $P["min_quantity"] , $P["stock_quantity"] , $P["category_name"] , $P["bl"]);
        }
        return $Products;
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