// Timer Variables
const FULL_DASH_ARRAY = 276;
let timeRemaining = 60; // Updated from 30 to 60
let timerInterval;
let questions = [];
let currentQuestionIndex = 0;
let correctAnswers = 0;
let incorrectAnswers = 0;

// DOM Elements
const timerText = document.getElementById("timer-text");
const circle = document.querySelector(".progress-ring__circle");
const correctCount = document.getElementById("correct-count");
const incorrectCount = document.getElementById("incorrect-count");
const questionProgress = document.getElementById("question-progress");
const radius = circle.r.baseVal.value;
const circumference = 2 * Math.PI * radius;
circle.style.strokeDasharray = `${circumference} ${circumference}`;
circle.style.strokeDashoffset = `${circumference}`;

// Function to Set Progress for Circular Timer
function setProgress(percentage) {
    const offset = circumference - (percentage / 100) * circumference;
    circle.style.strokeDashoffset = offset;
}

// Function to Start Circular Timer
function startCircularTimer() {
    clearInterval(timerInterval);
    timeRemaining = 60; // Updated from 30 to 60
    setProgress(100);

    timerInterval = setInterval(() => {
        if (timeRemaining > 0) {
            timeRemaining--;
            const percentage = (timeRemaining / 60) * 100; // Updated denominator to 60
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

// Quiz Setup and Start
function startQuiz() {
    const urlParams = new URLSearchParams(window.location.search);
    const topic = urlParams.get("subject");

    if (!topic) {
        alert("No topic selected. Redirecting to the selection page.");
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

// Get Category ID Based on Topic
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

// Show Question
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

// Check Answer
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

// Mark Incorrect Answer Automatically When Time's Up
function markIncorrect() {
    incorrectAnswers++;
    incorrectCount.innerHTML = `${incorrectAnswers} <i class="fa-solid fa-circle"></i>`;
}

// Go to Next Question
function nextQuestion() {
    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        showQuestion(questions[currentQuestionIndex]);
    } else {
        alert(`Quiz complete! Your score: ${correctAnswers}/${questions.length}`);
        window.location.href = "quiz-selection.html";
    }
}

// Initialize Quiz
document.addEventListener("DOMContentLoaded", () => {
    startQuiz();
});
