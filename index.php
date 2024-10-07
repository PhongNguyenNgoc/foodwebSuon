<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.html" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <!--Lay du lieu tu may chu-->
        <?php
        //Tao truy van sql de lay category tu db
        $sql = "SELECT * FROM tbl_category WHERE active='YES' AND featured='Yes' LIMIT 3";
        $res = mysqli_query($conn, $sql);
        //Dem dong da lay ra
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //Co du lieu
            while ($row = mysqli_fetch_assoc($res)) {
                //Lay gia tri theo tung cot
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];

        ?>
                <a href="category-foods.html">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Category khong co anh<div>";
                        } else {
                        ?> <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve"><?php
                                                                                                                                                }
                                                                                                                                                    ?>


                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            //Ko co du lieu
            echo "<div class='error>Khong co category<div>";
        }

        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <!-- Lay 6 food tu db (tuong tu nhu 3 Category) -->
        <?php
        $sql2 = "SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 6";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];

        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Food khong co anh<div>";
                        } else {
                        ?> <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve"><?php
                                                                                                                                                            }
                                                                                                                                                                ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?>đ</p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="order.html" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Khong co mon an<div>";
        }

        ?>





        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>