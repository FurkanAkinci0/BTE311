<?php
// Doğru cevaplar
$correct_answers = [
    "html" => "HyperText Markup Language",
    "html_tags" => ["p", "img", "link"],
    "programming_languages" => ["HTML", "CSS", "Python", "SQL"],
    "form_tag" => "form",
    "css" => "Cascading Style Sheets"
];

$score = 0;
$total_questions = count($correct_answers);

// Kullanıcının verdiği cevapları kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($correct_answers as $question => $answer) {
        if (isset($_POST[$question])) {
            if (is_array($answer)) {
                $user_answers = $_POST[$question];
                sort($user_answers);
                sort($answer);
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
}

?>

</body>
</html>
