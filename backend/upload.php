<?php
require_once __DIR__ . '/../vendor/autoload.php';
$target_dir = "uploads/";
$curent_datetime = date("Y-m-d_H-i-s");
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


include("authenticate.php");
require('database/database.php');

$query = "INSERT INTO presentations (id) VALUES ('$curent_datetime')";
$result = mysqli_query($con, $query);
if ($result) {
    echo "<div class='form'>
              <h3>Uploaded successfully.</h3><br/>
              </div>";
} else {
    echo "<div class='form'>
              <h3>Something went wrong</h3><br/>
              </div>";
}

$id = $_SESSION['id'];

$query = "INSERT INTO users_have_presentations (user_id, presentation_id) VALUES ($id, '$curent_datetime')";
echo $query;
$result = mysqli_query($con, $query);
if ($result) {
    echo "<div class='form'>
              <h3>Uploaded successfully.</h3><br/>
              </div>";
} else {
    echo "<div class='form'>
              <h3>Something went wrong</h3><br/>
              </div>";
}

header("Location: visualize.php?time=" . $curent_datetime . "&audioFormat=" . $audio_format);
exit();

function upload_file($file_form_name, $target_dir, $curent_datetime, $format)
{
    $target_file = $target_dir . basename($curent_datetime . $file_form_name);
    if (move_uploaded_file($_FILES[$file_form_name]["tmp_name"], $target_file . "." . $format)) {
        echo "The file " . basename($_FILES[$file_form_name]["name"]) . " has been uploaded.\n";
    } else {
        echo "Sorry, there was an error uploading your " . basename($_FILES[$file_form_name]["name"]) . "\n";
    }
}
?>