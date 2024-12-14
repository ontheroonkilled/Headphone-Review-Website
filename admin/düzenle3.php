<?php
require "../sql.php";

if (isset($_POST['guncelle'])) {
    $duzen_id = $_POST['id'];
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    $resim_yolu = '';

    if (isset($_FILES['resim']) && $_FILES['resim']['error'] == 0) {
        $resim = $_FILES['resim']['name'];
        $resim_tmp = $_FILES['resim']['tmp_name'];
        $uploads_dizini = "../image/";


        if (!file_exists($uploads_dizini)) {
            mkdir($uploads_dizini, 0777, true);
        }

        $resim_yolu = $uploads_dizini . basename($resim);


        if (!move_uploaded_file($resim_tmp, $resim_yolu)) {
            echo "Resim yüklenirken bir hata oluştu.";
            $resim_yolu = '';
        }
    }

    $zaman = date("Y-m-d H:i:s");
    if (!empty($resim_yolu)) {
        $sql = $baglan->prepare("UPDATE hakkimda SET baslik = ?, icerik = ?, resim = ?, zaman = ? WHERE id = ?");
        $sql->bind_param("ssssi", $baslik, $icerik, $resim_yolu, $zaman, $duzen_id);
    } else {
        $sql = $baglan->prepare("UPDATE hakkimda SET baslik = ?, icerik = ?, zaman = ? WHERE id = ?");
        $sql->bind_param("sssi", $baslik, $icerik, $zaman, $duzen_id);
    }

    if ($sql->execute()) {
        header("Location: hakkimda_admin.php");
        exit();
    } else {
        echo "Veri güncellenirken hata oluştu: " . $sql->error;
    }

    $sql->close();
} else {
    $id = $_GET['id'];
}

$sql = "SELECT * FROM hakkimda WHERE `id`=$id;";
$sonuc = $baglan->query($sql);
if (!$sonuc) {
    exit($baglan->error);
} else {
    $guncelle = $sonuc->fetch_assoc();
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Hakkımızda Düzenle</title>
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
                <h1>Hakkımızda Düzenle</h1>
            </header>
            <form method="post" action="<?=$_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <div class="fields">
                    <div class="field">
                        <label for="baslik">Başlık</label>
                        <input type="text" name="baslik" id="baslik" value="<?=$guncelle['baslik']; ?>" required />
                    </div>
                    <div class="field">
                        <label for="icerik">İçerik</label>
                        <textarea name="icerik" id="icerik" rows="6" required><?=$guncelle['icerik']; ?></textarea>
                    </div>
                    <div class="field">
                        <label for="resim">Resim Yükle</label>
                        <input type="file" name="resim" id="resim" />
                        <?php if(!empty($guncelle['resim'])): ?>
                            <img src="<?=$guncelle['resim']; ?>" alt="Mevcut Resim" width="100" />
                            <p>Mevcut Resim</p>
                        <?php endif; ?>
                    </div>
                    <input type="hidden" name="id" value="<?=$guncelle['id']; ?>" />
                </div>
                <ul class="actions">
                    <li><input type="submit" name="guncelle" value="Güncelle" /></li>
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
