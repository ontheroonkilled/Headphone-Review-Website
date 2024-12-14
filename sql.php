<?php
$baglan = new mysqli("localhost", "root", "", "kulaklik_site");
$baglan->set_charset("utf8");

if ($baglan->connect_error)
{
    exit("Veritabanı bağlantı hatası: " . $baglan->connect_error);
}
else
{

}
?>