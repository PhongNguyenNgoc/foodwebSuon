<?php include('partials/menu.php'); ?>
<!--Bat dau phan chinh -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login']; //Hien thong bao session
            unset($_SESSION['login']); //Huy thong bao session
        }
        ?>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--Ket thuc phan chinh -->
<?php include('partials/footer.php'); ?>