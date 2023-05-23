<?php
session_start(); // Oturumu başlat

include "config.php";

// Oturumu kontrol et
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Oturum açılmamışsa giriş sayfasına yönlendir
    exit;
}

// Kullanıcının verilerini veritabanından getirme
$userID = $_SESSION['user_id']; // Oturum açmış kullanıcının kimliği
$query = mysqli_query($baglan, "SELECT * FROM users WHERE id = $userID");
$user = mysqli_fetch_assoc($query);

// Form gönderildiyse güncelleme işlemini yap
if (isset($_POST["name"])) {
    $form_name = $_POST["name"];
    $form_surname = $_POST["surname"];
    $form_email = $_POST["email"];
    $form_tnumber = $_POST["tnumber"];
    $form_bday = $_POST["bday"];
    $form_level = $_POST["level"];
    $form_text = $_POST["info"];

    $query = "UPDATE users SET name = '$form_name', surname = '$form_surname', email = '$form_email', tnumber = '$form_tnumber', bday = '$form_bday', level = '$form_level', info = '$form_text' WHERE id = $userID";
    $result = mysqli_query($baglan, $query);

    if (!$result) {
        echo "Bir hata meydana geldi!";
        exit;
    }

    echo "Bilgileriniz kaydedilmiştir.<br>";
    echo "Profilinize dönmek için <a href='myprofile.php'>tıklayınız</a>";
} else {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Bilgileri Güncelle</title>
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
            form {
                max-width: 400px;
                margin: 0 auto;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 20px;
                margin-top: 30px;
            }
            label {
                display: block;
                margin-bottom: 10px;
            }
            input[type="text"],
            input[type="email"],
            input[type="tel"],
            textarea {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 3px;
            }
            input[type="date"] {
                padding: 6px;
            }
            textarea {
                resize: vertical;
            }
            button[type="submit"] {
                background-color: #4CAF50;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }
            button[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <h1>Bilgileri Güncelle</h1>
        <form action="update_profile.php" method="POST">
            <label for="name">Ad:</label>
            <input type="text" name="name" id="name" value="<?php echo $user["name"]; ?>">
            <label for="surname">Soyad:</label>
            <input type="text" name="surname" id="surname" value="<?php echo $user["surname"]; ?>">
            <label for="email">Eposta:</label>
            <input type="email" name="email" id="email" value="<?php echo $user["email"]; ?>">
            <label for="tnumber">Telefon:</label>
            <input type="tel" name="tnumber" id="tnumber" value="<?php echo $user["tnumber"]; ?>">
            <label for="bday">Doğum Tarihi:</label>
            <input type="date" name="bday" id="bday" value="<?php echo $user["bday"]; ?>">
            <label>İngilizce Seviyesi:</label>
            <?php
            $levels = array("A1", "A2", "A3", "B1", "B2", "B3", "C1", "C2", "C3");
            foreach ($levels as $level) {
                $checked = ($user["level"] == $level) ? "checked" : "";
                echo "<input type='radio' name='level' value='$level' $checked> $level &nbsp; &nbsp;";
            }
            ?>
            <label for="info">Kendini Tanıtma:</label>
            <textarea name="info" id="info" cols="50" rows="5"><?php echo $user["info"]; ?></textarea>

            <button type="submit">Kaydet</button>
        </form>
    </body>
    </html>

    <?php
}
?>
