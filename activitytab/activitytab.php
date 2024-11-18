<?php
session_start();
include("../connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$userQuery = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
$user = mysqli_fetch_assoc($userQuery);

$runningQuizzes = [];
$completedQuizzes = [];

$quizQuery = mysqli_query($conn, "SELECT * FROM user_quizzes WHERE user_id='" . $user['id'] . "'");
while ($row = mysqli_fetch_assoc($quizQuery)) {
    print_r($row);
    echo "<br>";

    if ($row['status'] === 'running') {
        $runningQuizzes[] = $row['quiz_name'];
    } elseif ($row['status'] === 'completed') {
        $completedQuizzes[] = $row['quiz_name'];
    }
}

// echo "<pre>";
// echo "Running Quizzes:\n";
// print_r($runningQuizzes);
// echo "Completed Quizzes:\n";
// print_r($completedQuizzes);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>activity</title>
    <link rel="stylesheet" href="activitytab.css">
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
                    <li><a href="/quiz/logout.php" style="color: white; text-decoration: none;"><i class="fa-solid fa-arrow-right-from-bracket">  </i>  Logout</a></li>
                    <!-- <li><a href="/profile" style="color: white; text-decoration: none;"> <i class="fa-solid fa-user">  </i>   Profile</a></li> -->
                  </ul>
                </div>
            </div>
        </div>
    </header>
<hr>

<section>
    <div class="options">
        <button id="running-btn" class="toggle-btn active"><i class="fa-solid fa-hourglass-half"></i> Running</button>
        <button id="completed-btn" class="toggle-btn"><i class="fa-solid fa-hourglass-end"></i> Completed</button>
    </div>
</section>
<hr>

<section>
    <!-- Running Quizzes -->
    <div id="running-section" class="quiz-container">
        <div class="quizoptions">
            <?php if (!empty($runningQuizzes)): ?>
                <?php foreach ($runningQuizzes as $quiz): ?>
                    <div class="q"><?= htmlspecialchars($quiz) ?></div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No running quizzes found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Completed Quizzes -->
    <div id="completed-section" class="quiz-container" style="display: none;">
        <div class="quizoptions">
            <?php if (!empty($completedQuizzes)): ?>
                <?php foreach ($completedQuizzes as $quiz): ?>
                    <div class="q"><?= htmlspecialchars($quiz) ?></div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No completed quizzes found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>


    <script>

        const runningBtn = document.getElementById('running-btn');
        const completedBtn = document.getElementById('completed-btn');
        const runningSection = document.getElementById('running-section');
        const completedSection = document.getElementById('completed-section');

            runningBtn.addEventListener('click', () => {
            runningSection.style.display = 'block';
            completedSection.style.display = 'none';
            runningBtn.classList.add('active');
            completedBtn.classList.remove('active');
            runningBtn.style.color = "#b6b6bc";
            completedBtn.style.color = "#292a3a";
        });

            completedBtn.addEventListener('click', () => {
            runningSection.style.display = 'none';
            completedSection.style.display = 'block';
            completedBtn.classList.add('active');
            runningBtn.classList.remove('active');
            completedBtn.style.color = "#b6b6bc";
            runningBtn.style.color = "#292a3a";

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

    </script>
</body>
</html>