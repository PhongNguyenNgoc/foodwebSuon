<?php
//0. include contrain.php
include("/xampp/htdocs/food-order/admin/config/constants.php");
//1. Lay id admin de xoa
$id = $_GET['id'];
//2.1 truy van sql de xoa

$sql = "DELETE FROM tbl_admin WHERE id=$id";

//2.2  thuc thi lanh sql de xoa
$res = mysqli_query($conn, $sql);

// Kiem tra sql co thuc thi dc?
if ($res == true) {
    //tao secssion de thong bao
    $_SESSION['delete'] = "<div class='success'>Da xoa admin thanh cong</div>";
    //Chuyen huong trang
    header('location:' . SITEURL . 'admin/manage-admin.php');
} else {
    //echo "Xoa that bai";
    $_SESSION['delete'] = "<div class='error'>Xoa that bai<div>";
    //Chuyen huong trang
    header('location:' . SITEURL . 'admin/manage-admin.php');
}
//3. quay ve trang  manage admin voi thong bao
