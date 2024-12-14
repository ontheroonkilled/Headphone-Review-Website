<?php
require "../sql.php";

if (isset($_POST['guncelle'])) {
    $duzen_id = $_POST['id'];
    $mail = $_POST['mail'];
    $numara = $_POST['numara'];
    $adres = $_POST['adres'];

    $guncelleme = "UPDATE kisisel2 SET `mail`='$mail', `numara`='$numara', `adres`='$adres' WHERE id=$duzen_id;";
    $sonuc = $baglan->query($guncelleme);
    if (!$sonuc) {
        echo $baglan->error;
    } else {
        echo "Güncellendi";
        header("Location: mail-num.php");
        exit();
    }
} else {
    $id = $_GET['id'];
}

$sql = "SELECT * FROM kisisel2 WHERE `id`=$id;";
$sonuc = $baglan->query($sql);
if (!$sonuc) {
    exit($baglan->error);
} else {
    $guncelle = $sonuc->fetch_assoc();
}
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Mail-Numara Düzenle</title>
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
                <h1>Mail-Numara Düzenle</h1>
            </header>
            <form method="post" action="<?=$_SERVER['PHP_SELF']; ?>">
                <div class="fields">
                    <div class="field">
                        <label for="mail">Mail</label>
                        <input type="text" name="mail" id="mail" value="<?=$guncelle['mail']; ?>" />
                    </div>
                    <div class="field">
                        <label for="numara">Numara (En fazla 14 karakter)</label>
                        <input type="text" name="numara" id="numara" value="<?=$guncelle['numara']; ?>" />
                    </div>
                    <div class="field">
                        <label for="adres">Adres</label>
                        <input type="text" name="adres" id="adres" value="<?=$guncelle['adres']; ?>" />
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
