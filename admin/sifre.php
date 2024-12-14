<?php
include '../sql.php';

$kullanici_adi = "yonetici";
$sifre = password_hash("123", PASSWORD_DEFAULT);

$sql = $baglan->prepare("INSERT INTO kullanicilar (kullanici_adi, sifre) VALUES (?, ?)");
$sql->bind_param("ss", $kullanici_adi, $sifre);

if ($sql->execute()) {
    echo "Kullanıcı başarıyla oluşturuldu.";
} else {
    echo "Hata: " . $sql->error;
}

$sql->close();
$baglan->close();
?>
