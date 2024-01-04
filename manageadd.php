<?php
require_once("categoryDAO.php");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productManager = new CategoryDAO();
    $loopCount = count($_POST['catname']);

    for ($i = 0; $i < $loopCount; $i++) {
        $catname = $_POST['catname'][$i];
        $descrip = $_POST['descrip'][$i];

        // Handle image upload for category
        $catImagePath = "img/";
        $catImageFileName = $_FILES['imgs']['name'][$i];
        $catImageFilePath = $catImagePath . $catImageFileName;

        move_uploaded_file($_FILES['imgs']['tmp_name'][$i], $catImageFilePath);

        $category = new Category(
            $catname,
            $descrip,
            $catImageFilePath,
            1 
        );

        $productManager->insert_category($category);
    } 
}