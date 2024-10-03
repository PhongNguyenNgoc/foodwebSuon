<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <?php
        //Lay id
        $id = $_GET['id'];
        //tao truy van sql
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";
        //thuc thi
        $res = mysqli_query($conn, $sql);

        //kiem tra truy van co chay?
        if ($res == true) {
            //dem dong
            $count = mysqli_num_rows($res);
            //kt co du lieu ton tai?
            if ($count == 1) {
                // Lay thong tin
                $rows = mysqli_fetch_assoc($res);

                $full_name = $rows['full_name'];
                $username = $rows['username'];
            } else {
                //chuyen ve trang manage admin
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" id="" placeholder="Enter your new name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>User name</td>
                    <td><input type="text" name="username" id="" placeholder="Your new user name" value="<?php echo $username ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" value="Update Admin" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


    </div>

</div>
<?php
if (isset($_POST['submit'])) {
    // echo "Clicked";
    //Lay tat ca gia tri tu form de update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //tao truy van sql update
    $sql = "UPDATE tbl_admin SET 
    full_name='$full_name',
    username='$username'
    WHERE id=$id";

    //thuc thi sql
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['update'] = "<div class='success'>Cap nhat thanh cong</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Cap nhat that bai</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}
?>

<?php include('partials/footer.php'); ?>