<?php
session_start();
include("connect.php");

// include("connect.php");
// echo $conn->connect_error ? "Connection Failed" : "Connection Successful";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="popup-container">
    <div class="popup-box">
        <div class="container2">
            <div class="form signup" id="signupForm">
                <form method="post" action="register.php">
                                <h1>Sign Up</h1>

                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" placeholder="First Name" name="firstname">

                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" placeholder="Last Name" name="lastname">

                    <label for="email">Email</label>
                    <input type="text" id="email" placeholder="Enter your Email" name="email">

                    <label for="Password">Password</label>
                    <input type="password" id="password" placeholder="Enter Password" name="password">

                    <a href="" id="switchToSignIn" style="font-size: 14px;">Already Have Account?</a>
                    <button type="submit" id="signUpButton" name="signUpButton">Sign Up</button>
                </form>
            </div>

            <div class="form login" id="loginForm" style="display: none;">
            <form method="post" action="register.php">
            <h1>Log In</h1>

                    <label for="email">Email</label>
                    <input type="text" id="email" placeholder="Enter your Email"  name="email">

                    <label for="Password">Password</label>
                    <input type="password" id="password" placeholder="Enter Password"  name="password">

                    <a href="#">Forgot Password?</a>
                    <button type="submit" id="signInButton" name="signInButton">Log In</button>
                    <a href="" id="switchToSignUp" style="text-align: right; font-size: 14px;">Don't have an account?</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
const signUpForm = document.getElementById('signupForm');
const signInForm = document.getElementById('loginForm');
const switchToSignUp = document.getElementById('switchToSignUp');
const switchToSignIn = document.getElementById('switchToSignIn');

    switchToSignUp.addEventListener('click', function (event) {
        event.preventDefault();
        signInForm.style.display = "none";
        signUpForm.style.display = "block";
    });

    switchToSignIn.addEventListener('click', function (event) {
        event.preventDefault();
        signUpForm.style.display = "none";
        signInForm.style.display = "block";
    });

</script>
</body>
</html>
