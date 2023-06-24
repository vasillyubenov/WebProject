<?php
include("authenticate.php");
require('database/database.php');
require_once __DIR__ . '/../vendor/autoload.php';
$target_dir = "uploads/";
$time = date("Y-m-d_H:i:s");
$target_file = "";

$html = $_FILES['htmlFile'];
if (isset($_FILES['htmlFile'])) {
    $file_form_name = "htmlFile";
    upload_file($file_form_name, $target_dir, $time, "html");
}

$audio = $_FILES['audioFile'];
$audio_format = "";
if (isset($audio)) {
    $file_form_name = "audioFile";
    $audio_format = explode("/", $audio["type"])[1];
    upload_file($file_form_name, $target_dir, $time, $audio_format);
}

$text_step = 4;
$playback_step = 0.5;
$shouldPlayReverse = false;
$playButtonShape = "circle";
$pauseButtonShape = "circle";
$playButtonColor = "feda4a";
$pauseButtonColor = "feda4a";
$textColor = "feda4a";

$config = $_FILES["configFile"];
if ($config["size"] > 0) {
    $file_form_name = "audioFile";
    $audio_format = explode("/", $audio["type"])[1];

    $jsonString = file_get_contents($config["tmp_name"]);
    $jsonObject = json_decode($jsonString);
    
    if (!isset($_FILES['htmlFile'])) {
        $time = $jsonObject->time;
    }

    if (!isset($_FILES['audioFile'])) {
        $audio_format = $jsonObject->audio_format;
    }

    $text_step = $jsonObject->text_step;
    $playback_step = $jsonObject->playback_step;
    $shouldPlayReverse = $jsonObject->shouldPlayReverse;
    $playButtonShape = $jsonObject->playButtonShape;
    $pauseButtonShape = $jsonObject->pauseButtonShape;
    $playButtonColor = $jsonObject->playButtonColor;
    $pauseButtonColor = $jsonObject->pauseButtonColor;
    $textColor = $jsonObject->textColor;
}

$owner_id = $_SESSION['id'];

$stmt = $conn->prepare("INSERT INTO presentations (
                                owner_id, 
                                time, 
                                audio_format, 
                                text_step, 
                                playback_step, 
                                play_reverse, 
                                play_button_shape, 
                                pause_button_shape, 
                                play_button_color, 
                                pause_button_color, 
                                text_color) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$values = [
    $owner_id,
    $time,
    $audio_format,
    $text_step,
    $playback_step,
    $shouldPlayReverse,
    $playButtonShape,
    $pauseButtonShape,
    $playButtonColor,
    $pauseButtonColor,
    $textColor
];

$stmt->bind_param("issddisssss", ...$values);

$stmt->execute();
if ($stmt->error) {
    echo "Error: " . $stmt->error;
    exit();
} 

$lastInsertId = $conn->insert_id;
echo "Record inserted successfully.";
$stmt->close();


header("Location: visualize.php?presentationId=" . $lastInsertId);
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