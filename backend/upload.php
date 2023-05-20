<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Html2Text\Html2Text;

$target_dir = "uploads/";
$target_file = $target_dir . basename("referat.html");
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

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


$htmlFile = 'uploads/referat.html';
$htmlContent = file_get_contents($htmlFile);
$html2text = new Html2Text($htmlContent);
$textContent = $html2text->getText();

echo $textContent;
?>