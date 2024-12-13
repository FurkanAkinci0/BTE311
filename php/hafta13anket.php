<?php
// Veritabanı bağlantı bilgileri
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Cevapları kaydet
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cevap'])) {
    $cevap = $_POST['cevap'];

    // Veriyi veritabanına kaydet
    $sql = "INSERT INTO anket (cevap) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cevap);

    if ($stmt->execute()) {
        $success_message = "Cevabınız başarıyla kaydedildi!";
    } else {
        $error_message = "Cevap kaydedilirken bir hata oluştu!";
    }
    $stmt->close();
}

// Sonuçları hesapla
$sql = "SELECT cevap, COUNT(*) as sayi FROM anket GROUP BY cevap";
$result = $conn->query($sql);

// Toplam cevap sayısını bul
$total_sql = "SELECT COUNT(*) as toplam FROM anket";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total = $total_row['toplam'];

// Sonuçları düzenle
$results = [];
while ($row = $result->fetch_assoc()) {
    $cevap = $row['cevap'];
    $sayi = $row['sayi'];
    $yuzde = ($sayi / $total) * 100;
    $results[$cevap] = [
        "sayi" => $sayi,
        "yuzde" => number_format($yuzde, 2) // Yüzdeyi 2 ondalık basamakla göster
    ];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anket</title>
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
            margin: 20px 30px; /* Yazıyı sağa kaydır */
        }

        .container {
            max-width: 600px;
            margin: 20px 0;
            padding: 20px;
            background: #2e2e2e;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left: 10px; /* Container'ı sağa kaydır */
        }

        .results-container {
            max-width: 600px;
            margin: 20px 0;
            padding: 20px;
            background: #2e2e2e;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-left: 10px; /* Container'ı sağa kaydır */
        }

        .results-title {
            color: #0ac2ff;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .result-item {
            margin: 10px 0;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .result-item .bar {
            height: 20px;
            background-color: #0ac2ff;
            margin-left: 10px;
            border-radius: 5px;
        }

        .radio-group {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            margin-left: 10px; /* Radyo butonlarını sağa kaydır */
        }

        label {
            display: flex;
            align-items: center;
            font-size: 16px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #0ac2ff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px; /* Butonu sağa kaydır */
        }

        button:hover {
            background: #008fbf;
        }

        .success {
            color: #28a745; /* Yeşil renk */
            font-size: 18px;
            font-weight: bold;
            margin-left: 10px; /* Başarı mesajını sağa kaydır */
        }

        .error {
            color: #ff6b6b;
            margin-left: 10px; /* Hata mesajını sağa kaydır */
        }
    </style>
</head>
<body>
    <h1>Hafta 13 Anket</h1>

    <div class="container">
        <?php if (isset($success_message)) : ?>
            <p class="success"><?= $success_message ?></p>
        <?php elseif (isset($error_message)) : ?>
            <p class="error"><?= $error_message ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <p>Aşağıdaki tuşlardan birisini seçiniz.</p>
            <div class="radio-group">
                <label>
                    <input type="radio" name="cevap" value="Evet" required> Evet
                </label>
                <label>
                    <input type="radio" name="cevap" value="Hayır" required> Hayır
                </label>
                <label>
                    <input type="radio" name="cevap" value="Belki" required> Belki
                </label>
            </div>
            <button type="submit">Gönder</button>
        </form>
    </div>

    <div class="results-container">
        <h2 class="results-title">Sonuçlar</h2>
        <?php if ($total > 0) : ?>
            <?php foreach ($results as $cevap => $data) : ?>
                <div class="result-item">
                    <?= $cevap ?>: %<?= $data["yuzde"] ?>
                    <div class="bar" style="width: <?= $data["yuzde"] ?>%;"></div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Henüz bir cevap yok.</p>
        <?php endif; ?>
    </div>
</body>
</html>
