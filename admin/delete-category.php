<?php
include('../admin/config/constants.php');
//Kiem tra id va ten hinh anh co dc dat hay ko
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Xoa anh that trong may (server) khi co anh
    if ($image_name != "") {
        //Co anh, xoa
        $path = "../images/category/" . $image_name;
        //Xoa anh
        $remove = unlink($path);

        //Neu xoa that bai
        if ($remove == false) {
            //set sessioon va chuyen huong trang
            $_SESSION['remove'] = "<div class='error'>Xoa anh that bai</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            //dung tien trinh
            die();
        }
    }
    //Xoa du lieu trong DB
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    $res = mysqli_query($conn, $sql);
    //Kiem tra da xoa trong db chua?
    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Da xoa Category thanh cong</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Xoa category that bai</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    // chuyen ve manage dir
    header('location:' . SITEURL . 'admin/manage-category.php');
}
