<?php
session_start();
if (!isset($_SESSION['loggedin']) || (time() - $_SESSION['timeout']) > 300) {
    session_unset();
    session_destroy();
    setcookie("PHPSESSID", "", time() - 3600, "/");
    header("Location: login.php");
    exit();
}
$_SESSION['timeout'] = time();

include("../sql.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Veri Görüntüleme - Massively</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
<div id="wrapper">
    <header id="header">
        <a href="../index.php" class="logo">Odyofilizm Yönetici</a>
    </header>
    <nav id="nav">
        <ul class="links">
            <li><a href="görüntüle.php">Konular</a></li>
            <li><a href="ekle.php">Konu Ekle</a></li>
            <li><a href="mail-num.php">Mail ve Numara</a></li>
            <li><a href="hakkimda_admin.php">Hakkımızda</a></li>
        </ul>
    </nav>
    <div id="main">
        <section class="post">
            <header class="major">
                <h1>Konular</h1>
            </header>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Başlık</th>
                    <th>İçerik</th>
                    <th>Resim</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>

                <?php

                require "../sql.php";

                function veriGoruntule($baglan) {
                    $sql = "SELECT id, baslik, icerik, resim FROM kulakliklar";
                    $sonuc = $baglan->query($sql);

                    $toplamVeri = 0;
                    $toplamIcerikUzunlugu = 0;

                    if ($sonuc->num_rows > 0) {
                        while($satir = $sonuc->fetch_assoc()) {
                            $icerikGosterim = strlen($satir["icerik"]) > 150 ? substr($satir["icerik"], 0, 150) . '...' : $satir["icerik"];

                            echo "<tr>
                                <td>" . $satir["id"]. "</td>
                                <td>" . $satir["baslik"]. "</td>
                                <td>" . $icerikGosterim . "</td>";
                            echo "<td>";
                            if (!empty($satir["resim"])) {
                                echo "<img src='" . $satir["resim"] . "' alt='" . $satir["baslik"] . "' width='100'>";
                            } else {
                                echo "Resim yok";
                            }
                            echo "</td>";
                            echo "<td>
                                <a href='düzenle.php?id=" . $satir["id"] . "'>Düzenle</a> | 
                                <a href='sil.php?id=" . $satir["id"] . "' onclick='return confirm(\"Bu veriyi silmek istediğinize emin misiniz?\")'>Sil</a>
                                </td>";
                            echo "</tr>";

                            $toplamVeri++;
                            $toplamIcerikUzunlugu += strlen($satir["icerik"]);
                        }
                    } else {
                        echo "<tr><td colspan='5'>Veri bulunamadı</td></tr>";
                    }

                    return array($toplamVeri, $toplamIcerikUzunlugu);
                }

                list($toplamVeri, $toplamIcerikUzunlugu) = veriGoruntule($baglan);

                $baglan->close();
                ?>
                </tbody>
            </table>
            <?php
            echo "<p>Konu Sayısı: " . $toplamVeri . "</p>";
            echo "<p>Toplam içerik uzunluğu: " . $toplamIcerikUzunlugu . "</p>";
            ?>
        </section>
    </div>
    <div id="copyright">
        <ul><li>Odyofilizm &copy; 2024</li><li>Design: <a>Berat Beşgül</a></li></ul>
    </div>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>
