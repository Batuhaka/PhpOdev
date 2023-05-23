<?php
include "config.php";

// İlan ID'sini alma
$advertID = $_GET["advert_id"];

// İlanı silme işlemi
$deleteAdvert = mysqli_query($baglan, "DELETE FROM adverts WHERE advert_id = $advertID");
if (!$deleteAdvert) {
    echo "İlan silinirken bir hata oluştu: " . mysqli_error($baglan);
    exit;
}

echo "İlan başarıyla silindi.";

echo '<br><a href="index.php">Ana Sayfa</a>';
?>
