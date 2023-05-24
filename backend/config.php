<?php
require_once __DIR__ . '/../vendor/autoload.php';

$jsonString = file_get_contents($_FILES["configFile"]["tmp_name"]);

$jsonObject = json_decode($jsonString);

$time = $jsonObject->time;
$audio_format = $jsonObject->audio_format;
$text_step = $jsonObject->text_step;
$playback_step = $jsonObject->playback_step;

header("Location: visualize.php?time=" . $time
. "&audioFormat=" . $audio_format
. "&textStep=" . $text_step
. "&playbackStep=" . $playback_step
);
exit();

?>