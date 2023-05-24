<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Html2Text\Html2Text;

$time = $_GET["time"];
$target_dir = "uploads/";
$audio_file = $target_dir . $time . basename("audioFile");
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
  <button class="star-wars-button" onclick="GenerateConfig('<?php echo $time; ?>')">Generate Config</button>
  <script>
    function GenerateConfig(D_time) {

      var config = {
        time: D_time,
        text_delay: scrollText.style.animationDelay,
      };

      var configJSON = JSON.stringify(config, null, 2);

      var blob = new Blob([configJSON], { type: "application/json" });

      var url = URL.createObjectURL(blob);

      var link = document.createElement("a");
      link.href = url;
      link.download = "config.json";

      link.click();

      URL.revokeObjectURL(url);
    }
  </script>

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

      $options = array('ignore_comments' => true);
      $html2text = new Html2Text($html, $options);
      $textContent = $html2text->getText();

      $textContent = str_replace('*', "\n", $textContent);
      $textContent = nl2br($textContent);

      $words = str_word_count($textContent, 1); // get words as an array
      $chunks = array_chunk($words, $chunkSize);
      echo '<p>' . $textContent . '</p>';
      echo "<script>StartAnimation();</script>";
      // echo "<script> 
      // document.getElementById('playButton').addEventListener('click', function() {
      //                 StartAnimation();
      //                      });
      //                      </script>";
      ?>
  </section>

</body>

</html>