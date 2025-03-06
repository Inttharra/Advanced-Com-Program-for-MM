<?php
    require_once "php/config.php";
    session_start();
    if ($_SESSION['role'] !== "admin") {
        header("location: index.php");
    }

    // ลบออเดอร์เมื่อคลิกปุ่มลบ
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $deleteQuery = "DELETE FROM orders WHERE orderID = '$id'";
        $result = mysqli_query($connect, $deleteQuery);

        if ($result) {
            echo "<script>alert('This order has been deleted successfully');</script>";
            header("refresh:1; url=manage_orders.php");
        }
    }

    // ดึงข้อมูลออเดอร์
    $query = "SELECT * FROM orders LEFT JOIN goods ON orders.itemID = goods.goods_id ORDER BY orders.time DESC"; 
    $result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include_once "navbar.php" ?>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col col-md-1 col-lg-1"></div>
            <div class="col-12 col-md-10 col-lg-10">
                <h2 class="text-center mb-3">Manage Orders</h2>
                <div class="table-reponsive">
                    <?php
                    $current_datetime = ''; // ใช้เก็บวันและเวลาของออเดอร์ก่อนหน้า
                    while ($menu = mysqli_fetch_assoc($result)) {
                        $order_datetime = date("Y-m-d H:i:s", strtotime($menu['time']));  // ดึงวันที่และเวลา
                        
                        if ($order_datetime !== $current_datetime) {
                            if ($current_datetime !== '') {
                                echo '</tbody></table>';  // ปิดตารางเดิม
                            }
                            echo "<h4 class='mt-3'>Orders for $order_datetime</h4>";  // แสดงวันที่และเวลา
                            echo "<table class='table table-hover'>
                                    <thead>
                                        <tr>
                                            <th style='width: 450px;'>Name</th>
                                            <th>Status</th>
                                            <th style='width: 100px;'>Edit</th>
                                            <th style='width: 100px;'>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            $current_datetime = $order_datetime;
                        }
                    ?>
                    <tr>
                        <td><?= $menu['name']; ?></td>
                        <td><?= $menu['status']; ?></td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#<?= $menu['orderID']; ?>">
                                Edit
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="<?= $menu['orderID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="php/editOrder.php" method="post">
                                                <input type="hidden" name="orderID" value="<?= $menu['orderID'] ?>">
                                                <input type="hidden" name="timeOrder" value="<?= $menu['time'] ?>">
                                                <input type="hidden" name="userIDMessage" value="<?= $menu['userID'];?>">
                                                <input type="hidden" name="nameMenu" value="<?= $menu['name']; ?>">
                                                <div class="mb-3">
                                                    <label for="MenuName" class="form-label">Name</label>
                                                    <input type="text" class="form-control" value="<?= $menu['name']; ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="qty" class="form-label">Quantity</label>
                                                    <input type="text" name="qty" class="form-control" value="<?= $menu['qty']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select name="status" class="form-select">
                                                        <?php if($menu['status'] == "processing") { ?>
                                                            <option value="<?= $menu['status']; ?>" selected><?= $menu['status']; ?></option>
                                                            <option value="Ready">Ready for Pickup</option>
                                                            <option value="Complete">Completed</option>
                                                        <?php } elseif($menu['status'] == "Ready") { ?>
                                                            <option value="<?= $menu['status']; ?>" selected>Ready for Pickup</option>
                                                            <option value="Complete">Completed</option>
                                                            <option value="processing">processing</option>
                                                        <?php } else { ?>
                                                            <option value="<?= $menu['status']; ?>" selected>Completed</option>
                                                            <option value="Ready">Ready for Pickup</option>
                                                            <option value="processing">processing</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="reset" value="Cancel" class="btn btn-danger">
                                            <input type="submit" value="Save Changes" class="btn btn-primary" name="editOrder">
                                        </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><a data-id="<?= $menu['orderID'];?>" href="manage_orders.php?del=<?= $menu['orderID']; ?>" class="btn btn-danger w-100 delete-btn">Delete</a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col col-md-1 col-lg-1"></div>
    </div>
</div>
<?php include_once "footer.php"; ?>
<script src="js/bootstrap.bundle.js"></script>
<script>
    $('.delete-btn').click(function(e) {
        var goodsID = $(this).data('id');
        e.preventDefault();
        deleteConfirm(goodsID);
    });

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
                        url: 'manage_orders.php',
                        type: 'GET',
                        data: 'del=' + goodsID
                    })
                    .done(function() {
                        Swal.fire({
                            title: 'Success',
                            text: 'This order deleted successfully',
                            icon: 'success'
                        }).then(() => {
                            document.location.href = 'manage_orders.php';
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