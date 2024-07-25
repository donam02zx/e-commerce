<?php include('partials/menu.php') ?>

        <!-- Main content section starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Bảng thống kê</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                <div class="col-4 text-center">

                    <?php 
                        // SQL query
                        $sql = "SELECT * FROM tbl_category";
                        // Execute Query
                        $res = mysqli_query($conn, $sql);
                        // Count rows
                        $count = mysqli_num_rows($res); 
                    ?>
                    
                    <h1><?php echo $count; ?></h1>
                    <br>
                    Chứng chỉ
                </div>
                <div class="col-4 text-center">

                    
                    <?php 
                        // SQL query
                        $sql2 = "SELECT * FROM tbl_product";
                        // Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        // Count rows
                        $count2 = mysqli_num_rows($res2); 
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Sản phẩm
                </div>
                <div class="col-4 text-center">

                    <?php 
                        // SQL query
                        $sql3 = "SELECT * FROM tbl_order";
                        // Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        // Count rows
                        $count3 = mysqli_num_rows($res3); 
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br>
                    Đơn hàng
                </div>
                <div class="col-4 text-center">

                    <?php 
                        // Create SQL Query to Get Total Revenue Generated
                        // Aggregate Function in SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Đã giao hàng'";

                        // Execute the Query 
                        $res4 = mysqli_query($conn, $sql4);

                        // Get the value
                        $row4 = mysqli_fetch_assoc($res4);

                        // Get the total Revenue
                        $total_revenue = $row4['Total'];
                    ?>

                    <h1><?php echo $total_revenue; ?></h1>
                    <br>
                    Doanh thu
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main content section ends -->

<?php include('partials/footer.php') ?>