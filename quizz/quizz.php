<?php
// Start the session at the very beginning
session_start();

$conn = mysqli_connect("localhost", "root", "", "quiz"); 

// Check if the connection is successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Initialize a variable for the user's full name
$fullName = "Guest"; // Default if not logged in

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Query the database for the user's details
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE email='$email'");

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        $firstName = $row['firstname'];
        $lastName = $row['lastname'];
        $fullName = "$firstName $lastName";
    } else {
        $fullName = "Error: User not found!";
    }
}
mysqli_close($conn); 
?>
<!-- <a href="logout.php">Logout</a> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="quizz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
<header>
    <div class="header">
        <div class="logo"><img id="logo" src="/quiz/img/Logo.png"></div>
        <div class="tabs">
            <a href="/quiz/quizz/quizz.php" style="text-decoration: none; "><h3 id="home" style="    border-bottom: green;
"><i class="fa-solid fa-house"></i> Home</h3></a>
            <a href="/quiz/activitytab/activitytab.php" style="text-decoration: none;"><h3 id="activity"> <i class="fa-solid fa-clock-rotate-left"></i> Activity</h3></a>
        </div>
        <div class="avathar">
            <img id="avathar" src="/quiz/img/avathar.gif">
            <div class="avathar">
                <a href="/quiz/quizz/quiz-selection.html"><button id="dashboard">Your dashboard</button></a>
            </div>

            <div class="menu">
              <button class="menu-button"><i class="fa-solid fa-bars"></i></button>
              <ul class="menu-list">
                <li><a href="/quiz/login.php" style="color: white; text-decoration: none;"><i class="fa-solid fa-arrow-right-from-bracket">  </i>  Logout</a></li>
                <!-- <li><a href="/quiz" style="color: white; text-decoration: none;"> <i class="fa-solid fa-user">  </i>   Profile</a></li> -->
              </ul>
            </div>
        </div>
    </div>
</header>
<hr>

<section>
    <div class="container">
        <div class="search-container">
            <div class="search">  
                <input id="input-box" placeholder="Find a quiz"> 
                <button id="search-button">search</button>
            </div>
        </div>
        <div class="character">
        <p id="user-greeting">Hello,<br> Guest</p>
        <img id="chr" src="/quiz/img/avathar2.gif">
        </div>
    </div>
</section>
<!-- <hr> -->

<section>
    <div class="quiz-container">
      <h1> <i class="fa-solid fa-star"></i> Math Quizz </h1>
        <div class="quizoptions">
            <div class="q" onclick="redirectToQuiz('math')"><img src="/quiz/img/math1.png" class="image-box">MATHS</div>
            <div class="q" onclick="redirectToQuiz('geometry')"><img src="/quiz/img/math2.png" class="image-box">GEOMETRY</div>
            <div class="q" onclick="redirectToQuiz('arithmetic')"><img src="/quiz/img/math3.png" class="image-box">ARITHMETIC</div>
            <div class="q" onclick="redirectToQuiz('calcutations')"><img src="/quiz/img/math4.png" class="image-box">CALCULATIONS</div>
            <div class="q" onclick="redirectToQuiz('numbers')"><img src="/quiz/img/math5.png" class="image-box">NUMBERS</div>
        </div>
    </div>
</section>

<section>
    <div class="quiz-container">
      <h1> <i class="fa-solid fa-star"></i> Science Quizz </h1>
        <div class="quizoptions">
            <div class="q" onclick="redirectToQuiz('physics')"><img src="/quiz/img/science2.png" class="image-box">PHYSICS</div>
            <div class="q" onclick="redirectToQuiz('chemistry')"><img src="/quiz/img/science3.png" class="image-box">CHEMISTRY</div>
            <div class="q" onclick="redirectToQuiz('chemical')"><img src="/quiz/img/science5.png" class="image-box">CHEMICAL REACTION</div>
            <div class="q" onclick="redirectToQuiz('biology')"><img src="/quiz/img/science4.png" class="image-box">BIOLOGY</div>
            <div class="q" onclick="redirectToQuiz('science')"><img src="/quiz/img/science6.png" class="image-box">ALL IN ONE</div>
        </div>
    </div>
</section>

<section>
    <div class="quiz-container">
      <h1> <i class="fa-solid fa-star"></i>Social Science Quizz </h1>
        <div class="quizoptions">
            <div class="q" onclick="redirectToQuiz('history')"><img src="/quiz/img/history.png" class="image-box">HISTORY</div>
            <div class="q" onclick="redirectToQuiz('economic')"><img src="/quiz/img/economic.png" class="image-box">ECONOMIC</div>
            <div class="q" onclick="redirectToQuiz('geography')"><img src="/quiz/img/geography.png" class="image-box">GEOGRAPHY</div>
            <div class="q" onclick="redirectToQuiz('politicalScience')"><img src="/quiz/img/politics.png" class="image-box">POLITICAL SCIENCE</div>
            <div class="q" onclick="redirectToQuiz('democracy')"><img src="/quiz/img/demographic.png" class="image-box">DEMOCRACY</div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Dynamically update the user's name
const userGreeting = document.getElementById('user-greeting');
    userGreeting.innerHTML = `Hello,<br> <?php echo $fullName; ?>`;
});

const menuButton = document.querySelector('.menu-button');
const menuList = document.querySelector('.menu-list');

menuButton.addEventListener('click', function () {
    // Toggle menu visibility
    if (menuList.style.display === "block") {
        menuList.style.display = "none";
    } else {
        menuList.style.display = "block";
    }
});

function redirectToQuiz(subject) {
    const url = `quizzpage.html?subject=${encodeURIComponent(subject)}`;
    window.location.href = url; // Redirects with the selected subject
}
</script>
</body>
</html>
