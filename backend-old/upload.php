<?php
require_once __DIR__ . '/../vendor/autoload.php';

$target_dir = "uploads/";
$curent_datetime = date("Y:m:d_H:i:s");
$target_file = "";

$html = $_FILES['htmlFile'];
if (isset($_FILES['htmlFile'])) {
    $file_form_name = "htmlFile";
    upload_file($file_form_name, $target_dir, $curent_datetime, "html");
}

$audio = $_FILES['audioFile'];
$audio_format = "";
if (isset($audio)) {
    $file_form_name = "audioFile";
    $audio_format = explode("/", $audio["type"])[1];
    upload_file($file_form_name, $target_dir, $curent_datetime, $audio_format);
}

// echo "Location: visualize.php?time=" . $curent_datetime . "&audioFormat=". $audio_format;
header("Location: visualize.php?time=" . $curent_datetime . "&audioFormat=". $audio_format);
exit();

function upload_file($file_form_name, $target_dir, $curent_datetime, $format)
{
    $target_file = $target_dir . basename($curent_datetime . $file_form_name);
    if (move_uploaded_file($_FILES[$file_form_name]["tmp_name"], $target_file . "." . $format)) {
        echo "The file " . basename($_FILES[$file_form_name]["name"]) . " has been uploaded.\n";
    } else {
        echo "Sorry, there was an error uploading your " . basename($_FILES[$file_form_name]["name"]) . "\n";
        return;
    }
}
?>