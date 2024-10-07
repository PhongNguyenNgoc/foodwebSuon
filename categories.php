<?php include('partials-front/menu.php'); ?>



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        //Tao truy van sql de lay category tu db
        $sql = "SELECT * FROM tbl_category WHERE active='YES'";
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


<?php include('partials-front/footer.php'); ?>