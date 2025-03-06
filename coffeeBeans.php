<?php
    session_start();
    include_once "php/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php"; ?>
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col col-md-1 col-lg-1">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
            <div class="col-12 col-md-10 col-lg-10">
                <div class="row">
                    <p class="text-center fs-1">Menu</p>
                </div>
                <div>
                    <p class="text-start fs-3">Coffee Beans</p>
                </div>
                <div class="row my-2">
                    <!-- ไปทำต่อเองเริ่มให้แล้ว -->
                <?php $queryMenuCoffee = "SELECT * FROM goods WHERE Coffee = 'bean'"; 
                    $result = mysqli_query($connect, $queryMenuCoffee);

                    while ($menu = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="col-12 col-md-3 ol-lg-3">
                        <div class="card">
                            <img src="img-upload/<?= $menu['img']; ?>" class="card-img-top">
                            <div class="card-body">
                                <h4 class="card-title"><?= $menu['name']; ?></h4>
                                <p style="font-size: 12px;"><?= $menu['description']; ?></p>
                                <p style="font-size: 25px;"><?= $menu['price']; ?>฿</p>
                                <a href="orderMenuCoffee.php?id=<?= $menu['goods_id']; ?>" class="btn btn" style="background-color: #404040; color: #fff;">Order</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
            </div>
            <div class="col col-md-1 col-lg-1">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>