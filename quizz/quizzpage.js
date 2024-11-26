const FULL_DASH_ARRAY = 276;
let timeRemaining = 60;
let timerInterval;
let questions = [];
let currentQuestionIndex = 0;
let correctAnswers = 0;
let incorrectAnswers = 0;

const timerText = document.getElementById("timer-text");
const circle = document.querySelector(".progress-ring__circle");
const correctCount = document.getElementById("correct-count");
const incorrectCount = document.getElementById("incorrect-count");
const questionProgress = document.getElementById("question-progress");
const radius = circle.r.baseVal.value;
const circumference = 2 * Math.PI * radius;
circle.style.strokeDasharray = `${circumference} ${circumference}`;
circle.style.strokeDashoffset = `${circumference}`;

function setProgress(percentage) {
    const offset = circumference - (percentage / 100) * circumference;
    circle.style.strokeDashoffset = offset;
}

function startCircularTimer() {
    clearInterval(timerInterval);
    timeRemaining = 60; 
    setProgress(100);

    timerInterval = setInterval(() => {
        if (timeRemaining > 0) {
            timeRemaining--;
            const percentage = (timeRemaining / 60) * 100; 
            setProgress(percentage);
            timerText.textContent = timeRemaining;
        } else {
            clearInterval(timerInterval);
            alert("Time's up!");
            markIncorrect();
            nextQuestion();
        }
    }, 1000);
}

function startQuiz() {
    const urlParams = new URLSearchParams(window.location.search);
    const topic = urlParams.get("subject");

    if (!topic) {
        window.location.href = "quiz-selection.html";
        return;
    }

    const url = `https://opentdb.com/api.php?amount=10&category=${getCategoryId(topic)}&difficulty=medium&type=multiple`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            if (data.results.length === 0) {
                alert("No questions available for the selected topic.");
                window.location.href = "quiz-selection.html";
                return;
            }

            questions = data.results;
            showQuestion(questions[currentQuestionIndex]);
        })
        .catch((error) => console.error("Error fetching questions:", error));
}

function getCategoryId(topic) {
    const categories = {
        math: 19,
        geometry: 19,
        arithmetic: 19,
        calculations: 19,
        numbers: 19,
        physics: 17,
        chemistry: 17,
        chemical: 17,
        biology: 17,
        science: 17,
        history: 23,
        economic: 24,
        geography: 22,
        politicalScience: 24,
        democracy: 24,
    };
    return categories[topic] || 9;
}

function showQuestion(question) {
    startCircularTimer();

    const questionText = document.querySelector(".question");
    const optionsContainer = document.querySelector(".options");

    questionText.textContent = question.question;
    optionsContainer.innerHTML = "";

    const options = [...question.incorrect_answers, question.correct_answer];
    options.sort(() => Math.random() - 0.5);

    options.forEach((option) => {
        const optionElement = document.createElement("li");
        optionElement.classList.add("option");
        optionElement.textContent = option;
        optionElement.addEventListener("click", () => checkAnswer(option, question.correct_answer));
        optionsContainer.appendChild(optionElement);
    });

    questionProgress.textContent = `Question ${currentQuestionIndex + 1} / ${questions.length}`;
}

function checkAnswer(selected, correct) {
    clearInterval(timerInterval);
    if (selected === correct) {
        correctAnswers++;
        correctCount.innerHTML = `<i class="fa-solid fa-circle"></i> ${correctAnswers}`;
        alert("Correct!");
    } else {
        incorrectAnswers++;
        incorrectCount.innerHTML = `${incorrectAnswers} <i class="fa-solid fa-circle"></i>`;
        alert(`Wrong! The correct answer was: ${correct}`);
    }

    nextQuestion();
}

function markIncorrect() {
    incorrectAnswers++;
    incorrectCount.innerHTML = `${incorrectAnswers} <i class="fa-solid fa-circle"></i>`;
}

document.addEventListener("DOMContentLoaded", () => {
    const quizDataRaw = localStorage.getItem("quizData");
    
    if (quizDataRaw) {
        const quizData = JSON.parse(quizDataRaw); 
        console.log("Loaded quiz data:", quizData);
        
        document.querySelector(".points h1").textContent = quizData.totalScore || 0;
        document.querySelector("#lists li:nth-child(1)").textContent =
            `${Math.round((quizData.totalCorrect / quizData.totalQuestions) * 100)}% completion`;
    } else {
        document.querySelector(".points h1").textContent = 0;
        document.querySelector("#lists li:nth-child(1)").textContent = "0% completion";
    }
});

function nextQuestion() {
    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        showQuestion(questions[currentQuestionIndex]);
    } else {
        const totalQuestions = questions.length;
        const score = correctAnswers * 10; 
        const completionPercentage = Math.round((correctAnswers + incorrectAnswers) / totalQuestions * 100);

        const existingData = JSON.parse(localStorage.getItem("quizData")) || {
            totalScore: 0,
            totalQuestions: 0,
            totalCorrect: 0,
            totalWrong: 0,
        };
        console.log("Final quiz data stored:", JSON.parse(localStorage.getItem("quizData")));
        const updatedData = {
            totalScore: existingData.totalScore + score,
            totalQuestions: existingData.totalQuestions + totalQuestions,
            totalCorrect: existingData.totalCorrect + correctAnswers,
            totalWrong: existingData.totalWrong + incorrectAnswers,
        };

        localStorage.setItem("quizData", JSON.stringify(updatedData));

console.log("Updated quiz data:", updatedData);

localStorage.setItem("quizData", JSON.stringify(updatedData));

        window.location.href = "quiz-selection.html";
    }
}
console.log();
document.addEventListener("DOMContentLoaded", () => {
    startQuiz();
});
