<?php
    session_start();
    if($_SESSION['role'] !== "admin") {
        header("location: index.php");
    }
    require_once "php/config.php";
    $id = $_GET['id'];

    $serach = "SELECT * FROM goods WHERE goods_id = '$id'";
    $result = mysqli_query($connect, $serach);

    $menu = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?= $menu['name']; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php"; ?>
    <div class="container-fluid">
        <div class="row mb-5 mt-3">
            <div class="col col-md-1 col-lg-2">
                <!-- ห้ามเขียนโค้ดตรงนี้ -->
            </div>
            <div class="col-12 col-md-10 col-lg-8">
            <div class="row text-center my-2">
                    <p class="fs-4">Edit <?= $menu['name']; ?></p>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <form action="php/editMenu.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $menu['goods_id']; ?>">
                                <div class="my-2">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?= $menu['name']; ?>" required>
                                </div>
                                <div class="my-2">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" name="description" id="description" class="form-control" value="<?= $menu['description']; ?>" required>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-2">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" id="price" class="form-control" value="<?= $menu['price']; ?>" required>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control" value="<?= $menu['quantity']; ?>" required>
                                    </div>
                                    <div class="col-12 col-md-4 mb-2">
                                        <label for="img">Picture</label>
                                        <input type="file" name="picture" id="img" class="form-control" accept="image/jpeg, image/png">
                                        <p style="font-size: 12px;">image selected : <?= $menu['img'] ?></p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category" id="category" class="form-select">
                                        <option value="<?= $menu['Coffee'] ?>" selected >
                                            <?php
                                                if($menu['Coffee'] == "yes") {
                                                    echo "Coffee";
                                                } else if($menu['Coffee'] == "no") {
                                                    echo "Non-Coffee";
                                                } else if($menu['Coffee'] == "des"){
                                                    echo "Dessert";
                                                } else if ($menu['Coffee'] == "mug") {
                                                    echo "Mug";
                                                } else {
                                                    echo "Coffee Bean";
                                                }
                                            ?>
                                        </option>
                                        <option value="yes">Coffee</option>
                                        <option value="no">Non-Coffee</option>
                                        <option value="des">Dessert</option>
                                    </select>
                                </div>
                                <div class="row">
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
    <?php include_once "footer.php" ?>
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>