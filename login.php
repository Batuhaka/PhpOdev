<?php
session_start(); // Oturumu başlat

include "config.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $form_username = $_POST["username"];
    $form_password = $_POST["password"];

    $form_password_hash = hash("sha256", $form_password);

    $q = mysqli_query($baglan, "SELECT * FROM users WHERE `username`='$form_username' AND `password`='$form_password_hash'");
    $num = mysqli_num_rows($q);

    if ($num == 0) {
        echo "Böyle bir kullanıcı bulunamadı! Şifrenizi kontrol ediniz.";
    } else if ($num == 1) {
        $user = mysqli_fetch_assoc($q);
        $_SESSION['user_id'] = $user['id']; // Kullanıcı kimliğini oturum değişkenine kaydet
        $_SESSION['username'] = $user['username']; // Kullanıcı adını oturum değişkenine kaydet
        header("Location: index.php"); 
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>
    <style>
        form {
            width: 300px;
            margin: 0 auto;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .register-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
        .homepage-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
     <h1><center>Giris Yap</center></h1>
    <form action="login.php" method="POST">
        <label for="username">Kullanıcı adı:</label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password">
        <br>
        <button type="submit">Giriş Yap!</button>
    </form>
    <a href="register.php" class="register-link">Hesabın yoksa kayıt ol</a>
    <a href="index.php" class="homepage-link">Ana Sayfa</a>
</body>
</html>