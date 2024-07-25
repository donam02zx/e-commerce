<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Thêm quản trị viên</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])){  //Checking whether the Session is Set of Not
                echo $_SESSION['add']; //Display the Session Message if Set
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Họ và tên: </td>
                    <td><input type="text" name="full_name" placeholder="Nhập tên của bạn"></td>
                </tr>

                <tr>
                    <td>Tài khoản: </td>
                    <td>
                        <input type="text" name="username" placeholder="Tên tài khoản">
                    </td>
                </tr>

                <tr>
                    <td>Mật khẩu: </td>
                    <td>
                        <input type="password" name="password" placeholder="Nhập mật khẩu">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php 
    // Process the Value from Form and Save it in Database

    // Check whether the submit button is clicked or not 

    if(isset($_POST['submit'])){
        // Button Clicked
        // echo "Button Clicked";

        //1. Get the data from Form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password  Endcryption with MD5

        //2. SQL Query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        
        //3. Excuting Query and Saving Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            // Data insert
            // echo "Data Inserted";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            // Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }else{
            // failed to insert data
            // echo "Fail to Inserted Data";
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            // Redirect Page Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>