<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Hien thong bao session
            unset($_SESSION['add']); //Huy thong bao session
        }

        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" id="" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>User name</td>
                    <td><input type="text" name="username" id="" placeholder="Your user name"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" id="" placeholder="Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="submit" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
//Lay du lieu va dua len db
//Check button click hay ko

if (isset($_POST['submit'])) {
    //Button da click
    //echo "Da nhan nut";
    //Lay du lieu tu form

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //sql query
    $sql = "INSERT INTO tbl_admin SET 
        full_name='$full_name',
        username='$username',
        password='$password'
        ";
    //thuc thi lanh truy van
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //Hien thong bao them thanh cong/ that bai
    if ($res == true) {
        //Thong bao thanh cong
        //echo "them thanh cong";
        //Tao bien session  de hien thi thong bao
        $_SESSION['add'] = "Them admin thanh cong";
        //chuyen huong trang sang Manage Admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //Thong bao that bai
        //echo "them that bai";
        //Tao bien session  de hien thi thong bao
        $_SESSION['add'] = "Them admin that bai";
        //chuyen huong trang sang Manage Admin
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}
?>