<?php
session_start();

include('includes/config.php');

$username = $_SESSION['username'];
$query = "SELECT kategori FROM tbl_user WHERE username = '$username'";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $kategori = $row['kategori'];
} else {
    $kategori = "Unknown Category";
}

$kategoriString = explode(" ", $kategori);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Kita V1</title>
    <link href="assets/css/style.css" type="text/css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('includes/header.php');



    $feedUrls = [];
        for ($i = 0; $i < count($kategoriString); $i++) {
            if ($kategoriString[$i] === "politik") {
                $feedUrls[] = "https://www.antaranews.com/rss/politik.xml";
            } elseif ($kategoriString[$i] === "olahraga") {
                $feedUrls[] = "https://www.antaranews.com/rss/olahraga.xml";
            } elseif ($kategoriString[$i] === "agama") {
                $feedUrls[] = "https://sumbar.kemenag.go.id/v2/rss/posts";
            } elseif ($kategoriString[$i] === "teknologi") {
                $feedUrls[] = "https://www.antaranews.com/rss/tekno.xml";
            } elseif ($kategoriString[$i] === "hiburan") {
                $feedUrls[] = "https://www.antaranews.com/rss/hiburan.xml";
            }
        }

    echo "<div class='container'>";

    foreach ($feedUrls as $url) {
        $feed = simplexml_load_file($url);

        if ($feed) {
            foreach ($feed->channel->item as $item) {
                echo "<div class='item'>";
                echo "<a href='" . $item->link . "' target='_blank'><h2>" . $item->title . "</h2></a>";
                echo "<div class='desc'>" . $item->description . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Invalid Feed Link: $url</p>";
        }
    }

    echo "</div>";
    ?>
</body>
</html>
