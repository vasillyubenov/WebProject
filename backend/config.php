<?php
require_once __DIR__ . '/../vendor/autoload.php';

$jsonString = file_get_contents($_FILES["configFile"]["tmp_name"]);

$jsonObject = json_decode($jsonString);

$time = $jsonObject->time;

header("Location: visualize.php?time=" . $time);
exit();

?>