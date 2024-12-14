<?php
require "../sql.php";

$id=$_GET['id'];


$sil="DELETE FROM `kulakliklar` WHERE `id`=$id;";
$sonuc = $baglan->query($sil);
if (!$sonuc) { echo $baglan->error; }
else { echo "veri silindi"; }
header("Location: görüntüle.php");
exit;
?>