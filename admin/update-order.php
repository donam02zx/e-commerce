<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật đơn hàng</h1>
        <br><br>

        <?php 
        
            // Check order id is set or not 
            if(isset($_GET['id'])){
                // Get the order details
                $id = $_GET['id'];

                // Get all other details based on this id
                // SQL Query to get the order details
                $sql = "SELECT * FROM tbl_order WHERE id=$id";

                // Execute query
                $res = mysqli_query($conn, $sql);

                // Count rows
                $count = mysqli_num_rows($res);

                if($count==1){
                    // Detail available
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['product'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_address = $row['customer_address'];
                }else{
                    // Detail not Available
                    // Redirect to manage order
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

            }else{
                // Redirect to manage order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Tên sản phẩm</td>
                    <td> <b><?php echo $food; ?></b> </td>
                </tr>

                <tr>
                    <td>Giá</td>
                    <td>
                        <b><?php echo $price; ?>Đ</b>
                    </td>
                </tr>

                <tr>
                    <td>Số hộp</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Trạng thái</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Đơn mới"){echo "selected";} ?> value="Đơn mới">Đơn mới</option>
                            <option <?php if($status=="Đã giao hàng"){echo "selected";} ?> value="Đã giao hàng">Đã giao hàng</option>
                            <option <?php if($status=="Huỷ đơn"){echo "selected";} ?> value="Huỷ đơn">Huỷ đơn</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Địa chỉ</td>
                    <td>
                        <textarea name="customer_address"  cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Cập nhật" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            // Check whether update button is click or not
            if(isset($_POST['submit'])){
                // Get all the value from form 
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;
                $status = $_POST['status'];

                $customer_address = $_POST['customer_address'];

                // Update the value
                $sql2 = "UPDATE tbl_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check update or not
                // Redirect to manage order with message
                if($res2==true){
                    // Update
                    $_SESSION['update'] = "<div class='success'>Cập nhật đơn hàng thành công</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }else{
                    // Failed to update
                    $_SESSION['update'] = "<div class='error'>Cập nhật đơn hàng thất bại!</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>