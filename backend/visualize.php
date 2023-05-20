<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Html2Text\Html2Text;

$time = $_GET["time"];
$target_dir = "uploads/";
$audioPath = "../backend/uploads/audioFile.mp3";
$target_file = $target_dir . $time . basename("referat.html");
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
  <button class="star-wars-button" onclick="generateConfig('<?php echo $time;?>')">Generate Config</button>

  <script>
    function generateConfig(D_time) {
    
      var config = {
        time: D_time,
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
  <div class="fade"></div>
  <section class="star-wars">
    <div class="crawl">
      <div class="title">
        <p>Episode IV</p>
        <h1>A New Hope</h1>
      </div>

      <?php
      $chunkSize = 5;
      $audioFile = $_GET['audioFile'] ?? '';
      $fileContent = file_get_contents($target_dir . 'htmlFile.html');
      $options = array('ignore_comments' => true);
      $html2text = new Html2Text($fileContent, $options);
      $textContent = $html2text->getText();
      $words = str_word_count($textContent, 1); // get words as an array
      $chunks = array_chunk($words, $chunkSize);
      echo '<p>' . $textContent . '</p>';
      echo "<script src='../frontend/js/animation.js'></script>";
      echo "<script>StartAnimation('" . htmlspecialchars($audioFile) . "');</script>";     
      ?>
    </div>
  </section>

</body>

</html>