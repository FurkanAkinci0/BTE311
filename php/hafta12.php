<?php
// Veritabanı bağlantı bilgileri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test2";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die('<div class="container"><p>Bağlantı hatası: ' . $conn->connect_error . '</p></div>');
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonuçlar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1c1c1c;
            color: #f3f3f3;
        }
        h1 {
            color: #0ac2ff;
            margin: 20px 20px;
        }
        .container {
            max-width: 800px;
            margin: 20px 20px;
            padding: 20px;
            background: #2e2e2e;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            background-color: #1c1c1c;
            color: #f3f3f3;
        }
        .styled-table thead tr {
            background-color: #0ac2ff;
            color: #ffffff;
            text-align: left;
        }
        .styled-table th, .styled-table td {
            padding: 12px 15px;
            border: 1px solid #ccc;
        }
        .styled-table tbody tr:nth-of-type(even) {
            background-color: #1e1e1e;
        }
        .styled-table tbody tr:hover {
            background-color: #333;
        }
        .success-message {
            color: #f3f3f3;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<h1>Sonuçlar</h1>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Kaydetme işlemi
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];

        if (!empty($name) && !empty($surname) && !empty($email)) {
            $sql = "INSERT INTO kisi (ad, soyad, email) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $surname, $email);

            if ($stmt->execute()) {
                echo '<div class="container"><p class="success-message">Kayıt başarıyla eklendi!</p></div>';
            } else {
                echo '<div class="container"><p>Hata: ' . $stmt->error . '</p></div>';
            }

            $stmt->close();
        }

        // Tüm verileri listele
        echo '<div class="container">';
        $sql = "SELECT * FROM kisi";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="styled-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ad</th>
                            <th>Soyad</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . htmlspecialchars($row["id"]) . '</td>
                        <td>' . htmlspecialchars($row["ad"]) . '</td>
                        <td>' . htmlspecialchars($row["soyad"]) . '</td>
                        <td>' . htmlspecialchars($row["email"]) . '</td>
                      </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>Tabloda hiçbir veri yok.</p>';
        }
        echo '</div>';
    } elseif (isset($_POST['search'])) {
        // Bulma işlemi
        $search_name = $_POST['search_name'];

        if (!empty($search_name)) {
            $sql = "SELECT * FROM kisi WHERE ad = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $search_name);
            $stmt->execute();
            $result = $stmt->get_result();

            echo '<div class="container">';
            if ($result->num_rows > 0) {
                echo '<table class="styled-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ad</th>
                                <th>Soyad</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                            <td>' . htmlspecialchars($row["id"]) . '</td>
                            <td>' . htmlspecialchars($row["ad"]) . '</td>
                            <td>' . htmlspecialchars($row["soyad"]) . '</td>
                            <td>' . htmlspecialchars($row["email"]) . '</td>
                          </tr>';
                }
                echo '</tbody></table>';
            } else {
                echo '<p>Aradığınız kişi bulunamadı.</p>';
            }
            echo '</div>';
        } else {
            echo '<p>Lütfen bir isim girin.</p>';
        }
    }
}

$conn->close();

echo '</body></html>';
?>
