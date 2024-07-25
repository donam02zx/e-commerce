<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý sản phẩm</h1>

        <br><br>
                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Thêm sản phẩm</a>

                <br><br><br>

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize'])){
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <br><br><br>
               <table class="tbl-full">
                    <tr>
                        <th>Stt.</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Hình ảnh</th>
                        <th>Tính năng</th>
                        <th>Hành động</th>
                        <th>Hoạt động</th>
                    </tr>

                    <?php 
                        // Create a SQL Query to get all the food
                        $sql = "SELECT * FROM tbl_product";

                        // Execute the Query
                        $res = mysqli_query($conn, $sql);

                        // Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        // Create Serial Number Variable and set Default  value as 1
                        $sn = 1;

                        if($count>0){
                            // We have food in database
                            // Get the food from database and display
                            while($row=mysqli_fetch_assoc($res)){
                                // get the value from indivisual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $price; ?>Đ</td>
                                        <td>
                                            <?php 
                                                // Check whether we have image or not 
                                                if($image_name==""){
                                                    // We do not have image, display error message
                                                    echo "<div class='error'>Hình ảnh không được thêm!</div>";
                                                }else{
                                                    // We have image, display image
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Sửa Sản Phẩm</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Xoá Sản Phẩm</a>
                                        </td>
                                    </tr>

                                <?php
                            }
                        }else{
                            // Food not added in database
                            echo "<tr> <td colspan='7' class='error'>Sản phẩm chưa được thêm!</td> </tr>";
                        }
                    ?>

                   
                   
               </table>

    </div>
</div>

<?php include('partials/footer.php') ?>