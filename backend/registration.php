<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php


    require('database/database.php');
    function emailExists($email, $con)
    {
        $email = mysqli_real_escape_string($con, $email);
        $query = "SELECT * FROM `users` WHERE email = '$email'";
        $result = mysqli_query($con, $query);
        return mysqli_num_rows($result) > 0;
    }

    if (isset($_REQUEST['email'])) {

        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con, $email);

        if (emailExists($email, $con)) {
            echo "<div class='form'>
                  <h3>Registration failed. User with this email already exists.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
                  </div>";
        } else {
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);
            $create_datetime = date("Y-m-d H:i:s");
            $query = "INSERT into `users` (email, password, created_at)
                     VALUES ('$email', '" . md5($password) . "', '$create_datetime')";
            $result = mysqli_query($con, $query);
            if ($result) {
                echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
            } else {
                echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
            }
        }
    } else {
        ?>
        <form action="" method="post">
            <h1 class="login-title">Registration</h1>
            <input type="text" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password">
            <input type="submit" name="submit" value="Register" class="login-button">
            <p><a href="login.php">Click to Login</a></p>
        </form>
        <?php
    }
    ?>
</body>

</html>