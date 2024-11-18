<?php
include("connect.php");
// echo $conn->connect_error ? "Connection Failed" : "Connection Successful";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz App</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="page">
        <header>
            <div class="header">
                <div class="logo"><img id="logo" src="/quiz/img/logo.png"></div>
    
                <div class="avathar">
                    <img id="avathar" src="/quiz/img/Avathar.gif">
                    <div class="avathar">
                        <a href="login.php"><button id="login-button">Sign Up</button></a>
                    </div>
                </div>
            </div>
        </header>
    
        <div class="container">
            <div class="circle one"> </div>
            <div class="circle two"> </div>
            <div class="circlee three"> </div>
    
            <div class="content">
                <h1>Quick Quiz</h1>
                <p>Get ready to test your knowledge and challenge yourself! 
                    This quiz is designed to be fun, engaging, and a great way to learn something new. 
                    Click the button above to begin and see how many questions you can get right—good luck!</p>
    
                    <a href="/quiz/quizz/quiz.php"> <button id="start"> Ready? Go!</button> </a>
            </div>
        </div>
    </div>

    <script> </script>
</body>
</html>