<?php
require_once 'config_class.php';
require_once __DIR__ . '/../vendor/autoload.php';
include("authenticate.php");
require('database/database.php');

$presentationId = $_GET["presentationId"];

$stmt = $conn->prepare("SELECT time, audio_format, text_step, playback_step, play_reverse, play_button_shape, pause_button_shape, play_button_color, pause_button_color, text_color FROM presentations WHERE id = ?");
$stmt->bind_param("i", $presentationId);

$stmt->execute();
$stmt->bind_result($time, $audio_format, $text_step, $playback_step, $shouldPlayReverse, $playButtonShape, $pauseButtonShape, $playButtonColor, $pauseButtonColor, $textColor);

$stmt->fetch();

$stmt->close();


$config = new Config($time, $text_step, $playback_step, $shouldPlayReverse, $playButtonShape, $pauseButtonShape, $playButtonColor, $pauseButtonColor, $textColor);

$target_dir = "uploads/";
$audio_file = $target_dir . $time . basename("audioFile") . "." . $audio_format;
$html_file = $target_dir . $time . basename("htmlFile") . ".html";

if (!file_exists($audio_file)) {
  // In case something corrupted the json file
  $audio_file = $target_dir . "defaultAudio.mp3";
}

if (!file_exists($html_file)) {
  // In case something corrupted the json file
  $html_file = $target_dir . "defaultHtmlFile.html";
}
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../frontend/css/starwars.css">
  <title>Animation</title>
</head>

<body>
  <button class="star-wars-button" onclick="GenerateConfig('<?php echo $time;?>','<?php echo $audio_format;?>')">Generate
    Config</button>

  <div style="position: absolute;
    z-index: 2;
    display: inline-block;
    padding: 2px 4px;
    font-family: 'Star Jedi', sans-serif;
    font-size: 12px;
    text-decoration: none;
    color: #FFD700;
    border: 1px solid #FFD700;
    background-color: #000;
    transition: all 0.3s ease;">


    <audio id="audioPlayer" src=<?php echo $audio_file ?> style="display: none"></audio>

  </div>

  <div class="fade"></div>
  <div id="play" class="action-button"></div>
  <div id="pause" class="action-button"></div>
  <script src='../frontend/js/animation.js'></script>

  <section class="star-wars">
    <div id="crawl">
      <div class="title">
        <p>Episode IV</p>
        <h1>A New Hope</h1>
      </div>
      <?php
        $html = file_get_contents($html_file);
        echo '<p style="text-aling:center;">' . $html . '</p>';
        echo "<script>StartAnimation(" . $config . ");</script>";
      ?>
  </section>

</body>

</html>