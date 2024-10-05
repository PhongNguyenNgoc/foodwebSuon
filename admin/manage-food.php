<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Hien thong bao session
            unset($_SESSION['add']); //Huy thong bao session
        } ?>
        <br>
        <!--Nut them admin-->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>

            </tr>
            <?php
            //Truy van lay tat ca tu db
            $sql = "SELECT * FROM tbl_food";

            $res = mysqli_query($conn, $sql);

            //Dem dong
            $count = mysqli_num_rows($res);
            $sn = 1;
            if ($count > 0) {
                //Lay food tu db va hien thi len
                while ($row = mysqli_fetch_assoc($res)) {
                    //lay gia tri tung dong
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php
                            //Kiem tra ten co ton tai khong?
                            if ($image_name != "") {
                                //Hien thi anh
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" width="100" height="100">
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
                            <a href="#" class="btn-secondary">Update Food</a>
                            <a href="#" class="btn-danger">Delete Food</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                //Ko co food
                echo "<tr><td colspan='7' class='error'> Chua co food<td><tr>";
            }
            ?>



        </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>