<?php

function veriGoruntule($baglan, $offset, $limit) {
    $sql = "SELECT id, baslik, icerik, resim, zaman FROM kulakliklar ORDER BY id ASC LIMIT ?, ?";
    $sql = $baglan->prepare($sql);
    $sql->bind_param("ii", $offset, $limit);
    $sql->execute();
    $sonuc = $sql->get_result();

    if ($sonuc->num_rows > 0) {
        while ($satir = $sonuc->fetch_assoc()) {
            $resimYolu = !empty($satir['resim']) ? 'images/' . $satir['resim'] : 'assets/images/default.jpg';

            echo "<article>
                    <header>
                        <span class='date'>{$satir['zaman']}</span>
                        <h2><a>{$satir['baslik']}</a></h2>
                    </header>
                    <a class='image fit'><img src='{$resimYolu}' alt='{$satir['baslik']}' /></a>
                    <p>{$satir['icerik']}</p>
                    <ul class='actions special'>
                    </ul>
                  </article>";
        }
    } else {
        echo "<p>Veri bulunamadı</p>";
    }

    $sql->close();
}

function sayfaSayisi($baglan, $limit) {
    $sql = "SELECT COUNT(*) AS toplam FROM kulakliklar";
    $sonuc = $baglan->query($sql);
    $satir = $sonuc->fetch_assoc();
    $toplamKayit = $satir['toplam'];
    return ceil($toplamKayit / $limit);
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
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Odyofilizm</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">

<div id="wrapper" class="fade-in">

    <div id="intro">
        <h1>Odyofilizm</h1>
        <p>Türkçe Odyofili Kulaklık İncelemelerinin Tek Adresi</p>
        <ul class="actions">
            <li><a href="#header" class="button icon solid solo fa-arrow-down scrolly">Continue</a></li>
        </ul>
    </div>

    <header id="header">
        <a href="index.php" class="logo">Odyofilizm</a>
    </header>

    <nav id="nav">
        <ul class="links">
            <li class="active"><a href="index.php">Odyofilizm</a></li>
            <li><a href="hakkımızda.php">Hakkımızda</a></li>
            <li><a href="admin/görüntüle.php">Admin Giriş</a></li>
        </ul>
        <ul class="icons">
            <li><a href="https://steamcommunity.com/profiles/76561198312714440" class="icon brands fa-steam"><span class="label">Steam</span></a></li>
            <li><a href="https://www.odyofilizm.com" class="icon brands fa-wordpress"><span class="label">WordPress</span></a></li>
            <li><a href="https://www.instagram.com/shuichi_tatsuo/" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
        </ul>
    </nav>

    <div id="main">
        <!-- Featured Post -->
        <section class="posts">
            <?php
            include "sql.php";

            $limit = 4;
            $sayfa = isset($_GET['sayfa']) ? (int)$_GET['sayfa'] : 1;
            $offset = ($sayfa - 1) * $limit;

            veriGoruntule($baglan, $offset, $limit);
            ?>
        </section>
        <!-- Footer -->
        <footer>
            <div class="pagination">
                <?php
                $toplamSayfa = sayfaSayisi($baglan, $limit);

                if ($sayfa > 1): ?>
                    <a href="?sayfa=1" class="first">Baş</a>
                    <a href="?sayfa=<?=$sayfa - 1?>" class="previous">Önceki</a>
                <?php endif;

                for ($i = 1; $i <= $toplamSayfa; $i++):
                    if ($i == $sayfa): ?>
                        <a href="?sayfa=<?=$i?>" class="page active"><?=$i?></a>
                    <?php else: ?>
                        <a href="?sayfa=<?=$i?>" class="page"><?=$i?></a>
                    <?php endif;
                endfor;

                if ($sayfa < $toplamSayfa): ?>
                    <a href="?sayfa=<?=$sayfa + 1?>" class="next">Sonraki</a>
                    <a href="?sayfa=<?=$toplamSayfa?>" class="last">Son</a>
                <?php endif; ?>
            </div>
        </footer>
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