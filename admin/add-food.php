<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //Hien thong bao session
            unset($_SESSION['upload']); //Huy thong bao session
        } ?>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Ten</td>
                    <td>
                        <input type="text" name="title" id="" placeholder="Title of Food">
                    </td>
                </tr>
                <tr>
                    <td>Description </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Thong tin ghi vao day"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Gia</td>
                    <td>
                        <input type="number" name="price" id="">
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
                                    //Lay thong tin category
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option><?php
                                                                                                    }
                                                                                                } else {
                                                                                                    //Ko co cat.
                                                                                                        ?>
                                <option value="0">Khong co category nao</option>
                            <?php
                                                                                                }
                            ?>


                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Feature:</td>
                    <td>
                        <input type="radio" name="featured" id="" value="Yes">Yes
                        <input type="radio" name="featured" id="" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" id="" value="Yes">Yes
                        <input type="radio" name="active" id="" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Food" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        //Kiem tra nut nhan
        if (isset($_POST['submit'])) {
            //Lay du lieu tu form
            $title = $_POST['title'];
            $desription = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            //KT radio button da nhan?
            if (isset($_POST['featured'])) {
                //lay gia tri
                $featured = $_POST['featured'];
            } else {
                //Lay gia tri mac dinh
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                //lay gia tri
                $active = $_POST['active'];
            } else {
                //Lay gia tri mac dinh
                $active = "No";
            }
            //Upload anh
            if (isset($_FILES['image']['name'])) {
                //upload anh
                //de upload anh, can:ten anh, duong dan nguon anh, duong dan dich
                $image_name = $_FILES['image']['name'];
                //Them food nhung khong can upload anh
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
                        header("location:" . SITEURL . 'admin/add-food.php');
                        die(); //buoc dung
                    }
                }
            } else {
                //ko up anh va set gia tri trong
                $image_name = "";
            }
            //Insert len db
            $sql2 = "INSERT INTO tbl_food SET
            title='$title',
            description='$desription',
            price=$price,
            image_name='$image_name',
            category_id='$category',
            featured='$featured',
            active='$active'
            ";
            //Thuc thi sql
            $res2 = mysqli_query($conn, $sql2);
            //KT da insert thanh cong?
            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>Them du lieu thanh cong<div>";
                header("location:" . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Them du lieu that bai<div>";
                header("location:" . SITEURL . 'admin/manage-food.php');
            }
            //Chuyen huong trang
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>