<?php

// Veritabanı bağlantısı için gerekli bilgileri içeren config dosyası

$host = "localhost"; // Veritabanı sunucusunun adresi 
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifresi
$database = "veritabanim"; // Veritabanı adı

// Veritabanı bağlantısı oluşturma
$baglan = new mysqli($host, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($baglan->connect_error) {
    die("Veritabanına bağlanılamadı: " . $baglan->connect_error);
}

?>
