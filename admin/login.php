<?php include("/xampp/htdocs/food-order/admin/config/constants.php"); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang nhap</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login']; //Hien thong bao session
            unset($_SESSION['login']); //Huy thong bao session
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message']; //Hien thong bao session
            unset($_SESSION['no-login-message']); //Huy thong bao session
        }

        ?>
        <!--Login start here-->
        <form action="" method="post" class="text-center">
            User name:
            <input type="text" name="username" id="" placeholder="Enter User name">
            <br><br>
            Password:
            <input type="password" name="password" id="" placeholder="Enter Your Password">
            <br><br>
            <input type="submit" value="Login" name="submit" class="btn-primary">
        </form>
        <!--Login start here-->
    </div>
</body>

</html>

<?php
//Kiem tra nut co duc nhan?
if (isset($_POST['submit'])) {
    //1. lay du lieu tu form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2. truy van sql de kiem tra user va pass co ton tai
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    //3 Thuc thi truy van)
    $res = mysqli_query($conn, $sql);
    //4. dem hang co xem user co ton tai?
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='success text-center'>Dang nhap thanh cong</div>";

        $_SESSION['user'] = $username;
        header('location:' . SITEURL . 'admin/index.php');
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Sai mat khau hoac pass loi</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>