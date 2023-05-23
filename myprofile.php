<?php
session_start(); 

include "config.php";

// Oturum kontrolü yap
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Oturum açılmamışsa giriş sayfasına yönlendir
    exit;
}

// Kullanıcının verilerini veritabanından getirme
$userID = $_SESSION['user_id']; // Oturum açmış kullanıcının kimliği
$query = mysqli_query($baglan, "SELECT * FROM users WHERE id = $userID");
$user = mysqli_fetch_assoc($query);

// Doğum tarihinden yaş hesapla
$birthDate = $user["bday"];
$age = date_diff(date_create($birthDate), date_create('today'))->y;

// Yaşı users tablosunda güncelle
mysqli_query($baglan, "UPDATE users SET age = $age WHERE id = $userID");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Sayfası</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }
        h2 {
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-top: 30px;
        }
        p {
            margin-bottom: 10px;
        }
        strong {
            font-weight: bold;
        }
        a {
            text-decoration: none;
            color: #4CAF50;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>Profil Sayfası</h1>
    <div class="container">
        <h2>Kullanıcı Bilgileri</h2>
        <p><strong>Ad:</strong> <?php echo $user["name"]; ?></p>
        <p><strong>Soyad:</strong> <?php echo $user["surname"]; ?></p>
        <p><strong>E-posta:</strong> <?php echo $user["email"]; ?></p>
        <p><strong>Telefon:</strong> <?php echo $user["tnumber"]; ?></p>
        <p><strong>Doğum Tarihi:</strong> <?php echo $user["bday"]; ?></p>
        <p><strong>Yaş:</strong> <?php echo $age; ?></p>
        <p><strong>İngilizce Seviyesi:</strong> <?php echo $user["level"]; ?></p>
        <p><strong>Kendini Tanıtma:</strong> <?php echo $user["info"]; ?></p>
        <a href="index.php">Ana Sayfa</a>
        <a href="update_profile.php">Bilgileri Güncelle</a>
        <a href="logout.php">Çıkış Yap</a>
    </div>
</body>
</html>
