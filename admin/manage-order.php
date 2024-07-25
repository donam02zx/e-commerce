<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý đơn hàng</h1>

                <br><br><br>

                <?php 
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br><br>

               <table class="tbl-full">
                    <tr>
                        <th>Stt.</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số hộp</th>
                        <th>Tổng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Hành động</th>
                    </tr>

                    <?php 
                        // Get all the order from database
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                        // Execute Query
                        $res = mysqli_query($conn, $sql);
                        // Count the rows
                        $count = mysqli_num_rows($res);

                        $sn=1; //Create a Serial Number and set its initail value as 1

                        if($count>0){
                            // Order available
                            while($row=mysqli_fetch_assoc($res)){
                                // Get all the order details
                                $id = $row['id'];
                                $food = $row['product'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_address = $row['customer_address'];

                                ?>
                                        <tr>
                                            <td><?php echo $sn++; ?>. </td>
                                            <td><?php echo $food; ?></td>
                                            <td><?php echo $price; ?></td>
                                            <td><?php echo $qty; ?></td>
                                            <td><?php echo $total; ?></td>
                                            <td><?php echo $order_date; ?></td>

                                            <td>
                                                <?php 
                                                    if($status=="Đơn mới"){
                                                        echo "<label style='font-size: 10px; color: white;background-color: green;'>$status</label>";
                                                    }
                                                    elseif($status=="Đã giao hàng"){
                                                        echo "<label style='font-size: 10px; color: white;background-color: red;'>$status</label>";
                                                    }
                                                    elseif($status=="Huỷ đơn"){
                                                        echo "<label style='font-size: 10px; color: white;background-color: black;'>$status</label>";
                                                    }
                                                ?>
                                            </td>
                                            
                                            <td><?php echo $customer_name; ?></td>
                                            <td><?php echo $customer_contact; ?></td>
                                            <td><?php echo $customer_address; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" style="font-size: 15px" class="btn-secondary">Cập nhật</a>
                                            </td>
                                        </tr>
                                <?php
                            }
                        }else{
                            // Order not available
                            echo "<tr><td colspan='12' class='error'>Không có đơn hàng nào!</td></tr>";
                        }
                    ?>

                  
               </table>

    </div>
</div>

<?php include('partials/footer.php') ?>