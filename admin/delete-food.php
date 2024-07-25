<?php 
    // Include COnstants page
    include('../config/constants.php');
    // echo "delete";
    if(isset($_GET['id']) && isset($_GET['image_name'])){ //Either use '&&' or 'AND'
        // Process to delete

        //1. Get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image if Available
        // Check whether the image is available or not and delete only if available
        if($image_name!=""){
            // It has image and need to remove from folder
            // Get the image Path
            $path = "../images/food/".$image_name;

            // Remove Image file from folder
            $remove = unlink($path);

            // Check whether the image is removed or not 
            if($remove==false){
                // Failed to remove image 
                $_SESSION['upload'] = "<div class='error'>Gỡ bỏ file ảnh thất bại!</div>";
                // Redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                // Stop the process of deleting food
                die();
            }
        }

        //3. Delete food from database
        $sql = "DELETE FROM tbl_product WHERE id=$id";
        // Execute the Query
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed or not and set the session message respectively
        //4. Redirect to manage food with session message
        if($res==true){
            // Food deleted
            $_SESSION['delete'] = "<div class='success'>Xoá sản phẩm thành công!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            // Failed to delete food
            $_SESSION['delete'] = "<div class='error'>Xoá sản phẩm thất bại!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        

    }else{
        // Redirect to manage food page
        $_SESSION['unauthorize'] = "<div class='error'>Truy cập trái phép!</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>