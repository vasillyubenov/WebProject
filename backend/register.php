<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    require('database/database.php');

    $data = json_decode(file_get_contents('php://input'), true);

    function emailExists($email, $conn) {
        $email = mysqli_real_escape_string($conn, $email);
        $query = "SELECT * FROM `users` WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        return mysqli_num_rows($result) > 0;
    }

    if (isset($data['email'])) {
        $email = stripslashes($data['email']);
        $email = mysqli_real_escape_string($conn, $email);

        if (emailExists($email, $conn)) {
            echo json_encode(["message" => "Registration failed. User with this email already exists.", "success" => false]);
        } else {
            $password = stripslashes($data['password']);
            $password = mysqli_real_escape_string($conn, $password);
            $create_datetime = date("Y-m-d H:i:s");
            $query = "INSERT into `users` (email, password, created_at)
                     VALUES ('$email', '" . md5($password) . "', '$create_datetime')";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo json_encode(["message" => "You are registered successfully.", "success" => true]);
            } else {
                echo json_encode(["message" => "Required fields are missing.", "success" => false]);
            }
        }
    } else {
        echo json_encode(["message" => "No data posted with HTTP POST." . json_encode($data), "success" => false]);
    }
?>