<?php

//Authorization - Access Control
// Kiem tra nguoi dung da logout chua?
if (!isset($_SESSION['user'])) {
    $_SESSION['no-login-message'] = "<div class='error text-center'>Vui long dang nhap de truy cap<div>";
    //chuyen huong trang sang trang dang nhap
    header('location:' . 'http://localhost:8080/food-order/admin/login.php');
}
