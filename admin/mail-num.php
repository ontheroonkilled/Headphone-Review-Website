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
                <h1>Mail ve Numara</h1>
            </header>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Mail</th>
                    <th>Numara</th>
                    <th>Adres</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>

                <?php

                require "../sql.php";

                function veriGoruntule($baglan) {
                    $sql = "SELECT id, mail, numara, adres FROM kisisel2";
                    $sonuc = $baglan->query($sql);

                    if ($sonuc->num_rows > 0) {
                        while($satir = $sonuc->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $satir["id"]. "</td>
                                <td>" . $satir["mail"]. "</td>
                                <td>" . $satir["numara"]. "</td>
                                <td>" . $satir["adres"]. "</td>
                                <td><a href='düzenle2.php?id=" . $satir["id"] . "'>Düzenle</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Veri bulunamadı</td></tr>";
                    }

                }

                veriGoruntule($baglan);

                $baglan->close();
                ?>
                </tbody>
            </table>
        </section>
    </div>
    <div id="copyright">
        <ul><li>Odyofilizm &copy; 2024</li><li>Design: <a>Berat Beşgül</a></li></ul>
    </div>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>
