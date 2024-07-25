<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thêm sản phẩm</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Tên: </td>
                    <td>
                        <input type="text" name="title" placeholder="Tên sản phẩm">
                    </td>
                </tr>

                <tr>
                    <td>Mô tả: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Mô tả sản phẩm"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Giá: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Chọn hình ảnh: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Chứng chỉ: </td>
                    <td>
                        <select name="category">

                            <?php 
                                // Create PHP Code to display category from database
                                //1.Create SQL to get all active category from databse
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                // Executing query
                                $res = mysqli_query($conn, $sql);

                                // Count Rows to check whether we have category or not
                                $count = mysqli_num_rows($res);

                                // If count is greater than zero, we have category else we do not have category
                                if($count>0){
                                    // We have category
                                    while($row=mysqli_fetch_assoc($res)){
                                        // Get the details of category
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }else{
                                    // We do not have category 
                                    ?>
                                        <option value="0">Không tìm thấy chứng chỉ!</option>
                                    <?php
                                }
                                
                                //2. Display on Drpopdown
                            ?>

                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Tính năng: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Có
                        <input type="radio" name="featured" value="No">Không
                    </td>
                </tr>

                <tr>
                    <td>Hành động: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Có
                        <input type="radio" name="active" value="No">Không
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Thêm" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php 
        
            // Check whether the button is clicked or not
            if(isset($_POST['submit'])){
                // Add the food in database
                // echo "Clicked";

                //1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // Check whether radio button for featured and active are checked or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No"; //Setting the default value
                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No"; //Setting default value
                }

                //2. Upload the image if Selected
                // Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name'])){
                    // Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    // Check whether the image is selected or not and upload image only if selected
                    if($image_name!=""){
                        // Image is selected
                        // A. Rename the Image
                        // Get the extension of selected image (jpg, png, gif, etc.)
                        $ext = end(explode('.', $image_name));

                        // Create new name for image
                        $image_name = "Food-name-".rand(0000,9999).".".$ext; //New image name may be "Food-name-657.jpg"

                        // B. Upload the image
                        // Get the Src Path and Destination path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        // Destination Path for the image to be Upload
                        $dst = "../images/food/".$image_name;

                        // Finally upload the food image
                        $upload = move_uploaded_file($src, $dst);
                        
                        // Check whether image uploaded of not
                        if($upload==false){
                            // Failed to upload the image
                            // Redirect to add food page with error message
                            $_SESSION['upload'] = "<div class='error'>Thêm hình ảnh thất bại!</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            // Stop the process
                            die();
                        }
                    }
                }else{
                    $image_name = ""; //Setting default value as blank
                }

                //3. Insert into database

                // Create a SQL Query to Save or Add Food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_product SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'

                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);
                // Check whether data inserted or not 
                //4. Redirect with message to manage food page
                if($res2==true){
                    // Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Thêm sản phẩm thành công!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }else{
                    // Failed to insert Data
                    $_SESSION['add'] = "<div class='error'>Thêm sản phẩm thất bại!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }
        
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>