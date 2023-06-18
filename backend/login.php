<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require('database/database.php');
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $data['email'];
    $password = $data['password'];

    $email = stripslashes($email);
    $email = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($password);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT id FROM `users` WHERE email='$email' AND password='" . md5($password) . "'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $email;

        $response = array(
            "success" => true,
            "message" => "Login successful"
        );
        echo json_encode($response);
    } else {
        $response = array(
            "success" => false,
            "message" => "Incorrect email/password"
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        "success" => false,
        "message" => "Invalid request method"
    );
    echo json_encode($response);
}
?>
