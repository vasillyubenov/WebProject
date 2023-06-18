<?php
    $host = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'root';
    $dbName = 'web';

    $conn = mysqli_connect($host,$dbUsername,$dbPassword,$dbName);
    
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>