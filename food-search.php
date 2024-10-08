<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on Your Search "<a href="#" class="text-white"><?php echo $_POST['search']; ?></a>"</h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        //Lay du lieu tu khung search
        $search = $_POST['search'];
        //sql lay du lieu so voi tu khoa
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' or description like '%$search%'";
        $res = mysqli_query($conn, $sql);

        //dem dong ket qua
        $count = mysqli_num_rows($res);
        //Kiem tra ket qua
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];

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
            echo "<div class='error'>Khong co ket qua</div>";
        }
        ?>
        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>