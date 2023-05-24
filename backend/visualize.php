<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Html2Text\Html2Text;

$time = $_GET["time"];
$target_dir = "uploads/";
$audio_format = $_GET["audioFormat"];
$audio_file = $target_dir . $time . basename("audioFile") . "." . $audio_format;
$html_file = $target_dir . $time . basename("htmlFile");
?>

<html lang="en">

<head>
  <script src='../frontend/js/animation.js'></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../frontend/css/starwars.css">
  <title>Animation</title>
</head>

<body>
  <button class="star-wars-button" onclick="GenerateConfig('<?php echo $time; ?>,<?php echo $audio_format ?>')">Generate
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


    <audio id="audioPlayer" src="../frontend/assets/audio/Star_Wars_Main_Theme.mp3" style="display: none"></audio>

  </div>

  <div class="fade"></div>
  <section class="star-wars">
    <div id="crawl">
      <div class="title">
        <p>Episode IV</p>
        <h1>A New Hope</h1>
      </div>
      <?php
      $chunkSize = 5;

      $audio = file_get_contents($audio_file);
      $html = file_get_contents($html_file);

      // $options = array('ignore_comments' => true);
      // $html2text = new Html2Text($html, $options);
      // $textContent = $html2text->getText();
      
      // $textContent = nl2br($textContent);
      echo '<p style="text-aling:center;">' . $html . '</p>';
      echo "<script>StartAnimation();</script>";
      ?>
  </section>

</body>

</html>