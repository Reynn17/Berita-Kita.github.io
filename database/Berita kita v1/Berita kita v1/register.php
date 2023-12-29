<?php
include('includes/config.php');

function register($username, $password, $email, $kategori) {
    global $con;

    $stmt = $con->prepare("INSERT INTO tbl_user (username, upassword, email, kategori) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $email, $kategori);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $kat = " ";
    if($_POST["kategori"] != NULL){
        $kat = $_POST["kategori"];
        $kategori = implode(" ", $kat);
    }else{
        $kategori = "politik olahraga agama teknologi hiburan";
    }

    register($username, $password, $email, $kategori);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="assets/css/style.css" type="text/css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Register</h3>
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
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="categories">Kategori:</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="kategori[]" value="politik" id="politik">
                                <label class="form-check-label" for="politik">Politik</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="kategori[]" value="olahraga" id="olahraga">
                                <label class="form-check-label" for="olahraga">Olahraga</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="kategori[]" value="agama" id="agama">
                                <label class="form-check-label" for="agama">Agama</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="kategori[]" value="teknologi" id="teknologi">
                                <label class="form-check-label" for="teknologi">Teknologi</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="kategori[]" value="hiburan" id="hiburan">
                                <label class="form-check-label" for="hiburan">Hiburan</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block">Register</button>
                    </form>
                    <a href="login.php">Sudah punya akun</a>
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
