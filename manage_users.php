<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage users</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    require_once "php/config.php";
    session_start();
    if($_SESSION['role'] !== "admin") {
        header("location: index.php");
    }

    if(isset($_GET['del'])) {
        $id = $_GET['del'];
        $deleteQuery = "DELETE FROM users WHERE user_id = '$id'";
        $result = mysqli_query($connect, $deleteQuery);

        if($result) {
            echo "<script>alert('This user has been deleted successfully');</script>";
            header("refresh:1; url=manage_users.php");
        }
    }

    if(isset($_POST['updateUser'])) {
        $userId = $_POST['userId'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $updateQuery = "UPDATE users SET firstname='$firstName', lastname='$lastName', role='$role', username='$username', `password`='$password' WHERE user_id='$userId'";
        $result = mysqli_query($connect, $updateQuery);

        if($result) {
            echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully',
                                text: 'User updated successfully',
                                customClass: {
                                    title: 'swal-custom-font',
                                    popup: 'swal-custom-font',
                                    confirmButton: 'swal-custom-font'
                                }
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.href = 'manage_users.php';
                                    }
                                });
                            });
                    </script>";
        } else {
            echo "<script>alert('Failed to update user');</script>";
        }
    }
?>
</head>
<body>
    <?php include_once "navbar.php" ?>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col col-md-1 col-lg-1">
            
            </div>
            <div class="col-12 col-md-10 col-lg-10">
                <h2 class="text-center mb-3">Manage Users</h2>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Role</th>
                                <th style="width: 100px;">Edit</th>
                                <th style="width: 100px;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM users";
                                $result = mysqli_query($connect, $query);

                                if(mysqli_num_rows($result) >= 1) {
                                    while ($user = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?= $user['firstname']; ?></td>
                                    <td><?= $user['lastname']; ?></td>
                                    <td><?= $user['role']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $user['user_id']; ?>">
                                            Edit
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $user['user_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $user['user_id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel<?= $user['user_id']; ?>">Edit User</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="manage_users.php" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="userId" value="<?= $user['user_id']; ?>">
                                                            <div class="mb-2">
                                                                <label for="firstname" class="form-label">First name</label>
                                                                <input type="text" name="firstName" id="firstname" class="form-control" value="<?= $user['firstname']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="lastname" class="form-label">Last name</label>
                                                                <input type="text" name="lastName" id="lastname" class="form-control" value="<?= $user['lastname']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" name="username" id="username" class="form-control" value="<?= $user['username']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="password" class="form-label">Password</label>
                                                                <input type="text" name="password" id="password" class="form-control" value="<?= $user['password']; ?>" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="role" class="form-label">Role</label>
                                                                <select name="role" id="role" required class="form-select">
                                                                    <option value="<?php echo $user['role'] ?>" selected><?php echo $user['role'] ?></option>
                                                                    <option value="users">User</option>
                                                                    <option value="admin">Admin</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="updateUser" class="btn btn-warning">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="manage_users.php?del=<?= $user['user_id']; ?>" data-id="<?= $user['user_id']; ?>" class="btn btn-danger w-100 delete-btn">Delete</a></td>
                                </tr>
                            <?php 
                                    } 
                                } 
                            ?>
                            <tr>
                                <td colspan="5" align="center"><a href="register.php" class="btn btn-primary w-100">Add user</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col col-md-1 col-lg-1">
                
            </div>
        </div>
    </div>
    <?php include_once "footer.php"; ?>
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
                            url: 'manage_users.php',
                            type: 'GET',
                            data: 'del=' + goodsID
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'Success',
                                text: 'This user deleted successfully',
                                icon: 'success'
                            }).then(() => {
                                document.location.href = 'manage_users.php';
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