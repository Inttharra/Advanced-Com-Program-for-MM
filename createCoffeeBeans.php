<?php
    require_once "php/config.php";
    session_start();
    if($_SESSION['role'] !== "admin") {
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coffee Bean</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php"; ?>
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col col-md-1 col-lg-2">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
            <div class="col-12 col-md-10 col-lg-8">
                <div class="row text-center my-2">
                    <p class="fs-4">Add Coffee Bean</p>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <form action="php/addCoffeeBean.php" method="post" enctype="multipart/form-data">
                                <div class="my-2">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="my-2">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" name="description" id="description" class="form-control" required>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-2">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" id="price" class="form-control" required>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <label for="img">Picture</label>
                                        <input type="file" name="picture" id="img" class="form-control" accept="image/jpeg, image/png" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-md-6 mb-2">
                                        <input type="submit" value="Submit" class="btn btn-success w-100">
                                    </div>
                                    <div class="col-12 col-md-6 mb-2">
                                        <input type="reset" value="Cancel" class="btn btn-danger w-100">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-1 col-lg-2">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>