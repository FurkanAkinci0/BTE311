<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablo Oluştur</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Tablo Oluştur</h1>
    <form method="POST">
        <label for="rows">Satır Sayısı:</label>
        <input type="number" id="rows" name="rows" min="1" max="100" required>
        <label for="columns">Sütun Sayısı:</label>
        <input type="number" id="columns" name="columns" min="1" max="100" required>
        <button type="submit">Tablo Oluştur</button>
    </form>

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
