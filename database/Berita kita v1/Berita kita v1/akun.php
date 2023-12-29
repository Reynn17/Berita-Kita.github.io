<?php
include('includes/config.php');

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kat = " ";
    if($_POST["categories"] != NULL){
        $kat = $_POST["categories"];
        $newCategories = implode(" ", $kat);
    }else{
        $newCategories = "politik olahraga agama teknologi hiburan";
    }

    $username = $_SESSION['username'];
    $updateQuery = "UPDATE tbl_user SET kategori = ? WHERE username = ?";
    
    $stmt = mysqli_prepare($con, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ss", $newCategories, $username);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: beranda.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

$query = "SELECT kategori FROM tbl_user WHERE username = '{$_SESSION['username']}'";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $currentCategories = explode(" ", $row['kategori']);
} else {
    $currentCategories = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - BeritaKita</title>
    <link href="assets/css/style.css" type="text/css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Pengaturan Akun</h1>
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" disabled>
                <small id="usernameHelp" class="form-text text-muted">Username tidak dapat diubah.</small>
            </div>
            <div class="form-group">
                <label for="categories">Kategori:</label>
                <?php
                $allCategories = ["politik", "olahraga", "agama", "teknologi", "hiburan"];

                foreach ($allCategories as $category) {
                    $isChecked = in_array($category, $currentCategories);
                ?>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="<?php echo strtolower($category); ?>" name="categories[]" value="<?php echo $category; ?>" <?php if ($isChecked) echo "checked"; ?>>
                    <label class="form-check-label" for="<?php echo strtolower($category); ?>"><?php echo $category; ?></label>
                </div>
                <?php } ?>
            </div>
            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
    </div>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
