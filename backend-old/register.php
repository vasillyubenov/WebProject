<?php

// Database connection details
$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName = 'web';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['registerUsername'];
    $password = $_POST['registerPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password === $confirmPassword) {
        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

        // Check connection
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Insert user data into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === true) {
            echo 'User registered successfully.';
        } else {
            echo 'Error: ' . $sql . '<br>' . $conn->error;
        }

        $conn->close();
    } else {
        echo 'Passwords do not match.';
    }
}
?>
