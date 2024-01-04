<?php
require_once("Connection.php");
require_once("category.php");




class CategoryDAO {
    private $db;
    public function __construct(){
        $this->db = DatabaseConnection::getInstance()->getConnection(); 
    }

    public function get_category(){
        $query = "SELECT * FROM categories where bl = 1";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $categoryData = $stmt->fetchAll();
        $Categories = array();
        foreach ($categoryData as $C) { 
            $Categories[] = new Category ($C["catname"],$C["descrip"],$C["imgs"],$C["bl"]);
         
        }
        return $Categories;

    }
    public function insert_category($Category){
        $query= "INSERT INTO categories VALUES ('".$Category->getCatname()."','".$Category->getDescrip()."','".$Category->getImgs()."',".$Category->getBl().") ";
        $stmt = $this->db->prepare($query);
        $stmt -> execute();

    }

    public function update_Category($Category){
        $query = "UPDATE `categories` SET `descrip`='".$Category->getDescrip()."', `imgs`='".$Category->getImgs()."', `bl`='".$Category->getBl()."' WHERE `catname`='".$Category->getCatname()."'";
        $stmt = $this->db->query($query);
        $stmt->execute();
    }
    

    public function deleteCategory($categoryname){
        $query = "UPDATE categories SET bl = 0 WHERE catname = '" . $categoryname . "'";
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }
  
    public function displayCategoryDetails($categoryname) {
        $query = "SELECT * FROM categories WHERE catname = '" . $categoryname . "'";
        $result = $this->db->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
    
        if (!$row) {
            return null; 
        }
    
        return new Category($row["catname"], $row["descrip"], $row["imgs"], $row["bl"]);
    }
    
}


?>