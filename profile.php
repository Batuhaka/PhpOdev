<?php
session_start(); // Oturumu başlat

include "config.php";

// Oturum kontrolü yap
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Oturum açılmamışsa giriş sayfasına yönlendir
    exit;
}

// Kullanıcı ID'sini alma
if (isset($_GET['user_id'])) {
    $userID = $_GET['user_id'];
    
    // Kullanıcıyı veritabanından çekme
    $query = mysqli_query($baglan, "SELECT * FROM users WHERE id = '$userID'");
    $user = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kullanıcı Profili</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .profile-container h2 {
            color: #333;
        }
        .profile-container p {
            margin-bottom: 10px;
        }
        .profile-container strong {
            font-weight: bold;
        }
        .profile-container a {
            text-decoration: none;
            color: #4CAF50;
        }
        .profile-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Kullanıcı Profili</h1>
        <?php if ($user): ?>
            <h2><?php echo $user['name'] . ' ' . $user['surname']; ?></h2>
            <p><strong>E-posta:</strong> <?php echo $user["email"]; ?></p>
            <p><strong>Yaş:</strong> <?php echo $user["age"]; ?></p>
            <p><strong>İngilizce Seviyesi:</strong> <?php echo $user["level"]; ?></p>
            <p><strong>Kendini Tanıtma:</strong> <?php echo $user["info"]; ?></p>

           

        <?php else: ?>
            <p>Kullanıcı bulunamadı.</p>
        <?php endif; ?>
        <p><a href="index.php">Ana Sayfa</a></p>
    </div>
</body>
</html>
