<?php
include '../sql.php';
session_start();

$kullanici_adi_error = "";
$sifre_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullanici_adi = $baglan->real_escape_string($_POST['kullanici_adi']);
    $sifre = $_POST['sifre'];

    $sql = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$kullanici_adi'";
    $result = $baglan->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($sifre, $user['sifre'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['timeout'] = time();
            setcookie(session_name(), session_id(), time() + 300, "/");
            header("Location: görüntüle.php");
            exit();
        } else {
            $sifre_error = "Hatalı şifre!";
        }
    } else {
        $kullanici_adi_error = "Kullanıcı bulunamadı!";
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Admin Login - Massively by HTML5 UP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <a href="../index.php" class="logo">Odyofilizm Yönetici</a>
    </header>

    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <section class="post">
            <header class="major">
                <h1>Admin Girişi</h1>
            </header>
            <!-- Login Form -->
            <form method="post" action="login.php">
                <div class="fields">
                    <div class="field">
                        <label for="kullanici_adi">Kullanıcı Adı</label>
                        <input type="text" name="kullanici_adi" id="kullanici_adi" required />
                        <span style="color:red;"><?php echo $kullanici_adi_error; ?></span>
                    </div>
                    <div class="field">
                        <label for="sifre">Şifre</label>
                        <input type="password" name="sifre" id="sifre" required />
                        <span style="color:red;"><?php echo $sifre_error; ?></span>
                    </div>
                </div>
                <ul class="actions">
                    <li><input type="submit" value="Giriş Yap" class="primary" /></li>
                </ul>
            </form>
        </section>
    </div>

    <!-- Footer -->
    <div id="copyright">
        <ul><li>Odyofilizm &copy; 2024</li><li>Design: <a>Berat Beşgül</a></li></ul>
    </div>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
