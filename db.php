<?php
session_start();
set_time_limit(0);

$sunucu="localhost";
$kullanici="root";
$sifre="";
$veritabani="twitterbot";
/*
$sunucu="192.168.94.163";
$kullanici="user009034";
$sifre="Rad0re???";
$veritabani="db009034";
*/
$link = mysql_connect($sunucu, $kullanici, $sifre);
if (@!$link){
    $mesaj="Veritabanı bağlantısı yapılamadı!<br>";
    $mesaj.="Hata açıklaması: ".mysql_error();
    die($mesaj);
}

if(@!mysql_select_db($veritabani)){
    $mesaj="$veritabani veritabanı seçilemedi!<br>";
    $mesaj.="Hata açıklaması: ".mysql_error();
    die($mesaj);

}
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");

?>