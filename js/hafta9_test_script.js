// Test soruları verisi
const testData = {
    "questions": [
        { "question": "HTML nedir?", "options": ["Programlama dili", "İşaretleme dili", "Veritabanı", "Framework"], "correctAnswer": "İşaretleme dili" },
        { "question": "CSS ne işe yarar?", "options": ["Veritabanı yönetimi", "Sayfa düzeni ve stil", "Web sunucusu", "Ekran kartı ayarları"], "correctAnswer": "Sayfa düzeni ve stil" },
        { "question": "JavaScript nedir?", "options": ["Programlama dili", "Web sunucusu", "Veritabanı", "CSS framework"], "correctAnswer": "Programlama dili" },
        { "question": "DOM nedir?", "options": ["Veritabanı yönetim sistemi", "Web sayfası üzerindeki HTML elemanları", "JavaScript kütüphanesi", "CSS sınıfı"], "correctAnswer": "Web sayfası üzerindeki HTML elemanları" },
        { "question": "CSS hangi özelliğiyle metni ortalar?", "options": ["align-center", "text-align", "justify-content", "center-text"], "correctAnswer": "text-align" },
        { "question": "JavaScript'te değişken tanımlamak için hangi anahtar kelimeler kullanılır?", "options": ["let, var, const", "int, float, char", "if, else", "function, var"], "correctAnswer": "let, var, const" },
        { "question": "HTML'de 'form' etiketi ile ne yapılır?", "options": ["Sayfa başlığını tanımlar.", "Kullanıcıdan veri alınır.", "Web sayfası düzenlenir.", "JavaScript kodu yazılır."], "correctAnswer": "Kullanıcıdan veri alınır." },
        { "question": "CSS'de font-boyutunu nasıl değiştirirsiniz?", "options": ["font-size", "font-weight", "text-size", "font-style"], "correctAnswer": "font-size" },
        { "question": "Bir JavaScript fonksiyonu nasıl tanımlanır?", "options": ["function myFunction()", "function = myFunction", "def myFunction()", "func myFunction()"], "correctAnswer": "function myFunction()" },
        { "question": "JavaScript'te hangi fonksiyon web sayfasını yeniden yükler?", "options": ["window.location.reload()", "document.refresh()", "location.reload()", "window.update()"], "correctAnswer": "location.reload()" }
    ]
};

// Soruları HTML formuna ekle
const testForm = document.getElementById('test-form');
testData.questions.forEach((question, index) => {
    const questionDiv = document.createElement('div');
    questionDiv.classList.add('question');
    
    let optionsHTML = question.options.map((option, i) => {
        return `
            <label>
                <input type="radio" name="q${index}" value="${option}">
                ${option}
            </label>
        `;
    }).join('');

    questionDiv.innerHTML = `
        <p><span class="question-number">${index + 1}.</span> ${question.question}</p>
        ${optionsHTML}
    `;
    
    testForm.appendChild(questionDiv);
});

// Sonuçları kontrol et ve doğru/yanlış renkleri ekle
document.getElementById('show-results-btn').addEventListener('click', function() {
    const answers = document.querySelectorAll('input[type="radio"]:checked');
    let score = 0;

    answers.forEach((answer, index) => {
        const question = document.querySelectorAll('.question')[index];
        const correctAnswer = testData.questions[index].correctAnswer;
        const selectedAnswer = answer.value;

        if (selectedAnswer === correctAnswer) {
            question.classList.add('correct-answer');
            score++;
        } else {
            question.classList.add('incorrect-answer');
        }
    });

    document.getElementById('result').textContent = `Score: ${score}/${testData.questions.length}`;
});
