<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td><input type="password" name="current_password" id="" placeholder="Enter old password"></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" id="" placeholder="Enter new password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" id="" placeholder="ReEnter your new password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" value="Change Password" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    //Lay du lieu tu form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    //Kiem tra user voi ID va mat khau co ton tai khong

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //thuc thi truy van
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //Ton tai user va pass co the doi
            //echo "Tim thay user";
            //Kt mat khau moi va nhap lai mat khau co trung khop ko
            if ($new_password == $confirm_password) {
                //Cap nhat mat khau moi neu tat ca thoa man
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                //Thuc thi sql
                $res2 = mysqli_query($conn, $sql2);
                //Kiem tra da thuc thi thanh cong?
                if ($res2 == true) {
                    $_SESSION['change-pwd'] = "<div class='success'>Cap nhat mat khau thanh cong</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    $_SESSION['change-pwd'] = "<div class='error'>Cap nhat mat khau that bai</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                $_SESSION['pwd-not-match'] = "<div class='error'>Mat khau khong hop le</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            //user ko ton tai
            $_SESSION['user-not-found'] = "<div class='error'>Khong ton tai user</div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }
}
?>
<?php include('partials/footer.php'); ?>