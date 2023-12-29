<?php
session_start();

include('includes/config.php');

if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];

    $sql = mysqli_query($con, "SELECT id, username, upassword, email, kategori FROM tbl_user WHERE (username='$uname' AND upassword='$password')");
    $num = mysqli_fetch_array($sql);

    if ($num) {
        $_SESSION['user_id'] = $num['id'];
        $_SESSION['username'] = $num['username'];
        $_SESSION['kategori'] = $num['kategori'];

        header("Location: beranda.php");
        exit();
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="assets/css/style.css" type="text/css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Login</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter your username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter your password">
                        </div>
                        <button type="submit" class="btn btn-block" name="login">Login</button>
                        <a href="register.php">belum punya akun</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>