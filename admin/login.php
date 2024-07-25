<?php  include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Đăng Nhập</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Login form start here -->
            <form action="" method="POST" class="text-center">
                Tài Khoản: <br>
                <input type="text" name="username" placeholder="Nhập Tài Khoản Của Bạn"><br><br>
                Mật Khẩu: <br>
                <input type="password" name="password" placeholder="Nhập Mật Khẩu"><br><br>

                <input type="submit" name="submit" value="Đăng nhập" class="btn-primary">
                <br><br>
            </form>
            <!-- Login form end here -->

            <p class="text-center">Creat by - <a href="">Đỗ Nam</a></p>
        </div>
    </body>
</html>

<?php 

    // Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        // Process for Login
        //1. Get the Data from Login form 
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);
        
        if($count==1){
            // User available and Login Success
            $_SESSION['login'] = "<div class='success'>Đăng nhập thành công!</div>";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset

            // Redirect homepage dashboard
            header('location:'.SITEURL.'admin/');
        }else{
            // User not available and Login Fail
            $_SESSION['login'] = "<div class='error text-center'>Tài khoản hoặc mật khẩu không đúng!</div>";
            // Redirect homepage dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>