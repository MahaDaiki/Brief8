<?php
require_once("ManageConfig.php");
require_once("categoryDAO.php");

// Instantiate CategoryDAO
$categoryDAO = new CategoryDAO();

if (isset($_GET['category_name'])) {
    $categoryName = $_GET['category_name'];

    // Fetch category details
    $categoryDetails = $categoryDAO->displayCategoryDetails($categoryName);

    if (!$categoryDetails) {
        header("Location: Manage.php");
        exit();
    }

    $category = $categoryDetails;

    
    $category = $categoryDetails;

    if (isset($_POST['update'])) {
        $newDescrip = $_POST['new_description'];
        $imageFile = $_FILES['new_image'];

        // Check if a new image is provided
        if (!empty($imageFile['name'])) {
            $uploadDir = 'img/';
            $uploadPath = $uploadDir . basename($imageFile['name']);

            // Move the uploaded file to the destination folder
            if (move_uploaded_file($imageFile['tmp_name'], $uploadPath)) {
                $updatedCategory = new Category($category->getCatname(), $newDescrip, $uploadPath, 1);
                $categoryDAO->update_Category($updatedCategory);

                echo '<script>alert("Category updated successfully!");</script>';
            } else {
                echo '<script>alert("Error uploading file!");</script>';
            }
        } else {
            // Update category information without changing the image
            $updatedCategory = new Category($category->getCatname(), $newDescrip, $category->getImgs(), 1);
            $categoryDAO->update_Category($updatedCategory);

            echo '<script>alert("Category information updated successfully!");</script>';
        }
    }

    
    if (isset($_POST['delete'])) {
        $deleteData = new CategoryDAO();
        $deleteData->deleteCategory($categoryName);
        echo '<script>alert("Category deleted successfully!");</script>';
        
    }
}
?>