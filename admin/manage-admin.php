<?php include('partials/menu.php'); ?>

<!--Bat dau phan chinh -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <!--Nut them admin-->


        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Hien thong bao session
            unset($_SESSION['add']); //Huy thong bao session
        }

        ?>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>

            </tr>

            <?php
            //Truy van va thuc thi sql
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);
            //tao bien sn de dem so thu tu cho chinh xac thay vi lay id
            $sn = 1;
            //Kiem tra truy van co thanh cong?
            if ($res == true) {
                //Dem dong co trong db
                $count = mysqli_num_rows($res);

                //Kiem tra so dong

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //Su dung vong lap de lay het du lieu tu db
                        //Lay du lieu theo tung cot
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Hien thi du lieu len table
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="#" class="btn-secondary">Update Admin</a>
                                <a href="#" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>



        </table>
    </div>
</div>
<!--Ket thuc phan chinh -->

<?php include('partials/footer.php'); ?>