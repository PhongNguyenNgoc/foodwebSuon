<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);

                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status']; // Onder, Dang lam, dang van chuyen, Da huy
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-order.php');
        }
        ?>

        <form action="" method="post">
            <Table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><?php echo $food; ?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><?php echo $price; ?></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option value="Ordered" <?php if ($status == "Ordered") echo "selected;" ?>>Da dat</option>
                            <option value="On Delivery" <?php if ($status == "On Delivery") echo "selected;" ?>>Dang giao</option>
                            <option value="Delivered" <?php if ($status == "Delivered") echo "selected;" ?>>Da giao</option>
                            <option value="Canceled" <?php if ($status == "Canceled") echo "selected;" ?>>Da huy</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Contact</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Email</td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td><textarea name="customer_address" id="" cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" value="Update Order" name="submit" class="btn-secondary">
                    </td>
                </tr>

            </Table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status']; // Onder, Dang lam, dang van chuyen, Da huy
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];


            $sql2 = "UPDATE tbl_order SET
            qty=$qty,
            total=$total,        
            status= '$status',
            customer_name='$customer_name',
            customer_email='$customer_email',
            customer_contact='$customer_email',
            customer_address='$customer_address'
            WHERE id=$id
            ";
            $res2 = mysqli_query($conn, $sql2);

            //Kiem tra thanh cong?
            if ($res2 == true) {
                $_SESSION['update'] = "<div class='success'>Cap nhat don hang thanh cong<div>";
                header("location:" . SITEURL . "admin/manage-order.php");
            } else {
                $_SESSION['update'] = "<div class='error'>Cap nhat don hang that bai<div>";
                header("location:" . SITEURL . "admin/manage-order.php");
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>