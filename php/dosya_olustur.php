<?php
date_default_timezone_set("Europe/Istanbul");

$dosya_adi = "benioku.txt";

$icerik = "Bu dosya " . date("d-m-y h:i:s") . " tarihinde oluşturuldu.\n";
$icerik .= "İçerik başarılı bir şekilde oluşturulmuştur.\n";

$dosya = fopen($dosya_adi, "w");

if ($dosya) {
    fwrite($dosya, $icerik);
    fclose($dosya);

    echo "Dosya başarıyla oluşturuldu ve yazıldı: $dosya_adi\n";
    echo "İçerik:\n";
    echo $icerik;
} else {
    echo "Dosya açılamadı!\n";
}
?>
