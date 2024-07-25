<?php 

    // Include constants file
    include('../config/constants.php');

    // echo "Delete page";
    // Check whether the id and image_name value is set or not 
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        // Get the value and delete
        // echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image file is available
        if($image_name!=""){
            // Image is Available. So remove it
            $path = "../images/category/".$image_name;
            // Remove the Image
            $remove = unlink($path);
            
            // If failed to remove image then add an error message and stop the process
            if($remove==false){
                // Set the session message
                $_SESSION['remove'] = "<div class='error'>Xoá hình ảnh thất bại!</div>";
                // Redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }
        // Delete Data from Database
        // SQL Query to Delete Data from Database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // Execute the Query
        $res = mysqli_query($conn,$sql);

        // Check whether the data is delete from database or not
        if($res==true){
            // Set success message and Redirect
            $_SESSION['delete'] = "<div class='success'>Xoá thành công!</div>";
            // Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }else{
            // Set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Xoá thất bại!</div>";
            // Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

       
    }else{
        // Redirect to Manage Category 
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>