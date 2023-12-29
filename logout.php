<?php
session_start();

// Hancurkan semua sesi
session_destroy();

// Redirect ke halaman login setelah logout
header("Location: login.php");
exit();
?>