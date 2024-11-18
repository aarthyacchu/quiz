<?php
session_start();
include 'connect.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the signup form is submitted
if (isset($_POST['signUpButton'])) {
    // Retrieve form data and sanitize
    $firstName = htmlspecialchars($_POST['firstname']);
    $lastName = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Hash the password
    $password = md5($password);

    // Check if the email already exists
    $checkEmail = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        // Insert new user data into the database
        $insertQuery = "INSERT INTO user (firstname, lastname, email, password) 
                        VALUES ('$firstName', '$lastName', '$email', '$password')";

        if ($conn->query($insertQuery) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Check if the login form is submitted
if (isset($_POST['signInButton'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password for matching
    $password = md5($password);

    // Query to check credentials
    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: quizz/quizz.php");
        exit();
    } else {
        echo "Incorrect Email or Password";
    }
}

?>
