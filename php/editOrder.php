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

    $orderID = $_POST['orderID'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $time = $_POST['timeOrder'];
    $name = $_POST['nameMenu'];
    $userID = $_POST['userIDMessage'];

    $updateQuery = "UPDATE orders SET qty = '$qty', `status` = '$status', `time` = '$time'  WHERE orderID = '$orderID'";
    $updateResult = mysqli_query($connect, $updateQuery);

    if($status == "processing"){
        $message = "Your $name is on its way! We are preparing it now.";
        $messageQuery = "INSERT INTO notifications (`message`, userID, `status`) VALUES ('$message', '$userID', 'Unread')";
        $result = mysqli_query($connect, $messageQuery);
        
        if($result) {
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully',
                            text: 'Order has been successfully updated',
                            customClass: {
                                title: 'swal-custom-font',
                                popup: 'swal-custom-font',
                                confirmButton: 'swal-custom-font'
                            }
                        }).then((result) => {
                            if(result.isConfirmed) {
                                window.location.href = '../manage_orders.php';
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
                            text: 'Can't edit this order, please try again',
                            customClass: {
                                    title: 'swal-custom-font',
                                    popup: 'swal-custom-font',
                                    confirmButton: 'swal-custom-font'
                            }
                            }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../manage_orders.php';
                                    }
                                });
                            });
                    </script>";
        }
    } elseif ($status == "Ready") {
        $message = "Great news! Your $name is ready for pickup";
        $messageQuery = "INSERT INTO notifications (`message`, userID, `status`) VALUES ('$message', '$userID', 'Unread')";
        $result = mysqli_query($connect, $messageQuery);

        if($result) {
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully',
                            text: 'Order has been successfully updated',
                            customClass: {
                                title: 'swal-custom-font',
                                popup: 'swal-custom-font',
                                confirmButton: 'swal-custom-font'
                            }
                        }).then((result) => {
                            if(result.isConfirmed) {
                                window.location.href = '../manage_orders.php';
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
                            text: 'Can't edit this order, please try again',
                            customClass: {
                                    title: 'swal-custom-font',
                                    popup: 'swal-custom-font',
                                    confirmButton: 'swal-custom-font'
                            }
                            }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../manage_orders.php';
                                    }
                                });
                            });
                    </script>";
        }
    } else {
        $message = "Your $name is complete! Thank you for your order.";
        $messageQuery = "INSERT INTO notifications (`message`, userID, `status`) VALUES ('$message', '$userID', 'Unread')";
        $result = mysqli_query($connect, $messageQuery);

        if($result) {
            echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully',
                            text: 'Order has been successfully updated',
                            customClass: {
                                title: 'swal-custom-font',
                                popup: 'swal-custom-font',
                                confirmButton: 'swal-custom-font'
                            }
                        }).then((result) => {
                            if(result.isConfirmed) {
                                window.location.href = '../manage_orders.php';
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
                            text: 'Can't edit this order, please try again',
                            customClass: {
                                    title: 'swal-custom-font',
                                    popup: 'swal-custom-font',
                                    confirmButton: 'swal-custom-font'
                            }
                            }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = '../manage_orders.php';
                                    }
                                });
                            });
                    </script>";
        }
    }

?>