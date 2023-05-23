<?php
include "config.php";
if (isset($_POST["username"])) {
    $form_username = $_POST["username"];
    $form_password = $_POST["password"];
    $form_email = $_POST["email"];

    $form_password_hash = hash("sha256", $form_password);

    $rt = mysqli_query($baglan, "INSERT INTO `users` (`username`, `password`, `email`) VALUES ('" . $form_username . "', '" . $form_password_hash . "', '" . $form_email . "')");

    if (mysqli_errno($baglan) != 0) {
        echo "Bir hata meydana geldi!";
        exit;
    }

    echo "Kullanıcı kaydınız başarılı!<br>";
    echo "Giriş yapmak için <a href='login.php'>tıklayınız</a>";
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Kayıt Ol</title>
        <style>
            form {
                width: 300px;
                margin: 0 auto;
            }
            input[type="text"],
            input[type="password"],
            input[type="email"] {
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
            .login-link {
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
        <h1><center>Kayıt Ol</center></h1>
        <form action="register.php" method="POST">
            <label for="username">Kullanıcı adı:</label>
            <input type="text" id="username" name="username">
            <br>
            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password">
            <br>
            <label for="email">E-posta:</label>
            <input type="email" id="email" name="email">
            <br>
            <button type="submit">Kayıt Ol!</button>
        </form>
        <a href="login.php" class="login-link">Zaten kayıtlıysan giriş yap</a>
        <a href="index.php" class="homepage-link">Ana Sayfa</a>
    </body>
    </html>
    <?php
}
?>
