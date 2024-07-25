<?php include('partials/menu.php'); ?>

<?php 
    // Check whether id is set or not 
    if(isset($_GET['id'])){
        // Get all the details
        $id = $_GET['id'];

        // SQL Query to get the selected Food
        $sql2 = "SELECT * FROM tbl_product WHERE id=$id";
        // execute the query
        $res2 = mysqli_query($conn, $sql2);

        // Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        // Get the indivisual values of selected food 
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];


    }else{
        // Redirect to manage food
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật sản phẩm</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Tên: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Mô tả: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Giá: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh hiện tại: </td>
                    <td>
                        <?php 
                            if($current_image==""){
                                // Image not available
                                echo "<div class='error'>Hình ảnh không có sẵn</div>";
                            }else{
                                // Image available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Chọn hình ảnh mới</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Chứng chỉ: </td>
                    <td>
                        <select name="category">
                            <?php 
                            
                                // Query to get active categories
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                // Execute the Query
                                $res = mysqli_query($conn, $sql);
                                // COunt rows
                                $count = mysqli_num_rows($res);

                                // Check whether category available or not
                                if($count>0){
                                    // Category Available
                                    while($row=mysqli_fetch_assoc($res)){
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        
                                        // echo "<option value='$category_id'>$category_title</option>";
                                        ?>
                                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php

                                    }
                                }else{
                                    // Category not Available
                                    echo "<option value='0'>Chứng chỉ không tồn tại</option>";
                                }
                            
                            ?>

                            <option value="0">Test Category</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Tính năng: </td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Có
                        <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No">Không
                    </td>
                </tr>

                <tr>
                    <td>Hành động: </td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Có
                        <input  <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">Không
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Cập nhật" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php 
        
            if(isset($_POST['submit'])){
                // echo "CLicked";

                // 1. Get all the details from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // 2. Upload the image if selected

                // Check whether upload button is clicked or not 
                if(isset($_FILES['image']['name'])){
                    // Upload button clicked
                    $image_name = $_FILES['image']['name']; //New Image Name

                    // Check whether the file is available or not 
                    if($image_name!=""){
                        // Image is available
                        // A. Uploading new image

                        // Rename the image 
                        $ext = end(explode('.', $image_name)); //Get the extension of the image

                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; //This will be rename image

                        // Get the source Path and Destination Path
                        $src_path = $_FILES['image']['tmp_name']; //Source Path
                        $dest_path = "../images/food/".$image_name; //Destination path

                        // Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        // Check whether the image is uploaded or not 
                        if($upload==false){
                            // Failed to upload
                            $_SESSION['upload'] = "<div class='error'>Cập nhật ảnh mới thất bại!</div>";
                            // Redirect to manage food
                            header('location:'.SITEURL.'admin/manage-food.php');
                            // Stop the process
                            die();
                        }

                        // 3. Remove the image if new image is uploaded and current image exists
                        //B. Remove current image if Available
                        if($current_image!=""){
                            // Current image is available
                            // Remove the image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            // Check whether the image is removed or not 
                            if($remove==false){
                                // failed to remove current image 
                                $_SESSION['remove-failed'] = "<div class='error'>Xoá hình ảnh hiện tại thất bại!</div>";
                                // Redirect to manage food 
                                header('location:'.SITEURL.'admin/manage-food.php');
                                // Stop the process
                                die();
                            }
                        }
                    }else{
                        $image_name = $current_image;
                    }

                }else{
                    $image_name = $current_image;
                }

                

                // 4.Update the food in database
                $sql3 = "UPDATE tbl_product SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                // Execute the SQL Query 
                $res3 = mysqli_query($conn, $sql3);

                // Check whether the query is execute or not 
                if($res3==true){
                    // Query Executed and Food Updated
                    $_SESSION['update'] = "<div class='success'>Cập nhật sản phẩm thành công!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }else{
                    // Failed to update food
                    $_SESSION['update'] = "<div class='error'>Cập nhật sản phẩm thất bại!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>