<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görev 2</title>
    <style>
        body {
            background-color: #1c1c1c;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            color: #0ac2ff;
            text-align: center;
            margin-top: 20px;
        }

        form {
            text-align: center;
            margin: 20px auto;
        }

        label, input, button {
            margin: 5px;
            padding: 10px;
            font-size: 16px;
            border-radius: 10px;
        }

        input {
            border: 1px solid #444;
            background-color: #2e2e2e;
            color: white;
        }

        button {
            background-color: #0ac2ff;
            color: #1c1c1c;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #078bb8;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #2e2e2e;
            color: white;
            border-radius: 15px; 
            overflow: hidden; 
        }

        th, td {
            border: 1px solid #444;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #0ac2ff;
            color: #1c1c1c;
        }
    </style>
</head>
<body>
    <h1>Görev 2</h1>
    <form method="POST">
        <label for="rows">Satır Sayısı:</label>
        <input type="number" id="rows" name="rows" min="1" max="100" required>
        <label for="columns">Sütun Sayısı:</label>
        <input type="number" id="columns" name="columns" min="1" max="100" required>
        <button type="submit">Tablo Oluştur</button>
    </form>
<br> 	
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rows = (int)$_POST['rows'];
        $columns = (int)$_POST['columns'];

        echo "<h2>${rows}x${columns} Tablo</h2>";
        echo "<table>";
        for ($i = 0; $i < $rows; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $columns; $j++) {
                $randomNumber = rand(1, 100);
                echo "<td>$randomNumber</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</body>
</html>
