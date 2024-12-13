<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonuç</title>
    <link rel="stylesheet" href="../css/hafta12.css">
</head>
<body>
    <h1>Sonuçlar</h1>
    <?php
    echo "<p>Kişi başarıyla eklendi.</p>";
    ?>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Kişi Ekleme
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];

        $sql = "INSERT INTO kisi (ad, soyad, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $surname, $email);

        if ($stmt->execute()) {
            echo "Kişi başarıyla eklendi.";
        } else {
            echo "Hata: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['search'])) {
        // Kişi Bulma
        $search_name = $_POST['search_name'];

        $sql = "SELECT soyad, email FROM kisi WHERE ad = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $search_name);
        $stmt->execute();
        $stmt->bind_result($surname, $email);

        if ($stmt->fetch()) {
            echo "Soyad: $surname <br>Email: $email";
        } else {
            echo "Kişi bulunamadı.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
