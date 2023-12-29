<?php
include('includes/config.php');

// Fungsi untuk menyimpan data registrasi ke database
function register($username, $password, $email, $kategori) {
    global $con;

    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $con->prepare("INSERT INTO tbl_user (username, upassword, email, kategori) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $email, $kategori);

    if ($stmt->execute()) {
        // Jika registrasi berhasil, redirect ke halaman login
        header("Location: login.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Ambil kategori yang dipilih
    $kategori = implode(" ", $_POST["kategori"]);

    // Panggil fungsi register
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
    <!-- Link Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
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
                        <!-- Tambahkan atribut name pada input agar dapat diakses saat form disubmit -->
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
                            <!-- Tambahkan lebih banyak kategori jika diperlukan -->
                        </div>
                        <button type="submit" class="btn btn-block">Register</button>
                    </form>
                    <a href="login.php">Sudah punya akun</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Link Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
