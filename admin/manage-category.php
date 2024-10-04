<?php include('partials/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Hien thong bao session
            unset($_SESSION['add']); //Huy thong bao session
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove']; //Hien thong bao session
            unset($_SESSION['remove']); //Huy thong bao session
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //Hien thong bao session
            unset($_SESSION['delete']); //Huy thong bao session
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found']; //Hien thong bao session
            unset($_SESSION['no-category-found']); //Huy thong bao session
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //Hien thong bao session
            unset($_SESSION['update']); //Huy thong bao session
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload']; //Hien thong bao session
            unset($_SESSION['upload']); //Huy thong bao session
        }
        if (isset($_SESSION['fail-to remove'])) {
            echo $_SESSION['fail-to remove']; //Hien thong bao session
            unset($_SESSION['fail-to remove']); //Huy thong bao session
        }
        ?>
        <br>
        <!--Nut them admin-->
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Action</th>

            </tr>
            <?php
            //TRuy van
            $sql = "SELECT * FROM tbl_category";
            //Execute Query
            $res = mysqli_query($conn, $sql);
            //Dem dong
            $count = mysqli_num_rows($res);
            //Tao bien serial numer
            $sn = 1;
            //Kt co du lieu trong DB ko?
            if ($count > 0) {
                //co du lieu
                //lay du lieu de hien thi
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>

                        <td><?php
                            //Kiem tra ten co ton tai khong?
                            if ($image_name != "") {
                                //Hien thi anh
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" width="100" height="100">
                            <?php
                            } else {
                                //Hien thi thong bao
                                echo "<div class='error'>Khong co anh</div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                        </td>

                    </tr>
                <?php
                }
            } else {
                //Khong co
                ?>
                <tr>
                    <td colspan="6" class="error">Khong co du lieu</td>
                </tr>
            <?php
            }
            ?>



        </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>