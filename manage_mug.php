<?php
    require_once "php/config.php";
    session_start();
    if($_SESSION['role'] !== "admin") {
        header("location: index.php");
    }
    if(isset($_GET['del'])) {
        $id = $_GET['del'];
        $deleteQuery = "DELETE FROM goods WHERE goods_id = '$id'";
        $result = mysqli_query($connect, $deleteQuery);

        if($result) {
            echo "<script>alert('This menu has been deleted successfully');</script>";
            header("refresh:1; url=manage_cofeeBeans.php");
        }
    }
    // update menu
    if(isset($_POST['updateMug'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = "mug";
        $id = $_POST['menu'];

        if(empty($_FILES["img"]["name"])){
            $updateNoImg = "UPDATE goods SET 
                `name` = '$name', 
                `description` = '$description', 
                price = '$price', 
                Coffee = '$category' WHERE goods_id = '$id'";
            $result = mysqli_query($connect, $updateNoImg);

            if($result) {
                echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Successfully',
                                    text: 'Edit this menu successfully',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = 'manage_coffeeBeans.php';
                                    }
                                });
                            });
                        </script>";
            } else {
                echo "Error: " . mysqli_error($connect); // Debugging statement
                echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Can't edit this menu, please try again',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = 'manage_coffeeBeans.php';
                                    }
                                });
                            });
                        </script>";
            }
        } else {
            $imgDir = "img-upload/";
            $fileName = basename($_FILES["img"]["name"]);
            $imgFilePath = $imgDir . $fileName;
            $fileType = pathinfo($imgFilePath, PATHINFO_EXTENSION);

            $allowType = array('jpg', 'png', 'jpeg');
            if(in_array($fileType, $allowType)) {
                if(move_uploaded_file($_FILES['img']['tmp_name'], $imgFilePath)) {
                    $updateWithImg = "UPDATE goods SET 
                        `name` = '$name', 
                        `description` = '$description', 
                        price = '$price', 
                        Coffee = '$category',
                        img = '".$fileName."' WHERE goods_id = '$id'";
                    $result = mysqli_query($connect, $updateWithImg);
                    if($result){
                        echo "<script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Successfully',
                                        text: 'Edit this menu successfully',
                                        customClass: {
                                            title: 'swal-custom-font',
                                            popup: 'swal-custom-font',
                                            confirmButton: 'swal-custom-font'
                                        }
                                    }).then((result) => {
                                        if(result.isConfirmed) {
                                            window.location.href = 'manage_coffeeBeans.php';
                                        }
                                    });
                                });
                            </script>";
                    } else {
                        echo "Error: " . mysqli_error($connect); // Debugging statement
                        echo "<script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Can't edit this menu, please try again',
                                        customClass: {
                                            title: 'swal-custom-font',
                                            popup: 'swal-custom-font',
                                            confirmButton: 'swal-custom-font'
                                        }
                                    }).then((result) => {
                                        if(result.isConfirmed) {
                                            window.location.href = 'manage_coffeeBeans.php';
                                        }
                                    });
                                });
                            </script>";
                    }
                } else {
                    echo "Error uploading file."; // Debugging statement
                }
            } else {
                echo "Invalid file type."; // Debugging statement
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Mugs</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include_once "navbar.php" ?>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col col-md-1 col-lg-2">
            
            </div>
            <div class="col-12 col-md-10 col-lg-8">
                <h2 class="text-center mb-3">Manage Mugs</h2>
                <div class="table-reponsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th style="width: 100px;">Edit</th>
                                <th style="width: 100px;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM goods WHERE Coffee = 'mug'";
                                $result = mysqli_query($connect, $query);

                                if(mysqli_num_rows($result) >= 1) {
                                    while ($menu = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?= $menu['name']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $menu['goods_id']; ?>">
                                            Edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $menu['goods_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $menu['goods_id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel<?= $menu['goods_id']; ?>">Edit Mugs</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="manage_mug.php" method="post" enctype="multipart/form-data">
                                                        <?php
                                                        
                                                        ?>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="menu" value="<?= $menu['goods_id']; ?>">
                                                            <div class="mb-2">
                                                                <label for="name" class="form-label">Name</label>
                                                                <input type="text" name="name" id="name" class="form-control" value="<?= $menu['name']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="descriton" class="form-label">Description</label>
                                                                <input type="text" name="description" id="description" class="form-control" value="<?= $menu['description']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="price" class="form-label">Price</label>
                                                                <input type="text" name="price" id="price" class="form-control" value="<?= $menu['price']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="img" class="form-label">Image</label>
                                                                <label for="img">Picture</label>
                                                                <input type="file" name="img" id="img" class="form-control" accept="image/jpeg, image/png">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="updateMug" class="btn btn-warning">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a data-id="<?= $menu['goods_id'];?>" href="manage_mug.php?del=<?= $menu['goods_id']; ?>" class="btn btn-danger w-100 delete-btn">Delete</a></td>
                            <?php } } ?>
                            <tr>
                                <td colspan="3" align="center"><a href="createMug.php" class="btn btn-primary w-100">Add mugs</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col col-md-1 col-lg-2">
                
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
    <script>
        $('.delete-btn').click(function(e) {
            var goodsID = $(this).data('id');
            e.preventDefault();
            deleteConfirm(goodsID);
        })

        function deleteConfirm(goodsID) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#47663B",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it",
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            url: 'manage_mug.php',
                            type: 'GET',
                            data: 'del=' + goodsID
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'Success',
                                text: 'This menu deleted successfully',
                                icon: 'success'
                            }).then(() => {
                                document.location.href = 'manage_mug.php';
                            })
                        })
                        .fail(function() {
                            Swal.fire({
                                title: 'Oops...',
                                text: 'Something went wrong with ajax',
                                icon: 'error'
                            });
                            window.location.reload();
                        })
                    })
                }
            })
        }
    </script>
</body>
</html>