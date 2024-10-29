<!DOCTYPE html>
<html>
<head>
  <title>Test Sonucu</title>
</head>
<body>

<h2>Test Sonuçları</h2>

<?php
// Doğru cevaplar (anahtar ve doğru cevaplar burada saklanır)
$correct_answers = [
    "html" => "HyperText Markup Language",
    "html_tags" => ["p", "img", "link"], // Çoklu cevap olan bir checkbox
    "programming_languages" => ["HTML", "CSS", "Python", "SQL"],
    "form_tag" => "form",
    "css" => "Cascading Style Sheets"
];

$score = 0;
$total_questions = count($correct_answers);

// Kullanıcının verdiği cevapları kontrol et
foreach ($correct_answers as $question => $answer) {
    if (isset($_POST[$question])) {
        if (is_array($answer)) { // Checkbox veya çoklu seçenek için
            $user_answers = $_POST[$question];
            sort($user_answers); // Kullanıcı cevabını sıralama
            sort($answer); // Doğru cevabı sıralama
            if ($user_answers === $answer) {
                $score++;
            }
        } else {
            if ($_POST[$question] == $answer) {
                $score++;
            }
        }
    }
}

// Sonuçları göster
echo "<p>Toplam Doğru Cevap Sayısı: $score / $total_questions</p>";

</body>
</html>
