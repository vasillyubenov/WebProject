<?php
    require_once __DIR__."/../../bootstrap.php";
    
    $host = $_ENV['DATABASE_HOST'];
    $dbUsername = $_ENV['DATABASE_USER'];
    $dbPassword = $_ENV['DATABASE_PASSWORD'];
    $dbName = $_ENV['DATABASE_NAME'];

    $conn = mysqli_connect($host,$dbUsername,$dbPassword,$dbName);
    
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>