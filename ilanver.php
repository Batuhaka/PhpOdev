<?php
session_start(); 

include "config.php";

// Kullanıcıların oturum açmış olduğunu kontrol et
if (isset($_SESSION['user_id'])) {
    $loggedInUserID = $_SESSION['user_id']; // Oturum açmış kullanıcının kimliği
} else {
    $loggedInUserID = null; // Oturum açmış kullanıcı yoksa, ID'yi boş olarak ayarla
}

if (isset($_POST["title"])) {
    $form_title = $_POST["title"];
    $form_exp = $_POST["experince"];

    $rt = mysqli_query($baglan, "INSERT INTO `adverts` (`user_id`, `title`, `experience`) VALUES ('$loggedInUserID', '$form_title', '$form_exp')");

    if (mysqli_errno($baglan) != 0) {
        echo "Bir hata meydana geldi!";
        exit;
    }

    echo "İlan kaydınız başarılı!<br>";
    echo "Ana Sayfaya dönmek için <a href='index.php'>tıklayınız</a>";
} else {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>İlan Ver</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                padding: 20px;
            }
            .container {
                max-width: 400px;
                margin: 0 auto;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 20px;
                margin-top: 30px;
            }
            h1 {
                text-align: center;
                color: #333;
                margin-top: 0;
            }
            form {
                margin-top: 20px;
            }
            label {
                display: block;
                margin-bottom: 10px;
            }
            input[type="text"] {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 3px;
            }
            button[type="submit"] {
                background-color: #4CAF50;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                margin-top: 10px;
            }
            button[type="submit"]:hover {
                background-color: #45a049;
            }
            .back-link {
                display: inline-block;
                margin-top: 10px;
                color: #777;
                text-decoration: none;
            }
            .back-link:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>İlan Ver</h1>
            <form action="ilanver.php" method="POST">
                <label for="title">İş Sıfatınız:</label>
                <input type="text" name="title" id="title">
                <label for="experince">Tecrübeniz:</label>
                <input type="text" name="experince" id="experince">

                <button type="submit">İlan Ver!</button>
            </form>
            <a href="index.php" class="back-link">Ana Menüye Dön</a>
        </div>
    </body>
    </html>

    <?php
}
?>
