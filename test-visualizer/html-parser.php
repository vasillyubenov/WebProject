<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="scrolling-text-container">
        <div class="scrolling-text">
            <div id="content">
                <?php
                require_once __DIR__ . '/../vendor/autoload.php';
                use Html2Text\Html2Text;

                $htmlFile = '/Users/aleks.kolachev/Uni/web/referat/referat.html';
                $htmlContent = file_get_contents($htmlFile);
                $html2text = new Html2Text($htmlContent);
                $textContent = $html2text->getText();
                // $textContent = str_replace('*', "\n\n", $textContent);
                
                echo $htmlContent;

                ?>
            </div>
        </div>
    </div>


    <!-- <script src="script.js"></script> -->
    <!-- <button onclick="scrollCredits('up')">Scroll Up</button>
    <button onclick="scrollCredits('down')">Scroll Down</button> -->

</body>

</html>