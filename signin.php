<?php
    session_start();
    if(isset($_SESSION['role'])) {
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include_once "navbar.php"; ?>
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col col-md-1 col-lg-2">

            </div>
            <div class="col-12 col-md-1 col-lg-8">
                <h4 class="text-center mb-4">Sign In Form</h4>
                <div class="card">
                    <div class="card-body">
                        <form action="php/signinsystem.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 mb-2"><input type="submit" value="Sing In" class="btn btn-success w-100"></div>
                                <div class="col-12 col-md-6 col-lg-6 mb-2"><input type="reset" value="Cancel" class="btn btn-danger w-100"></div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        if you don't have a account, please <a href="register.php">click here</a>
                    </div>
                </div>
            </div>
            <div class="col col-md-1 col-lg-2">

            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <?php include_once "footer.php"; ?>
</body>
</html>