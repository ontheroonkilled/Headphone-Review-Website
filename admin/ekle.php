<?php
require "../sql.php";

if (isset($_POST['ekle'])) {
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    $resim_yolu = '';
    $zaman = date("Y-m-d H:i:s");

    if (isset($_FILES['resim']) && $_FILES['resim']['error'] == 0) {
        $resim = $_FILES['resim']['name'];
        $resim_tmp = $_FILES['resim']['tmp_name'];
        $resim_yolu = "../image/" . basename($resim);


        if (!move_uploaded_file($resim_tmp, $resim_yolu)) {
            echo "Resim yüklenirken bir hata oluştu.";
            $resim_yolu = '';
        }
    }


    $sql = $baglan->prepare("INSERT INTO kulakliklar (baslik, icerik, resim, zaman) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $baslik, $icerik, $resim_yolu, $zaman);

    if ($sql->execute()) {
        header("Location: görüntüle.php");
        exit;
    } else {
        echo $sql->error;
    }

    $sql->close();
}
else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "Veri gönderilmedi.";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Veri Ekleme - Massively</title>
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
                <h1>Konu Ekleme</h1>
            </header>
            <form method="post" action="ekle.php" enctype="multipart/form-data">
                <div class="fields">
                    <div class="field">
                        <label for="baslik">Başlık</label>
                        <input type="text" name="baslik" id="baslik" required />
                    </div>
                    <div class="field">
                        <label for="icerik">İçerik</label>
                        <textarea name="icerik" id="icerik" rows="6" required></textarea>
                    </div>
                    <div class="field">
                        <label for="resim">Resim Yükle</label>
                        <input type="file" name="resim" id="resim" />
                    </div>
                </div>
                <ul class="actions">
                    <li><input type="submit" name="ekle" value="Ekle" /></li>
                </ul>
            </form>
        </section>
    </div>
    <div id="copyright">
        <ul><li>Odyofilizm &copy; 2024</li><li>Design: <a>Berat Beşgül</a></li></ul>
    </div>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>
