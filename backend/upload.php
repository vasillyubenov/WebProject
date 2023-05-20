<?php
require_once __DIR__ . '/../vendor/autoload.php';

$target_dir = "uploads/";
$curent_datetime = date("Y:m:d_H:i:s");

if (isset($_FILES['htmlFile'])) {
    $file_form_name = "htmlFile";
    upload_file($file_form_name, $target_dir, $curent_datetime);
}

if (isset($_FILES['audioFile'])) {
    $file_form_name = "audioFile";
    upload_file($file_form_name, $target_dir, $curent_datetime);
}

header("Location: visualize.php?time=" . $curent_datetime);
exit();

function upload_file($file_form_name, $target_dir, $curent_datetime)
{
    $target_file = $target_dir . basename($curent_datetime . $file_form_name);
    // echo $target_file."\n";
    // echo $_FILES."\n";
    // print_r($_FILES[$file_form_name]);
    if (move_uploaded_file($_FILES[$file_form_name]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES[$file_form_name]["name"]) . " has been uploaded.\n";
    } else {
        echo "Sorry, there was an error uploading your " . basename($_FILES[$file_form_name]["name"]) . "\n";
        return;
    }
}
?>