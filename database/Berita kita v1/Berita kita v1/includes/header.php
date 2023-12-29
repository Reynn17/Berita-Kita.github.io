<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><h4>Berita Kita V1</h4></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
            <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link" style="color:aliceblue;" href="akun.php"><?php echo $_SESSION['username']; ?></a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link" style="color:aliceblue;" href="akun.php">Akun</a>
                </li>            
                <li class="nav-item">
                    <a class="nav-link" style="color:aliceblue;" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>