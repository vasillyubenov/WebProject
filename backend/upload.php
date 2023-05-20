<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Html2Text\Html2Text;

$target_dir = "uploads/";
$target_file = $target_dir . basename("referat.html");
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check file size
if ($_FILES["htmlFile"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["htmlFile"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["htmlFile"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
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
<div class="fade"></div>

<section class="star-wars">
  <div class="crawl">
    <div class="title">
      <p>Episode IV</p>
      <h1>A New Hope</h1>
    </div>

    <?php
    $chunkSize = 5;
    $fileContent = file_get_contents($target_dir . 'referat.html');
    $html2text = new Html2Text($fileContent);
    $textContent = $html2text->getText();
    $words = str_word_count($textContent, 1); // get words as an array
    $chunks = array_chunk($words, $chunkSize);

    echo '<p>'.$textContent.'</p>';
    // foreach ($chunks as $chunk) {
    //     echo '<p>'.implode(' ', $chunk).'</p>'; // implode array to string
    // }
    ?>
  </div>
</section>

</body>
</html>
