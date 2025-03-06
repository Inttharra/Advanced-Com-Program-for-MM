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
    <title>Register</title>
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
                <h4 class="text-center mb-4">Register Form</h4>
                <div class="card">
                    <div class="card-body">
                        <form action="php/registersystem.php" method="post">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" name="password" id="password" class="form-control" required>
                            </div>
                        <?php if(isset($_SESSION['role'])) {
                            if($_SESSION['role'] == "admin") { ?>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role of user</label>
                            <select name="role" id="role" required class="form-select">
                                <option value="users" selected>User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <?php } else {  ?>

                        <?php } } ?>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 mb-2"><input type="submit" value="Register" class="btn btn-success w-100"></div>
                                <div class="col-12 col-md-6 col-lg-6 mb-2"><input type="reset" value="Cancel" class="btn btn-danger w-100"></div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        if you have a account already, please <a href="signin.php">click here</a>
                    </div>
                </div>
            </div>
            <div class="col col-md-1 col-lg-2">

            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
</body>
</html>