<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Hien thong bao session
            unset($_SESSION['add']); //Huy thong bao session
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //Hien thong bao session
            unset($_SESSION['upload']); //Huy thong bao session
        }
        ?>
        <br><br>

        <!--Add category start-->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" id="" placeholder="category title">
                    </td>
                </tr>

                <tr>
                    <td>Chon anh</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Feature</td>
                    <td>
                        <input type="radio" name="featured" id="" value="Yes">Yes
                        <input type="radio" name="featured" id="" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" id="" value="Yes">Yes
                        <input type="radio" name="active" id="" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Category" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--Add category end-->
        <?php
        if (isset($_POST['submit'])) {
            //lay du lieu tu form
            $title = $_POST['title'];
            //kiem tra da chon radio burron
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

            // Kiem tra anh co duoc set chua
            //print_r($_FILES['image']);
            //Ket qua:Array ( [name] => kindred_.png [type] => image/png [tmp_name] => C:\xampp\tmp\phpE185.tmp [error] => 0 [size] => 25240967 )
            if (isset($_FILES['image']['name'])) {
                //upload anh
                //de upload anh, can:ten anh, duong dan nguon anh, duong dan dich
                $image_name = $_FILES['image']['name'];

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
                    header("location:" . SITEURL . 'admin/add-category.php');
                    die(); //buoc dung
                }
            } else {
                //ko up anh va set gia tri trong
                $image_name = "";
            }
            //Tao truy van sql de insert
            $sql = "INSERT INTO tbl_category SET 
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            //thuc thi truy van
            $res = mysqli_query($conn, $sql);

            //kiem tra sau khi thuc thi

            if ($res == true) {
                $_SESSION['add'] = "<div class='success'>Them Category thanh cong<div>";
                //chuyen huong trang sang Manage Admin
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Them Category that bai<div>";
                //chuyen huong trang sang Manage Admin
                header("location:" . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>