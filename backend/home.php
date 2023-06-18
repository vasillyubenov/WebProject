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
    <style>
        .presentation-card {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            cursor: pointer;
        }
        .presentation-card:hover .presentation-details {
            display: block;
        }
        .presentation-details {
            display: none;
            margin-top: 10px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="header-wrapper">
        <img id="logo" src="../frontend/assets/images/logo.png" alt="logo">
        <h2 class="star-wars-title">Star Wars Cinematic Project</h2>
        <p>Hey, <?php echo $_SESSION['email']; ?>!</p>
        <p><a href="logout.php">Logout</a></p>
    </div>

    <div>
        <form class="form-container" id="upload-form-form" action="http://localhost:8000/backend/upload.php" method="post" enctype="multipart/form-data">
            <label for="htmlFile">Referat File:</label><br>
            <input id="referat-input" type="file" id="htmlFile" name="htmlFile" accept=".html"><br><br>
            <label for="audioFile">Audio File:</label><br>
            <input id="audio-input" type="file" id="audioFile" name="audioFile" accept=".mp3,.wav,.ogg"><br><br>
            <label for="configFile">JSON Config File:</label><br>
            <input id="config-input" type="file" id="configFile" name="configFile" accept=".json"><br><br>
            <div class="center-wrapper">
                <input id="form-submitter" type="submit" value="Upload">
            </div>
        </form>
    </div>

    <div>
        <?php
        require('database/database.php');
        $user_id = $_SESSION['id'];

        // Fetch the presentations for the user from the database
        $query = "SELECT * FROM presentations WHERE owner_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display the presentations
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $time = $row['time'];
            $audio_format = $row['audio_format'];
            $text_step = $row['text_step'];
            $playback_step = $row['playback_step'];
            $play_reverse = $row['play_reverse'];
            $play_button_shape = $row['play_button_shape'];
            $pause_button_shape = $row['pause_button_shape'];
            $play_button_color = $row['play_button_color'];
            $pause_button_color = $row['pause_button_color'];
            $text_color = $row['text_color'];

            echo "<div class='presentation-card' onclick=\"location.href='visualize.php?presentationId=$id';\">";
            echo "<h3>Time: $time</h3>";
            echo "<div class='presentation-details'>";
            echo "<p>Audio Format: $audio_format</p>";
            echo "<p>Text Step: $text_step</p>";
            echo "<p>Playback Step: $playback_step</p>";
            echo "<p>Play Reverse: " . ($play_reverse ? 'Yes' : 'No') . "</p>";
            echo "<p>Play Button Shape: $play_button_shape</p>";
            echo "<p>Pause Button Shape: $pause_button_shape</p>";
            echo "<p>Play Button Color: $play_button_color</p>";
            echo "<p>Pause Button Color: $pause_button_color</p>";
            echo "<p>Text Color: $text_color</p>";
            echo "</div>";
            echo "</div>";
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
        ?>
    </div>

    <script src="../frontend/js/main.js"></script>
    <script src="../frontend/js/configEditor.js"></script>
    <script src="../frontend/js/animation.js"></script>

</body>
</html>