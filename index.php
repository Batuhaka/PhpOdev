<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anasayfa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        .navbar {
            text-align: center;
            margin-bottom: 20px;
        }
        .navbar a {
            margin-right: 10px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #f2f2f2;
        }
        .navbar a:hover {
            background-color: #ccc;
        }
        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
        }
        .welcome-message p {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .welcome-message a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }
        .welcome-message a:hover {
            text-decoration: underline;
        }
        .ilanlar-section {
            margin-bottom: 20px;
        }
        .ilanlar-section h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .ilanlar-table {
            width: 100%;
            border-collapse: collapse;
        }
        .ilanlar-table th,
        .ilanlar-table td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .ilanlar-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .ilanlar-table tr:hover {
            background-color: #f5f5f5;
        }
        .detail-button,
        .delete-button {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        .detail-button {
            background-color: #4CAF50;
        }
        .detail-button:hover {
            background-color: #45a049;
        }
        .delete-button {
            background-color: #f44336;
        }
        .delete-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1>Anasayfa</h1>
    <div class="navbar">
        <?php if (isset($_SESSION['username'])): ?>
            <a href="myprofile.php">Profilim</a>
            <a href="ilanver.php">İlan Ver</a>
        <?php else: ?>
            <a href="login.php">Giriş Yap</a>
            <a href="register.php">Kayıt Ol</a>
        <?php endif; ?>
    </div>

    <div class="welcome-message">
        <?php if (isset($_SESSION['username'])): ?>
            <p>Hoş geldiniz, <?php echo $_SESSION['username']; ?>!</p>
            <p>Bu platformda ilanlarınızı yayınlayabilir ve diğer kullanıcıların ilanlarını inceleyebilirsiniz.</p>
        <?php else: ?>
            <p>Giriş yaparak ilanlarınızı yayınlayabilir veya diğer kullanıcıların ilanlarını inceleyebilirsiniz.</p>
            <p>Hesabınız yoksa hemen <a href="register.php">kayıt olun</a> ve ilanlarınızı paylaşmaya başlayın!</p>
        <?php endif; ?>
    </div>

    <div class="ilanlar-section">
        <h1>İlanlar</h1>
        <?php include "ilanlar.php"; ?>
    </div>
</body>
</html>