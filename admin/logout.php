<?php
//include cho SITEURL
include("/xampp/htdocs/food-order/admin/config/constants.php");
//1.Huy session
session_destroy(); //unset $_SESSION['user]
//2.Chuyen huong sang trang dang nhap
header('location:' . SITEURL . 'admin/login.php');
