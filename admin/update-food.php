<?php include('partials/menu.php'); ?>
<?php
//Kiem tra id co duoc set?
if (isset($_GET['id'])) {
    //Lay tat ca du lieu
    $id = $_GET['id'];
    //Truy van sql
    $sql2 = "SELECT * from tbl_food WHERE id=$id";
    //Thuc thi truy van
    $res2 = mysqli_query($conn, $sql2);



    //Lay du lieu
    $row2 = mysqli_fetch_assoc($res2);

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    //chuyen trang
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Ten</td>
                    <td>
                        <input type="text" name="title" id="" placeholder="Title of Food" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Thong tin ghi vao day"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Gia</td>
                    <td>
                        <input type="number" name="price" id="" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Anh hien tai</td>
                    <td><?php
                        if ($current_image != "") {
                            //hien thi hinh anh 
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image ?>" alt="" width="100" height="100">
                        <?php
                        } else {
                            echo "<div class='error'>Hien tai khong co anh<div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Chon anh</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" id="">
                            <?php
                            //Do du lieu vao combobox tu db
                            //truy van  vat thuc thi sql va lay tat ca category dang active
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            //Dem dong duoc thuc thi
                            $count = mysqli_num_rows($res);
                            //Neu > 0 thi co cat. 
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];

                                    //echo "<option value='$category_id'>$category_title</value>";
                            ?><option <?php if ($current_category == $category_id) echo "selected"; ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option><?php
                                                                                                                                                                                }
                                                                                                                                                                            } else {
                                                                                                                                                                                echo "<option value='0'>Khong co category de chon</value>";
                                                                                                                                                                            }
                                                                                                                                                                                    ?>


                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Feature:</td>
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
                    <td>Active:</td>
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" value="Add Food" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            //lay du lieu tu form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
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

                    $image_name = "FN_" . rand(0, 999) . '.' . $ext; //doi ten khi upload lap lai hinh anh

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/" . $image_name;

                    //upload anh
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Kiem tra anh da duoc upload chua?
                    //Va neu anh da chua duoc upload, se dung chuong trinh va chuyen huong + bao loi
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Upload anh that bai<div>";
                        //  header("location:" . SITEURL . 'admin/manage-food.php');
                        die(); //buoc dung
                    }
                    //Xoa anh cu khi chung ton tai
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            $_SESSION['fail-to remove'] = "<div class='error'>Xoa anh cu that bai<div>";
                            //  header("location:" . SITEURL . 'admin/manage-food.php');
                            die();
                        }
                    }
                    //Kiem tra anh da xoa? Neu that bai , dung toan bo tien trinh

                } else {
                    $image_name = $current_image; // Khi anh ko dc chon
                }
            } else {

                $image_name = $current_image; //Khi chua chon anh
            }
            //Tao truy van sql de insert
            $sql3 = "UPDATE tbl_food SET 
               title='$title',
               description='$description',
               price=$price,
               image_name='$image_name',
               category_id=$category_id,
               featured='$featured',
               active='$active'
               WHERE id=$id
               ";

            //thuc thi truy van
            $res3 = mysqli_query($conn, $sql3);

            //kiem tra sau khi thuc thi

            if ($res3 == true) {
                $_SESSION['update'] = "<div class='success'>Cap nhat Food thanh cong<div>";
                //chuyen huong trang sang Manage Admin
                header("location:" . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Cap nhat food that bai<div>";
                //chuyen huong trang sang Manage Admin
                header("location:" . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>