<?php include('partials-front/menu.php'); ?>
<?php
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    //lay titile cua categoty
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    //Lay gia tri tu db
    $row = mysqli_fetch_assoc($res);
    //Lay titile
    $category_title = $row['title'];
} else {
    header('location:' . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on "<a href="#" class="text-white"><?php echo $category_title; ?></a>"</h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php

        //sql lay du lieu so voi tu khoa
        $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
        $res2 = mysqli_query($conn, $sql2);

        //dem dong ket qua
        $count2 = mysqli_num_rows($res2);
        //Kiem tra ket qua
        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $image_name = $row2['image_name'];

        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php

                        //Kiem tra anh co ton tai?
                        if ($image_name == "") {
                            echo "<div class='error'>Khong co anh</div>";
                        } else {
                        ?><img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve"><?php
                                                                                                                                                            }
                                                                                                                                                                ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Khong co ket qua mon an tu cat nay</div>";
        }
        ?>




        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>