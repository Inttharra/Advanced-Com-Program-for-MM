<?php
    require_once "php/config.php";
    session_start();

    if(isset($_SESSION['role'])) {
        if($_SESSION['role'] !== "admin") {
            header("location= index.php");
        }
    }

    $message = "SELECT * FROM notificationAdmin LEFT JOIN users ON notificationAdmin.userID = users.user_id";
    $adminName = "SELECT * FROM notificationAdmin LEFT JOIN users ON notificationAdmin.adminIDRead = users.user_id";
    $resultAdminName = mysqli_query($connect, $adminName);
    $result = mysqli_query($connect, $message);

    if(isset($_POST['readStatus'])) {
        $status = $_POST['status'];
        $adminID = $_SESSION['id'];
        $notiID = $_POST['messageID'];

        $read = "UPDATE notificationAdmin 
                SET `status` = '$status', `adminIDRead` = '$adminID' 
                WHERE `messageID` = '$notiID' ";
        $resultRead = mysqli_query($connect, $read);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php"; ?>
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col col-md-1 col-lg-1">

            </div>
            <div class="col-12 col-md-1 col-lg-10">
                <div class="mt-3 mb-5 text-center">
                    <h2>Notifications</h2>
                </div>
                <?php
                    if(mysqli_num_rows($result) == 0) {
                ?>
                <div class="text-center">
                    <img src="material/non-notification.png" width="100px" height="100px" class="mb-2">
                    <p class="fs-5 mt-2">Don’t have any new notifications.</p>
                </div>
                <?php } else { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Message</td>
                                <td style="width: 200px;">Create Time</td>
                                <td style="width: 200px;">Update Time</td>
                                <td style="width: 150px;">Information</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $name = mysqli_fetch_assoc($resultAdminName);
                            while($noti = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $noti['text']; ?></td>
                                <td><?= $noti['createTime']; ?></td>
                                <td><?= $noti['updateTime']; ?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $noti['messageID']; ?>">
                                        Information
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="<?= $noti['messageID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Information</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Message : <?= $noti['text']; ?></p>
                                            <p>From : <?= $noti['firstname']; ?> <?= $noti['lastname']; ?></p>
                                            <form action="notiAdmin.php" method="post">
                                                <input type="hidden" name="messageID" value="<?= $noti['messageID']; ?>">
                                                <input type="hidden" name="adminID" value="<?= $_SESSION['id'];?>">
                                                <label for="makeAsread" class="form-label">Mask As read</label>
                                                <?php if($noti['status'] == "Unread") { ?>
                                                <select name="status" class="form-select">
                                                
                                                        <option value="<?= $noti['status'] ?>"><?= $noti['status'] ?></option>
                                                        <option value="Read">Read</option>
                                                </select>
                                                <?php } else { ?>
                                                    <select class="form-select" disabled>
                                                        <option><?= $noti['status']; ?></option>
                                                    </select>
                                                <?php } ?>
                                                <?php if($noti['adminIDRead'] != 0) { ?>
                                                    <p class="mt-2"> Read by : <?= $name['firstname']; ?> <?= $name['lastname'];?> </p>
                                                <?php } ?>
                                        </div>
                                        <div class="modal-footer">
                                            <?php if($noti['status'] == "Read") { ?>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <?php } else { ?>
                                                <input type="submit" value="Save changes" class="btn btn-primary" name="readStatus">
                                            <?php } ?>
                                        </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
            <div class="col col-md-1 col-lg-1">

            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <?php include_once "footer.php"; ?>
</body>
</html>