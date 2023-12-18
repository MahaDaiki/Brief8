<?php
require_once("Connection.php");
require_once("category.php");




class CategoryDAO {
    private $db;
    public function __construct(){
        $this->db = DatabaseConnection::getInstance()->getConnection(); 
    }

    public function get_category(){
        $query = "SELECT * FROM categories";
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
        $stmt = $this->db->query($query);
        $stmt -> execute();

    }

    public function update_Category($Category){
        $query = "UPDATE `categories` SET `catname`='".$Category->getCatname()."',`descrip`='".$Category->getDescrip()."',`imgs`='".$Category->getImgs()."',`bl`='".$Category->getBl()."' WHERE 1";
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

    public function delete_Category($id){
        $query = "UPDATE `products` SET `bl`= 0 WHERE `reference`=" . $id ;

        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

  

}


?>