<?php include('partials-front/menu.php'); ?>

    <?php 
    
        // Check whether food id is set or not
        if(isset($_GET['food_id'])){
            // Get the food id and details of selected food
            $food_id = $_GET['food_id'];

            // Get the detail of the selected food
            $sql = "SELECT * FROM tbl_product WHERE id=$food_id";
            // Execute the Query
            $res = mysqli_query($conn, $sql);
            // Count the rows
            $count = mysqli_num_rows($res);
            // Check whether the data is available or not
            if($count==1){
                // We have data
                // Get the data from database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }else{
                // Food not available
                // Redirect to home page
                header('location:'.SITEURL);
            }
        }else{
            // Redirect to homepage
            header('location:'.SITEURL);
        }
    
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-black">Điền thông tin để xác nhận đơn hàng</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Sản phẩm đã chọn</legend>

                    <div class="food-menu-img">
                        <?php 

                            // Check whether the image is available or not 
                            if($image_name==""){
                                // Image not available
                                echo "<div class='error'>Hình ảnh không có sẵn!</div>";
                            }else{
                                // Image is available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }

                        ?>

                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="product" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?>Đ</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Số hộp</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Chi tiết giao hàng</legend>
                    <div class="order-label">Họ Tên</div>
                    <input type="text" name="full-name" placeholder="Họ tên của bạn" class="input-responsive" required>

                    <div class="order-label">Số điện thoại</div>
                    <input type="tel" name="contact" placeholder="Nhập số điện thoại" class="input-responsive" required>

                    <!-- <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required> -->

                    <div class="order-label">Địa chỉ</div>
                    <textarea name="address" rows="10" placeholder="Số nhà-Tên Đường-Phường/Xã-Quận/Huyện-Tỉnh/Thành Phố" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Xác nhận đơn hàng" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            
                // Check whether submit button is clicked or not
                if(isset($_POST['submit'])){
                    // Get all the detail from form

                    $food = $_POST['product'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;

                    $order_date = date("Y-m-d h:i:sa"); //Order date

                    $status = "Đơn mới"; //ordered, on delivery, Delivered, cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_address = $_POST['address'];

                    // Save the order in database
                    // Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET
                        product = '$food',
                        price = '$price',
                        qty = '$qty',
                        total = '$total',
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_address = '$customer_address'
                    ";

                    // echo $sql2; die();

                    // Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    // Check whether query executed successfully or not
                    if($res2==true){
                        // Query executed and order saved
                        $_SESSION['order'] = "<div class='success text-center'>Đặt hàng thành công</div>";
                        header('location:'.SITEURL);
                    }else{
                        // Failed to save order
                        $_SESSION['order'] = "<div class='error text-center'>Đặt hàng thất bại!</div>";
                        header('location:'.SITEURL);
                    }
                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>