<?php
    session_start();
    require_once "config.php";
    $userID = $_SESSION['id'];
    $itemID = $_POST['itemID'];
    $qty = $_POST['qty'];

    if(isset($_POST['cart'])) {
        $query = "INSERT INTO cart (user_id, item_id, qty) VALUES ('$userID', '$itemID', '$qty')";
        $result = mysqli_query($connect, $query);

        if($result) {
            echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Order Added',
                                    text: 'You have successfully added the item to your cart.',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../cart.php';
                                    }
                                });
                            });
                    </script>";
        } else {
            echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Order Failed',
                                    text: 'Unable to add the item to your cart. Please try again.',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../menu.php';
                                    }
                                });
                            });
                    </script>";
        }
    } 
    if(isset($_POST['order'])){
        $menuName = $_POST['menuName'];
        $query = "INSERT INTO orders (userID, itemID, qty, `status`) VALUES ('$userID', '$itemID', '$qty', 'processing')";
        $result = mysqli_query($connect, $query);

        if($result) {
            $notiMessage = "You have a new order! $menuName is now ready to be prepared";
            $addNotiMessage = "INSERT INTO notificationAdmin (`text`, userID, `status`) VALUES ('$notiMessage', '$userID', 'Unread')";
            $resultAddNoti = mysqli_query($connect, $addNotiMessage);

            if($resultAddNoti) {
                echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Order Successful',
                                    text: 'Your order has been successfully placed and a notification has been sent to the admin.',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../orderCon.php';
                                    }
                                });
                            });
                    </script>";
            } else {
                echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Order Failed',
                                    text: 'Unable to place your order. Please try again.',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../menu.php';
                                    }
                                });
                            });
                    </script>";
            }
        } else {
            echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Order Failed',
                                    text: 'Unable to place your order. Please try again.',
                                    customClass: {
                                        title: 'swal-custom-font',
                                        popup: 'swal-custom-font',
                                        confirmButton: 'swal-custom-font'
                                    }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../menu.php';
                                    }
                                });
                            });
                    </script>";
        }
    }
?>