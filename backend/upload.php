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
    require_once __DIR__ . '/../vendor/autoload.php';
    use Html2Text\Html2Text;

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