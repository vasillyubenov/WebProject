<?php
//include auth_session.php file on all user panel pages
include("authenticate.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="../frontend/css/styles.css" />
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['email']; ?>!</p>
        <p>You are now user dashboard page.</p>
        <p><a href="logout.php">Logout</a></p>
    </div>
    <div class="header-wrapper">
        <img id="logo" src="../frontend/assets/images/logo.png" alt="logo">
        <h2 class="star-wars-title">Star Wars Cinematic Project</h2>
    </div>

    <form class="form-container" id="upload-form-form" action="http://localhost:8000/backend/upload.php" method="post" enctype="multipart/form-data">
        <label for="htmlFile">Referat File:</label><br>
        <input id="referat-input" type="file" id="htmlFile" name="htmlFile" accept=".html"><br><br>
        <label for="audioFile">Audio File:</label><br>
        <input id="audio-input" type="file" id="audioFile" name="audioFile" accept=".mp3,.wav,.ogg"><br><br>
        <div class="center-wrapper">
            <input id="form-submitter" type="submit" value="Upload">
        </div>
    </form>

    <form class="form-container" id="config-form" action="http://localhost:8000/backend/config.php" method="post" enctype="multipart/form-data">
        <label for="configFile">JSON Config File:</label><br>
        <input id="config-input" type="file" id="configFile" name="configFile" accept=".json"><br><br>
        <div class="center-wrapper">
            <input id="form-submitter" type="submit" value="Upload">
        </div>
    </form>

    <script src="../frontend/js/main.js"></script>
    <script src="../frontend/js/configEditor.js"></script>
    <script src="../frontend/js/animation.js"></script>

</body>
</html>