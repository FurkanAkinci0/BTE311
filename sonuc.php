<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Soruları alma
    $soru1 = $_POST['soru1'];
    $soru2 = $_POST['soru2'];
    $soru3 = $_POST['soru3'] ?? []; // Boş olabilen checkboxlar için
    $soru4 = $_POST['soru4'];
    $soru5 = $_POST['soru5'] ?? [];

    // Sonuçları göster
    echo "<h2>Test Sonuçları</h2>";
    echo "<p>1. HTML'nin açılımı: $soru1</p>";
    echo "<p>2. Başlık etiketi: $soru2</p>";
    echo "<p>3. Seçilen CSS özellikleri: " . implode(", ", $soru3) . "</p>";
    echo "<p>4. JavaScript veri tipi: $soru4</p>";
    echo "<p>5. Seçilen programlama dilleri: " . implode(", ", $soru5) . "</p>";
}
?>
