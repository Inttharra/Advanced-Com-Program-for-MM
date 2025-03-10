<?php
session_start();
include 'php/config.php';
    $userQuery1 = "SELECT * FROM goods WHERE goods_id = '17' " ;
    $userQuery2 = "SELECT * FROM goods WHERE goods_id = '23' " ;
    $userQuery3 = "SELECT * FROM goods WHERE goods_id = '24' " ;
    $result1 = mysqli_query($connect,$userQuery1);
    $result2 = mysqli_query($connect,$userQuery2);
    $result3 = mysqli_query($connect,$userQuery3);
    $row1 = mysqli_fetch_assoc($result1);
    $row2 = mysqli_fetch_assoc($result2);
    $row3 = mysqli_fetch_assoc($result3);

    if(isset($_GET['logout'])) {
        session_destroy();
        header("refresh:0; url=index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php"; ?>
    <div class="container-fluid my-2 wrapper">
        <div class="row content">
            <div class="col col-md-1 col-lg-1">
                <!-- ห้าม!เขียนโค้ดตรงนี้ สาป -->
            </div>
            <div class="col-12 col-md-10 col-lg-10">
                <!-- เริ่มเขียนโค้ดตรงนี้ -->
                 <div class="mt-4 mb-4">
                    <p class="fs-4 text-center">Brewed with Love, Deliver to You</p>
                    <p class="fs-6 text-center">Explore our fresh coffee, premium bean, and stylish mugs</p>
                 </div>
                <div class="row">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="material/img/Banner1.JPG" class="d-block w-100" alt="banner">
                            </div>
                            <div class="carousel-item">
                            <img src="material/img/Banner2(1).JPG" class="d-block w-100" alt="banner">
                            </div>
                            <div class="carousel-item">
                            <img src="material/img/Banner2.JPG" class="d-block w-100" alt="banner">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="row my-5 ps-2">
                    <div class="row">
                        <h4>Featured products</h4>
                    </div>
                    <div class="row mt-3 pe-0">
                        <div class="col-12 col-md-4 col-lg-4"> <!-- มีการแบ่ง layout ให้แล้วลองดูว่าควรเขียนตรงไหน --> 
                        <div class="card">
                                <img src="img-upload/<?= $row1['img']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $row1['name']; ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo $row1['description']?>
                                    </p>
                                    <a href="orderMenuCoffee.php?id=<?= $row1['goods_id']; ?>" class="btn" style="background-color: #404040; color: #fff;">Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4">
                        <div class="card">
                            <img src="img-upload/<?= $row2['img']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row2['name']?></h5>
                                <p class="card-text"><?php echo $row2['description']?></p>
                                <a class="btn" style="background-color: #404040; color: #fff;" href="orderMenuCoffee.php?id=<?= $row2['goods_id']; ?>">Order</a>
                            </div>
                        </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4">
                        <div class="card">
                            <img src="img-upload/<?= $row3['img']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row3['name']?></h5>
                                <p class="card-text"><?php echo $row3['description']?></p>
                                <a href="orderMenuCoffee.php?id=<?= $row3['goods_id']; ?>" class="btn" style="background-color: #404040; color: #fff;">Order</a>                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-1 col-lg-1">
                <!-- ห้าม!เขียนโค้ดตรงนี้ สาป -->
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>