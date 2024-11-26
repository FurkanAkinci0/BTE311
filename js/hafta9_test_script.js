// JSON verilerini çek
fetch('../data/hafta9_testData.json')
    .then(response => response.json())
    .then(data => {
        const testData = data;

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
        document.getElementById('show-results-btn').addEventListener('click', function () {
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
    })
    .catch(error => console.error('JSON veri yüklenirken bir hata oluştu:', error));
