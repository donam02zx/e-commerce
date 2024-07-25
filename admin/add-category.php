<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Thêm Chứng Chỉ</h1>

            <br><br>

            <?php 
            
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?>

            <br><br>

            <!-- Add category form starts -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Tên: </td>
                        <td>
                            <input type="text" name="title" placeholder="Loại chứng chỉ">
                        </td>
                    </tr>

                    <tr>
                        <td>Chọn hình ảnh: </td>
                        <td>
                            <input type="file" name="image">
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
            <!-- Add category form ends -->

            <?php 
            
                // Check whether the submit button is clicked or not 
                if(isset($_POST['submit'])){
                    // echo "clicked";

                    //1. Get the values from category form
                    $title = $_POST['title'];

                    //2. For radio input, we need to check whether the button is selected or not
                    if(isset($_POST['featured'])){
                        // Get the value from form
                        $featured = $_POST['featured']; 
                    }else{
                        // Set the dafault value
                        $featured = "No";
                    }

                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }else{
                        $active = "No";
                    }

                    // Check whether the image is selected or not and set the value for image name accoridingly
                    // print_r($_FILES['image']);

                    //die(); //Break the code here

                    if(isset($_FILES['image']['name'])){
                        // Upload the image
                        // To upload image we need image name, source patch and destination path
                        $image_name = $_FILES['image']['name'];

                        // Upload the image only if image is selected
                        if($image_name!=""){
                            // Auto Rename our image
                            // Get the extension of our image (jpg,png,etc) "food1.jpg"
                            $ext = end(explode('.',$image_name));

                            // Rename the Image
                            $image_name = "Food_Category_".rand(000,999).'.'.$ext; //e.g. Food_Category_834.jpg

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            // Finally upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            // Check whether the image is uploaded or not
                            // And if the image is not uploaded then we will stop the process and redirect with error message
                            if($upload==false){
                                // Set Message
                                $_SESSION['upload'] = "<div class='error'>Đăng ảnh không thành công!</div>";
                                // Redirect to Add category page
                                header('location:'.SITEURL.'admin/add-category.php');
                                // Stop the process
                                die();
                            }
                        }


                    }else{
                        // Do not upload image and set the image_name value as blank
                        $image_name="";
                    }

                    //2. Create SQL Query to Insert Category into Database
                    $sql = "INSERT INTO tbl_category SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                    ";

                    //3. Execute the Query and Save in Database
                    $res = mysqli_query($conn, $sql);
                    
                    //4. Check whether the query executed or not and data added or not
                    if($res==true){
                        // Query executed and category added
                        $_SESSION['add'] = "<div class='success'>Thêm Chứng Chỉ Thành Công!</div>";
                        // Redirect to Manage Category Page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }else{
                        // Failed to add category
                        $_SESSION['add'] = "<div class='error'>Thêm Chứng Chỉ Thất Bại!</div>";
                        // Redirect to Manage Category Page
                        header('location:'.SITEURL.'admin/add-category.php');
                    }

                }

            ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>