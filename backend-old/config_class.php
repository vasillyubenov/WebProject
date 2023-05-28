<?php

$playback_step = 0.5;
if (isset($_GET["playbackStep"])) {
  $playback_step = $_GET["playbackStep"];
}
$shouldPlayReverse = false;
if (isset($_GET["shouldPlayReverse"])) {
  $shouldPlayReverse = $_GET["shouldPlayReverse"];
}
$playButtonShape = "circle";
if (isset($_GET["playButtonShape"])) {
  $playButtonShape = $_GET["playButtonShape"];
}
$pauseButtonShape = "circle";
if (isset($_GET["pauseButtonShape"])) {
  $playButtonShape = $_GET["pauseButtonShape"];
}
$playButtonColor = "feda4a";
if (isset($_GET["playButtonColor"])) {
  $playButtonColor = $_GET["playButtonColor"];
}
$pauseButtonColor = "feda4a";
if (isset($_GET["pauseButtonColor"])) {
  $pauseButtonColor = $_GET["pauseButtonColor"];
}
$textColor = "feda4a";
if (isset($_GET["textColor"])) {
  $textColor = $_GET["textColor"];
}

class Config {
    public $time;
    public $text_step;
    public $playback_step;
    public $shouldPlayReverse;
    public $playButtonShape;
    public $pauseButtonShape;
    public $playButtonColor;
    public $pauseButtonColor;
    public $textColor;
    
    public function __construct($time, $text_step, $playback_step, $shouldPlayReverse, $playButtonShape, $pauseButtonShape, $playButtonColor, $pauseButtonColor, $textColor) {
        $this->time = $time;
        $this->text_step = $text_step;
        $this->playback_step = $playback_step;
        $this->shouldPlayReverse = $shouldPlayReverse;
        $this->playButtonShape = $playButtonShape;
        $this->pauseButtonShape = $pauseButtonShape;
        $this->playButtonColor = $playButtonColor;
        $this->pauseButtonColor = $pauseButtonColor;
        $this->textColor = $textColor;
    }

    public function __toString() {
        return json_encode($this);
    }
}

?>