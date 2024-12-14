<?php

require "sql.php";

function hakkimizdaGoruntule($baglan) {
    $sql = "SELECT baslik, icerik, resim FROM hakkimda";
    $sonuc = $baglan->query($sql);

    if ($sonuc->num_rows > 0) {
        while ($satir = $sonuc->fetch_assoc()) {
            $resimYolu = !empty($satir['resim']) ? 'images/' . $satir['resim'] : 'assets/images/default.jpg';

            echo "<section class='post'>
                    <header class='major'>
                        <h2>{$satir['baslik']}</h2>
                    </header>
                    <div class='image main'><img src='{$resimYolu}' alt='{$satir['baslik']}' /></div>
                    <p>{$satir['icerik']}</p>
                  </section>";
        }
    } else {
        echo "<p>Veri bulunamadı</p>";
    }

}
function iletisimBilgileriniGoruntule($baglan) {
    $sql = "SELECT mail, numara, adres FROM kisisel2 LIMIT 1";
    $sonuc = $baglan->query($sql);

    if ($sonuc->num_rows > 0) {
        $satir = $sonuc->fetch_assoc();
        echo "<section>
                <h3>Email</h3>
                <p>{$satir['mail']}</p>
              </section>
              <section>
                <h3>Telefon</h3>
                <p>{$satir['numara']}</p>
              </section>
              <section>
                <h3>Adres</h3>
                <p>{$satir['adres']}</p>
              </section>";
    } else {
        echo "<section><p>İletişim bilgileri bulunamadı</p></section>";
    }

    $baglan->close();
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Odyofilizm - Hakkımızda</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">

<div id="wrapper">

    <header id="header">
        <a href="index.php" class="logo">Odyofilizm</a>
    </header>

    <nav id="nav">
        <ul class="links">
            <li><a href="index.php">Odyofilizm</a></li>
            <li class="active"><a href="hakkımızda.php">Hakkımızda</a></li>
            <li><a href="admin/görüntüle.php">Admin Giriş</a></li>
        </ul>
        <ul class="icons">
            <li><a href="https://steamcommunity.com/profiles/76561198312714440" class="icon brands fa-steam"><span class="label">Steam</span></a></li>
            <li><a href="https://www.odyofilizm.com" class="icon brands fa-wordpress"><span class="label">WordPress</span></a></li>
            <li><a href="https://www.instagram.com/shuichi_tatsuo/" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
        </ul>
    </nav>

    <div id="main">
        <?php
        include "sql.php";
        hakkimizdaGoruntule($baglan);
        ?>
    </div>

    <footer id="footer">
        <section class="split contact">
                <?php iletisimBilgileriniGoruntule($baglan); ?>
            <section>
                <h3>Social</h3>
                <ul class="icons alt">
                    <li><a href="https://steamcommunity.com/profiles/76561198312714440" class="icon brands alt fa-steam"><span class="label">Steam</span></a></li>
                    <li><a href="https://www.odyofilizm.com" class="icon brands alt fa-wordpress"><span class="label">WordPress</span></a></li>
                    <li><a href="https://www.instagram.com/shuichi_tatsuo/" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
                </ul>
            </section>
        </section>
    </footer>

    <div id="copyright">
        <ul><li>Odyofilizm &copy; 2024</li><li>Design: <a href="https://html5up.net">HTML5 UP</a></li></ul>
    </div>

</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
