<?php include('partials-front/menu.php'); ?>

    <div class="container-both">
         <!-- fOOD sEARCH Section Starts Here -->
    <section id="call"  class="food-search text-center">
        <div class="container">
            
           <div class="container-content">
                <span class="container_content-text">Collagen Comi - Công Nghệ Collagen Peptide Từ Nhật Bản</span>
           </div>

           <div class="container-topic">
                <span class="container_topic-text">Collagen Comi</span>
           </div>

           <div class="header-contact">
                <a href="tel:0919086396" class="container-contact">
                    <span class="contact-text">Gọi tư vấn</span>
                </a>
                <a href="https://www.facebook.com/profile.php?id=100024484042883" class="contact-face">
                    <i class="fab fa-facebook"></i>
                    <span class="face-text">Liên hệ</span>
                </a>
           </div>
           

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <div class="price-list" id="price">
        <div class="price_list-img">
            <img src="images/comi-price.jpg" class="img_price">
        </div>
        <div class="price_list-detail">
            <div class="header-detail">
                <span class="detail-text--header">Bảng giá sản phẩm</span>
            </div>
            <ul class="body-detail">
                <li class="detail-text--body">Hộp 10 gói = <span class="detail-price">288,000đ</span></li>
                <li class="detail-text--body">Combo 3 hộp 30 gói = <span class="detail-price">780,000đ</span></li>
                <li class="detail-text--body">Combo 5 hộp 50 gói = <span class="detail-price">1,250,000đ</span></li>
                <li class="detail-text--body">Combo 10 hộp 100 gói = <span class="detail-price">2,200,000đ</span></li>
            </ul>
            <div class="footer-detail">
                <span class="detail-text--footer">Nước uống <span class="detail-price">Collagen Trắng Da Comi</span> kết hợp cả glutathione, nước ép dâu , vừa trắng da lại không gây tăng cân </span>
            </div>
            <div class="footer-order">
                <a href="#order" class="order-link">
                    <span class="order-text">Đặt hàng</span>
                </a>
            </div>
        </div>
    </div>

    <?php 
    
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    
    ?>

    <!-- CAtegories Section Starts Here -->
    <section id="chungnhan" class="categories">
        <div class="container">
            <h2 class="text-center text-red">Giấy Chứng Nhận</h2>

            <?php 
                // Create SQL Query to Display Categories from Database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                // Execute the Query
                $res = mysqli_query($conn, $sql);
                // Count rows to check whether the category is available or not 
                $count = mysqli_num_rows($res);

                if($count>0){
                    // Category Available
                    while($row=mysqli_fetch_assoc($res)){
                        // Get the value
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                            <a href="category-foods.html">
                                <div class="box-3 float-container">
                                    <?php 
                                        // Check whether image is available or not  
                                        if($image_name==""){
                                            // Display message
                                            echo "<div class='error'>Hình ảnh không có sẵn!</div>";
                                        }else{
                                            // Image Available
                                            ?>
                                                 <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve img-new">
                                            <?php
                                        }
                                    ?>

                                   

                                    
                                </div>
                            </a>

                        <?php
                    }
                }else{
                    // Category not Available
                    echo "<div class='error'>Chứng chỉ không được thêm!</div>";
                }
            ?>



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section id="order" class="food-menu">
        <div class="container">
            <h2 class="text-center text-red">Sản Phẩm</h2>

            <?php 
            
                // Getting foods from database that are active and featured
                // SQL query
                $sql2 = "SELECT * FROM tbl_product WHERE active='Yes' AND featured='Yes' LIMIT 6";

                // Execute Query 
                $res2 = mysqli_query($conn, $sql2);

                // Count row
                $count2 = mysqli_num_rows($res2);

                // Check whether food available or not 
                if($count2>0){
                    // Food available
                    while($row2=mysqli_fetch_assoc($res2)){
                        // Get all the value
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php 
                                            // Check whether image available or not
                                            if($image_name==""){
                                                // Image not available
                                                echo "<div class='error'>Hình ảnh không có sẵn!</div>";
                                            }else{
                                                // Image available
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                <?php
                                            }
                                        ?>
                                        
                                    </div>

                                    <div class="food-menu-desc">
                                        <h4><?php echo $title; ?></h4>
                                        <p class="food-price"><?php echo $price; ?>Đ</p>
                                        <p class="food-detail">
                                            <?php echo $description; ?>
                                        </p>
                                        <br>

                                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt hàng</a>
                                    </div>
                                </div>
                        <?php
                    }

                }else{
                    // Food not available
                    echo "<div class='error'>Sản phẩm không có sẵn!</div>";
                }

            ?>


            <div class="clearfix"></div>

            

        </div>


    </section>
    <!-- fOOD Menu Section Ends Here -->

    <div id="review" class="price-list">
        <div class="price_list-img">
            <iframe width="300" height="400" src="https://www.youtube.com/embed/YFIlF_bEPzY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="price_list-detail">
            <div class="header-detail">
                <span class="detail-text--header">Á HẬU HUYỀN MY NÓI GÌ VỀ COLLAGEN COMI?</span>
            </div>
            <ul class="body-detail">
                <li class="detail-text--body">Hộp 10 gói = <span class="detail-price">288,000đ</span></li>
                <li class="detail-text--body">Combo 3 hộp 30 gói = <span class="detail-price">780,000đ</span></li>
                <li class="detail-text--body">Combo 5 hộp 50 gói = <span class="detail-price">1,250,000đ</span></li>
                <li class="detail-text--body">Combo 10 hộp 100 gói = <span class="detail-price">2,200,000đ</span></li>
            </ul>
            <div class="footer-detail">
                <span class="detail-text--footer">Là một trong những người đầu tiên trải nghiệm Collagen Comi, Á hậu Huyền My có những chia sẻ rất chân thật về dòng sản phẩm mới này. Giúp mọi người trả lời cho câu hỏi Collagen COMI có tốt không?</span>
            </div>
            <div class="footer-order">
                <a href="#order" class="order-link">
                    <span class="order-text">Đặt hàng</span>
                </a>
            </div>
        </div>
    </div>
    <div class="price-list">
        <div class="price_list-img">
            <iframe width="300" height="400" src="https://www.youtube.com/embed/MaPUA3LvBrk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="price_list-detail">
            <div class="header-detail">
                <span class="detail-text--header">BÍ QUYẾT "TRẺ MÃI KHÔNG GIÀ", ĐẨY LÙI LÃO HOÁ CỦA CA SĨ ĐAN TRƯỜNG</span>
            </div>
            <ul class="body-detail">
                <li class="detail-text--body">Hộp 10 gói = <span class="detail-price">288,000đ</span></li>
                <li class="detail-text--body">Combo 3 hộp 30 gói = <span class="detail-price">780,000đ</span></li>
                <li class="detail-text--body">Combo 5 hộp 50 gói = <span class="detail-price">1,250,000đ</span></li>
                <li class="detail-text--body">Combo 10 hộp 100 gói = <span class="detail-price">2,200,000đ</span></li>
            </ul>
            <div class="footer-detail">
                <span class="detail-text--footer">🍓Trong mỗi gói Collagen Comi sẽ cung cấp cho cơ thể 3.000mg Collagen peptide, một lượng Collagen vừa đủ để cơ thể có thể hấp thụ tốt nhất. Đồng thời, trong mỗi gói còn có tinh chất vitamin C, L-Glutathione giúp cơ thể tăng sức đề kháng cùng nhiều dưỡng chất giúp da sáng mịn.
                ✅Uống đều đặn Collagen vào mỗi tối trước khi đi ngủ bạn sẽ chạm đỉnh được vẻ đẹp của làn da. Da căng bóng, mịn màng cả ngày dài.</span>
            </div>
            <div class="footer-order">
                <a href="#order" class="order-link">
                    <span class="order-text">Đặt hàng</span>
                </a>
            </div>
        </div>
    </div>
    <div class="price-list">
        <div class="price_list-img">
            <iframe width="300" height="400" src="https://www.youtube.com/embed/JD5GCcIJfd4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="price_list-detail">
            <div class="header-detail">
                <span class="detail-text--header">CHUYÊN GIA ĐÁNH GIÁ NHƯ THẾ NÀO VỀ COLLAGEN COMI?</span>
            </div>
            <ul class="body-detail">
                <li class="detail-text--body">Hộp 10 gói = <span class="detail-price">288,000đ</span></li>
                <li class="detail-text--body">Combo 3 hộp 30 gói = <span class="detail-price">780,000đ</span></li>
                <li class="detail-text--body">Combo 5 hộp 50 gói = <span class="detail-price">1,250,000đ</span></li>
                <li class="detail-text--body">Combo 10 hộp 100 gói = <span class="detail-price">2,200,000đ</span></li>
            </ul>
            <div class="footer-detail">
                <span class="detail-text--footer">Bác sĩ Đỗ Thị Ngọc Diệp – Bác sĩ chuyên khoa 2, Phó Chủ tịch Hội Dinh dưỡng Việt Nam có những chia sẻ về Collagen COMI.
                Collagen COMI là một sản phẩm Collagen được ứng dụng công nghệ tách chiết collagen thủy phân độc quyền từ Nhật Bản, thành phần là sự kết hợp của Collagen peptide, chiết xuất dâu tây, cà chua, vitamin C, E,… </span>
            </div>
            <div class="footer-order">
                <a href="#order" class="order-link">
                    <span class="order-text">Đặt hàng</span>
                </a>
            </div>
        </div>
    </div>
    <div class="price-list">
        <div class="price_list-img">
            <iframe width="300" height="400" src="https://www.youtube.com/embed/Mk6WdirDpbw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="price_list-detail">
            <div class="header-detail">
                <span class="detail-text--header">Cặp đôi HOT TIKTOKER DŨNG GEE - VY PHẠM "MÊ MỆT" COLLAGEN COMI</span>
            </div>
            <ul class="body-detail">
                <li class="detail-text--body">Hộp 10 gói = <span class="detail-price">288,000đ</span></li>
                <li class="detail-text--body">Combo 3 hộp 30 gói = <span class="detail-price">780,000đ</span></li>
                <li class="detail-text--body">Combo 5 hộp 50 gói = <span class="detail-price">1,250,000đ</span></li>
                <li class="detail-text--body">Combo 10 hộp 100 gói = <span class="detail-price">2,200,000đ</span></li>
            </ul>
            <div class="footer-detail">
                <span class="detail-text--footer">Collagen Comi giúp chăm sóc sức khỏe và tôn vinh vẻ đẹp tự nhiên của làn da.</span>
            </div>
            <div class="footer-order">
                <a href="#order" class="order-link">
                    <span class="order-text">Đặt hàng</span>
                </a>
            </div>
        </div>
    </div>
    <div class="price-list">
        <div class="price_list-img">
            <iframe width="300" height="400" src="https://www.youtube.com/embed/8_Lrpkl6Ajk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="price_list-detail">
            <div class="header-detail">
                <span class="detail-text--header">COLLAGEN ĐÃ THAY ĐỔI LÀN DA CỦA MÌNH NHƯ THẾ NÀO</span>
            </div>
            <ul class="body-detail">
                <li class="detail-text--body">Hộp 10 gói = <span class="detail-price">288,000đ</span></li>
                <li class="detail-text--body">Combo 3 hộp 30 gói = <span class="detail-price">780,000đ</span></li>
                <li class="detail-text--body">Combo 5 hộp 50 gói = <span class="detail-price">1,250,000đ</span></li>
                <li class="detail-text--body">Combo 10 hộp 100 gói = <span class="detail-price">2,200,000đ</span></li>
            </ul>
            <div class="footer-detail">
                <span class="detail-text--footer">Collagen Comi giúp chăm sóc sức khỏe và tôn vinh vẻ đẹp tự nhiên của làn da.</span>
            </div>
            <div class="footer-order">
                <a href="#order" class="order-link">
                    <span class="order-text">Đặt hàng</span>
                </a>
            </div>
        </div>
    </div>

    <div id="origin" class="price-list">
        <div class="price_list-img">
            <img src="images/origin.jpg" class="img_price">
        </div>
        <div class="price_list-detail">
            <div class="header-detail">
                <span class="detail-text--header">Thành Phần Collagen Comi</span>
            </div>
            <ul class="body-detail">
                <li class="detail-text--body">Thành phần glutathion, Vitamin C, E, HA,...</li>
                <li class="detail-text--body">Collagen Comi chuẩn nhập Nhật 100%, hàm lượng vừa đủ với cơ thể, không gây tăng cân hay nổi mụn như các Collagen khác trên thị trường.</li>
                <li class="detail-text--body">1 gói Collagen Comi 25ml nhưng chứa đến 3.000mg Collagen peptide cùng các thành phần nổi bật khách như: Vitamin C, Chiết xuất quả cà chua, Chiết xuất quả dâu tây, L-Glutathione, Chiết xuất hạt nho, Vitamin E...</li>
                <li class="detail-text--body">Hiệu quả cảm nhận chỉ sau 21 ngày (lúc này cơ thể bạn bắt đầu hấp thụ & bạn hãy hiểu Collagen là TPCN nên cần phải dùng duy trì thường xuyên nhé).</li>
            </ul>
        </div>
    </div>
    <div id="affect" class="price-list">
        <div class="price_list-img">
            <img src="images/affect.jpg" class="img_price">
        </div>
        <div class="price_list-detail">
            <div class="header-detail">
                <span class="detail-text--header">Công Dụng Collagen Comi</span>
            </div>
            <ul class="body-detail">
                <li class="detail-text--body">Giúp da toàn thân trắng mịn tự nhiên, nâng 2-3 tông sau 1 liệu trình.</li>
                <li class="detail-text--body">Ức chế sự hình thành và phát triển của melamin, nám, giúp da khỏe mạnh, rạng rỡ.</li>
                <li class="detail-text--body">Làm mờ vết thâm, đốm nâu, phục hồi vùng da cháy nắng, hỗ trợ mờ nám an toàn từ sâu bên trong.</li>
                <li class="detail-text--body">Giảm nếp nhăn, trẻ hóa làn da, Chống oxy hóa, bảo vệ da trước gốc tự do gây hại.</li>
                <li class="detail-text--body">Duy trì làn da trắng hồng, mịn màng, tươi trẻ.</li>
            </ul>
        </div>
    </div>
    <div id="guide" class="price-list">
        <div class="price_list-img">
            <img src="images/guide.jpg" class="img_price">
        </div>
        <div class="price_list-detail">
            <div class="header-detail">
                <span class="detail-text--header">Hướng Dẫn Sử Dụng Collagen Comi</span>
            </div>
            <ul class="body-detail">
                <li class="detail-text--body">Mỗi ngày dùng 1 gói, trước khi đi ngủ 30 phút và lắc đều trước khi uống.</li>
                <li class="detail-text--body">Sẽ ngon hơn khi dùng lạnh.</li>
                <li class="detail-text--body">Duy trì sử dụng sản phẩm đều trong 3 tháng đầu. </li>
            </ul>
        </div>
    </div>
    </div>

   <div class="telephone">
        <a href="#sdt" class="tel-link">
            <div class="tel-icon">
                <i class="fas fa-phone-volume"></i>
            </div>
            <div class="tel-text">Số điện thoại</div>
        </a>
   </div>

   <div id="sdt" class="modal">
        <div class="modal__overlay"></div>

        <div class="modal__body">
            <div class="modal__inner">
                <div class="phone-text">SĐT Liên Hệ: 0919086396</div>
            </div>
            <div class="button-phone">
                <a href="#call" class="phone-call">
                    <div class="phone-call--text call">Gọi ngay</div>
                </a>
                <!-- <a href="" class="phone-cancel">
                    <div class="phone-call--text cancel">Thoát</div>
                </a> -->
            </div>
        </div>
   </div>

   

    <?php include('partials-front/footer.php'); ?>

    
