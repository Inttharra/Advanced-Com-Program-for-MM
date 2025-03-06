<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .swal-custom-font {
            font-family: 'Poppins', serif !important;
        }
    </style>
</head>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    require_once "config.php";

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $id = $_POST['id'];

    if(empty($_FILES["picture"]["name"])){
        $updateNoImg = "UPDATE goods SET 
            `name` = '$name', 
            `description` = '$description', 
            price = '$price', 
            quantity = '$quantity', 
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
                                    window.location.href = '../manage_menu.php';
                                }
                            });
                        });
                    </script>";
        } else {
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
                                    window.location.href = '../manage_menu.php';
                                }
                            });
                        });
                    </script>";
        }
    } else {
        $imgDir = "../img-upload/";
        $fileName = basename($_FILES["picture"]["name"]);
        $imgFilePath = $imgDir . $fileName;
        $fileType = pathinfo($imgFilePath, PATHINFO_EXTENSION);

        $allowType = array('jpg', 'png', 'jpeg');
        if(in_array($fileType, $allowType)) {
            if(move_uploaded_file($_FILES['picture']['tmp_name'], $imgFilePath)) {
                $updateWithImg = "UPDATE goods SET 
                    `name` = '$name', 
                    `description` = '$description', 
                    price = '$price', 
                    quantity = '$quantity', 
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
                                        window.location.href = '../manage_menu.php';
                                    }
                                });
                            });
                        </script>";
                } else {
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
                                        window.location.href = '../manage_menu.php';
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
?>