<?php
include "config.php";

// Kullanıcıları ve ilanları çekme
$query = mysqli_query($baglan, "SELECT users.id, users.name, users.age, users.level, adverts.experience, adverts.title, adverts.advert_id
                                FROM users
                                LEFT JOIN adverts ON users.id = adverts.user_id
                                WHERE adverts.advert_id IS NOT NULL");
$users = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kullanıcı Listesi</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .detail-button {
            padding: 5px 10px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
        }
        .delete-button {
            padding: 5px 10px;
            text-decoration: none;
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>İsim</th>
            <th>Yaş</th>
            <th width="10%">İngilizce Seviyesi</th>
            <th>Deneyim</th>
            <th>Sıfat</th>
            <th></th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['age']; ?></td>
                <td><?php echo $user['level']; ?></td>
                <td><?php echo $user['experience']; ?></td>
                <td><?php echo $user['title']; ?></td>
                <td>
                    <a href="profile.php?user_id=<?php echo $user['id']; ?>" class="detail-button">Detay</a>
                    <?php if (isset($_SESSION['user_id']) && $user['id'] == $_SESSION['user_id']): ?>
                        <a href="silme.php?advert_id=<?php echo $user['advert_id']; ?>" class="delete-button">Sil</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
