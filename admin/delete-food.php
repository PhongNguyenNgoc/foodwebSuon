<?php
include('../admin/config/constants.php');
//Kiem tra id va ten hinh anh co dc dat hay ko
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Xoa anh that trong may (server) khi co anh
    if ($image_name != "") {
        //Co anh, xoa
        $path = "../images/food/" . $image_name;
        //Xoa anh
        $remove = unlink($path);

        //Neu xoa that bai
        if ($remove == false) {
            //set sessioon va chuyen huong trang
            $_SESSION['remove'] = "<div class='error'>Xoa anh that bai</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            //dung tien trinh
            die();
        }
    }
    //Xoa du lieu trong DB
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    $res = mysqli_query($conn, $sql);
    //Kiem tra da xoa trong db chua?
    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Da xoa food thanh cong</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Xoa food that bai</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    // chuyen ve manage dir
    $_SESSION['unAuth'] = "<div class='error'>Truy cap han che</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
