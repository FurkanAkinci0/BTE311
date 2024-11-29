<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görev 1</title>
    <style>
        body {
            background-color: #1c1c1c;
            color: white; /* Metinleri görünür yapmak için */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #0ac2ff;
            text-align: center;
            padding: 20px;
        }

        .container {
            background-color: #2e2e2e;
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <h1>Görev 1 <br> <br> 1 ile 100 Arası Tek Sayılar</h1>
    <div class="container">
        <?php
        for ($i = 1; $i <= 100; $i++) {
            if ($i % 2 != 0) {
                echo $i . " ";
            }
        }
        ?>
    </div>
</body>
</html>
