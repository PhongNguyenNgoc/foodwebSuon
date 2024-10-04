<?php include('partials/menu.php');
?>
<?php
//Kiem tra id co duoc set?
if (isset($_GET['id'])) {
    //Lay tat ca du lieu
    $id = $_GET['id'];
    //Truy van sql
    $sql = "SELECT * from tbl_category WHERE id=$id";
    //Thuc thi truy van
    $res = mysqli_query($conn, $sql);
    //Dem dong de kiem tra id co hop le?
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //Lay het du lieu
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
    } else {
        //Chuyen huong trang
        $_SESSION['no-category-found'] = "<div class='error'>category not found<div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    //chuyen trang
    header('location:' . SITEURL . 'admin/manage-category.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" id="" placeholder="new category title" value="<?php echo $title ?>">
                    </td>
                </tr>
                <tr>
                    <td>Anh hien tai</td>
                    <td><?php
                        if ($current_image != "") {
                            //hien thi hinh anh 
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" alt="" width="100" height="100">
                        <?php
                        } else {
                            echo "<div class='error'>Hien tai khong co anh<div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Chon anh moi</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Feature</td>
                    <td>
                        <input type="radio" name="featured" id="" value="Yes" <?php if ($featured == "Yes") {
                                                                                    echo "checked";
                                                                                }; ?>>Yes
                        <input type="radio" name="featured" id="" value="No" <?php if ($featured == "No") {
                                                                                    echo "checked";
                                                                                }; ?>>No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" id="" value="Yes" <?php if ($active == "Yes") {
                                                                                echo "checked";
                                                                            }; ?>>Yes
                        <input type="radio" name="active" id="" value="No" <?php if ($active == "No") {
                                                                                echo "checked";
                                                                            }; ?>>No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" value="Update Category" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            //lay du lieu tu form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];


            // Kiem tra anh co duoc set chua
            //print_r($_FILES['image']);
            //Ket qua:Array ( [name] => kindred_.png [type] => image/png [tmp_name] => C:\xampp\tmp\phpE185.tmp [error] => 0 [size] => 25240967 )
            if (isset($_FILES['image']['name'])) {
                //upload anh
                //de upload anh, can:ten anh, duong dan nguon anh, duong dan dich
                $image_name = $_FILES['image']['name'];
                //Them category nhung khong can upload anh
                if ($image_name != "") {

                    $ext = end(explode('.', $image_name)); //Lay duoi anh (.jpg,.png...)

                    $image_name = "FC_" . rand(0, 999) . '.' . $ext; //doi ten khi upload lap lai hinh anh

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    //upload anh
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Kiem tra anh da duoc upload chua?
                    //Va neu anh da chua duoc upload, se dung chuong trinh va chuyen huong + bao loi
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Upload anh that bai<div>";
                        header("location:" . SITEURL . 'admin/manage-category.php');
                        die(); //buoc dung
                    }
                    //Xoa anh cu khi chung ton tai
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            $_SESSION['fail-to remove'] = "<div class='error'>Xoa anh cu that bai<div>";
                            header("location:" . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                    //Kiem tra anh da xoa? Neu that bai , dung toan bo tien trinh

                } else {
                    $image_name = $current_image;
                }
            } else {
                //ko up anh va set gia tri trong
                $image_name = $current_image;
            }
            //Tao truy van sql de insert
            $sql2 = "UPDATE tbl_category SET 
             title='$title',
             image_name='$image_name',
             featured='$featured',
             active='$active'
             WHERE id=$id
             ";

            //thuc thi truy van
            $res2 = mysqli_query($conn, $sql2);

            //kiem tra sau khi thuc thi

            if ($res2 == true) {
                $_SESSION['update'] = "<div class='success'>Cap nhat Category thanh cong<div>";
                //chuyen huong trang sang Manage Admin
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Cap nhat Category that bai<div>";
                //chuyen huong trang sang Manage Admin
                header("location:" . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>