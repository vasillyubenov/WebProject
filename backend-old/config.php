<?php
require_once __DIR__ . '/../vendor/autoload.php';

$jsonString = file_get_contents($_FILES["configFile"]["tmp_name"]);

$jsonObject = json_decode($jsonString);

$time = $jsonObject->time;
$audio_format = $jsonObject->audio_format;
$text_step = $jsonObject->text_step;
$playback_step = $jsonObject->playback_step;

$shouldPlayReverse = $jsonObject->shouldPlayReverse;
$playButtonShape = $jsonObject->playButtonShape;
$pauseButtonShape = $jsonObject->pauseButtonShape;
$playButtonColor = $jsonObject->playButtonColor;
$pauseButtonColor = $jsonObject->pauseButtonColor;
$textColor = $jsonObject->textColor;

header("Location: visualize.php?time=" . $time
. "&audioFormat=" . $audio_format
. "&textStep=" . $text_step
. "&playbackStep=" . $playback_step
. "&shouldPlayReverse=" . $shouldPlayReverse
. "&playButtonShape=" . $playButtonShape
. "&pauseButtonShape=" . $pauseButtonShape
. "&playButtonColor=" . $playButtonColor
. "&pauseButtonColor=" . $pauseButtonColor
. "&textColor=" . $textColor
);
exit();

?>