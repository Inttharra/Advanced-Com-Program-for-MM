<?php
    require_once "php/config.php";
    session_start();

    if (!isset($_SESSION['role'])) {
        header("location: index.php");
        exit();
    }

    $id = $_SESSION['id'];

    // ดึงข้อมูลออเดอร์ของผู้ใช้
    $selectOrder = "SELECT `time`, itemID, `name`, qty, Coffee, price, `status` 
                    FROM orders 
                    JOIN goods ON orders.itemID = goods.goods_id 
                    WHERE userID = '$id' 
                    ORDER BY `time` ASC";
    $result = mysqli_query($connect, $selectOrder);

    // จัดกลุ่มข้อมูลตามเวลา
    $orders = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $time = $row['time'];

        if (!isset($orders[$time])) {
            $orders[$time] = [
                'items' => [],
                'total' => 0,
                'hasCoffee' => false,
                'hasDessert' => false
            ];
        }

        // ตรวจสอบว่าในออเดอร์มี coffee, non-coffee, หรือ dessert ไหม
        if ($row['Coffee'] == 'yes' || $row['Coffee'] == 'no') {
            $orders[$time]['hasCoffee'] = true;
        } elseif ($row['Coffee'] == 'des') {
            $orders[$time]['hasDessert'] = true;
        }

        // คำนวณราคารวม
        $row['total_price'] = $row['price'] * $row['qty'];
        $orders[$time]['total'] += $row['total_price'];
        $orders[$time]['items'][] = $row;
    }

    function nameOfStatus($status) {
        if($status == "processing"){
            $name = "Processing";
        } elseif ($status == "Ready") {
            $name = "Ready for pickup";
        } else {
            $name = "Completed";
        }
        return $name;
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Orders</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include_once "navbar.php"; ?>
    <div class="container my-4">
        <h2 class="text-center mb-4"><?= $_SESSION['firstname']; ?>'s Orders</h2>

        <?php if (empty($orders)) { ?>
            <div class="text-center my-4">
                <img src="material/coffee.png" class="mx-auto d-block mb-3" width="100px" height="100px">
                <p class="fs-4">Looks like you haven’t ordered anything yet.</p>
                <a href="menu.php">Let’s fix that—order now!</a>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $time => $order) {
                            // ตรวจสอบเงื่อนไขส่วนลด
                            $discount = 0;
                            if ($order['hasCoffee'] && $order['hasDessert']) {
                                $discount = $order['total'] * 0.1;
                            }

                            $finalTotal = $order['total'] - $discount;
                        ?>
                        <tr class="table-secondary fw-bold">
                            <td colspan="5"><?= date('Y-m-d H:i:s', strtotime($time)); ?></td>
                        </tr>
                        <?php foreach ($order['items'] as $item) { ?>
                        <tr>
                            <td></td>
                            <td><?= $item['name']; ?></td>
                            <td><?= $item['qty']; ?></td>
                            <td><?= number_format($item['total_price'], 2); ?> ฿</td>
                            <td><?= $name=nameOfStatus($item['status']); ?></td>
                        </tr>
                        <?php } ?>

                        <!-- แสดง Subtotal เสมอ -->
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Subtotal:</td>
                            <td><?= number_format($order['total'], 2); ?> ฿</td>
                            <td></td>
                        </tr>

                        <!-- แสดง Discount ถ้ามีเงื่อนไขลดราคา -->
                        <?php if ($discount > 0) { ?>
                        <tr class="text-success">
                            <td colspan="3" class="text-end">Discount 10%:</td>
                            <td>-<?= number_format($discount, 2); ?> ฿</td>
                            <td></td>
                        </tr>
                        <?php } ?>

                        <!-- แสดง Total เสมอ -->
                        <tr class="fw-bold text-primary">
                            <td colspan="3" class="text-end">Total:</td>
                            <td><?= number_format($finalTotal, 2); ?> ฿</td>
                            <td></td>
                        </tr>
                        <tr><td colspan="5"></td></tr> <!-- เว้นบรรทัด -->
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
    <?php include_once "footer.php"; ?>
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>