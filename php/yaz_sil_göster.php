<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yaz, Sil, Göster</title>
    <style>
        body {
            background-color: #1c1c1c;
            color: #f3f3f3; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .container {
            background-color: #2e2e2e; 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 600px;
            text-align: center;
            margin-top: 50px; 
        }
        h1 {
            color: #b3fff9;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        .input-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        label {
            color: #f3f3f3;
        }
        input[type="text"] {
            width: 300px;
            padding: 10px;
            border: 1px solid #0ac2ff;
            border-radius: 5px;
            background-color: #1c1c1c;
            color: #ffffff; 
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #333333;
            color: #f3f3f3; 
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #444444; 
        }
        .notification {
            color: #b3fff9; 
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Yaz, Sil, Göster</h1>
        <form method="post">
            <div class="input-group">
                <label for="mesaj">Mesaj Giriniz:</label>
                <input type="text" name="mesaj" id="mesaj">
            </div>
			
            <div class="button-group">
                <button type="submit" name="kaydet">Dosyaya Kaydet</button>
                <button type="submit" name="sil">Dosyanın İçini Sil</button>
                <button type="submit" name="rastgele">Rastgele Satır Göster</button>
            </div>
        </form>
        <br>
        <?php
        $dosya_adi = "benioku.txt";

        if (isset($_POST['kaydet'])) {
            $mesaj = $_POST['mesaj'] ?? '';

            if (!empty($mesaj)) {
                $dosya = fopen($dosya_adi, "a"); 
                if ($dosya) {
                    fwrite($dosya, $mesaj . "\n");
                    fclose($dosya);
                    echo "<p class='notification'>Mesaj başarıyla dosyaya kaydedildi: $mesaj</p>";
                } else {
                    echo "<p class='notification'>Dosya açılamadı!</p>";
                }
            } else {
                echo "<p class='notification'>Mesaj alanı boş olamaz!</p>";
            }
        }

        if (isset($_POST['sil'])) {
            $dosya = fopen($dosya_adi, "w");
            if ($dosya) {
                fclose($dosya);
                echo "<p class='notification'>Dosyanın içeriği başarıyla silindi.</p>";
            } else {
                echo "<p class='notification'>Dosya açılamadı!</p>";
            }
        }

        if (isset($_POST['rastgele'])) {
            if (file_exists($dosya_adi)) {
                $icerik = file($dosya_adi, FILE_IGNORE_NEW_LINES); 
                if (!empty($icerik)) {
                    $rastgele_satir = $icerik[array_rand($icerik)];
                    echo "<p class='notification'>Rastgele satır: $rastgele_satir</p>";
                } else {
                    echo "<p class='notification'>Dosya boş, rastgele bir satır bulunamadı.</p>";
                }
            } else {
                echo "<p class='notification'>Dosya mevcut değil!</p>";
            }
        }
        ?>
    </div>
</body>
</html>

