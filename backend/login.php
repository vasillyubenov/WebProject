<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('database/database.php');
    session_start();
    if (isset($_POST['email'])) {
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query    = "SELECT id FROM `users` WHERE email='$email'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $user['id'];        
            $_SESSION['email'] = $email;
            header("Location: home.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Email/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form method="post" name="login">
        <h1 >Login</h1>
        <input type="text"  name="email" placeholder="Email" autofocus="true"/>
        <input type="password"  name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p ><a href="registration.php">New Registration</a></p>
  </form>
<?php
    }
?>
</body>
</html>