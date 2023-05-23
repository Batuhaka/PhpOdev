<?php
session_start(); 

// Oturumu sonlandır ve oturum değişkenlerini temizle
session_unset();
session_destroy();

header("Location: index.php"); // Giriş sayfasına yönlendir
exit;
?>
