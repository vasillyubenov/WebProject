var textFastingStep = 4;
var playbackStep = 0.3;
let playButton;
let pauseButton;

document.addEventListener("DOMContentLoaded", () => {
  playButton = document.getElementById("play");
  pauseButton = document.getElementById("pause");

  playButton.addEventListener("click", function (event) {
    StartAnimation();
    playButton.style.display = "none";
  });

  pauseButton.addEventListener("click", function (event) {
    StartAnimation();
    playButton.style.display = "none";
  });
});

function StartAnimation(config) {
  textFastingStep = config.text_step;
  playbackStep = config.playback_step;
  
  var isPaused = false;
  let topValue = -100;
  // if (config.shouldPlayReverse) { 
  if (true) { 
    const crawlElement = document.getElementById("crawl");
    // Subtract the height of the viewport from the scroll height of the element to get the initial top value
    topValue = -(crawlElement.scrollHeight - window.innerHeight);
  }
  let translateZValue = 0;
  
  if (true) {
    translateZValue = topValue * 0.41;
  }

  let incrementValue = true ? -1 : 1;
  const defaultIncrementValue = incrementValue;
  let crawlAnimationInterval;
  const updateTime = 10;
  let fastForwardIntervalId;
  let fastBackwardIntervalId;

  if (!playButton) {
    playButton = document.getElementById("play");
  }

  if (!pauseButton) {
    pauseButton = document.getElementById("pause");
  }

  SetButton(playButton, config, true);
  SetButton(pauseButton, config, false);

  ToggleAnimation();

  document.addEventListener("keydown", function (event) {
    if (event.code === "Space") {
      ToggleAnimation();
    }
  });

  function ToggleAnimation() {
    isPaused = !isPaused;

    if (pauseButton) {
      pauseButton.style.display = isPaused ? "block" : "none";
    }

    if (!isPaused && playButton.style.display !== "none") {
      playButton.style.display = "none";
    }

    if (!isPaused) {
      StartAnimationLoop();
      PlayAudio();
      return;
    }

    PauseAnimationLoop();
    PauseAudio();
  }

  (function ActivateControls() {
    //Activating fast backward
    window.addEventListener("keydown", function (event) {
      if (event.key === "ArrowLeft" && fastBackwardIntervalId == null) {
        fastBackwardIntervalId = setInterval(FastBackward, 100);
        DecreasePlaybackSpeed();
      }
    });

    window.addEventListener("keyup", function (event) {
      if (event.key === "ArrowLeft" && fastBackwardIntervalId != null) {
        clearInterval(fastBackwardIntervalId);
        fastBackwardIntervalId = null;
        incrementValue = defaultIncrementValue;
        ClearUgabuga();
      }
    });

    //Activating fast forward
    window.addEventListener("keydown", function (event) {
      if (event.key === "ArrowRight" && fastForwardIntervalId == null) {
        fastForwardIntervalId = setInterval(FastForward, 100);
        IncreasePlaybackSpeed();
      }
    });

    window.addEventListener("keyup", function (event) {
      if (event.key === "ArrowRight" && fastForwardIntervalId != null) {
        clearInterval(fastForwardIntervalId);
        fastForwardIntervalId = null;
        incrementValue = defaultIncrementValue;
        ClearUgabuga();
      }
    });
  })();

  function FastForward() {
    incrementValue = textFastingStep;
  }

  function FastBackward() {
    incrementValue = -textFastingStep;
  }

  function StartAnimationLoop() {
    crawlAnimationInterval = setInterval(function () {
      topValue -= incrementValue;
      translateZValue -= incrementValue * 0.41;
      document.getElementById("crawl").style = `
                  top: ${topValue}px;
                  transform: rotateX(25deg) translateZ(${translateZValue}px);
              `;
    }, updateTime);
  }

  function PauseAnimationLoop() {
    if (crawlAnimationInterval) {
      clearInterval(crawlAnimationInterval);
    }
  }

  function PlayAudio() {
    var audio = document.getElementById("audioPlayer");
    audio.play();
  }

  function PauseAudio() {
    var audio = document.getElementById("audioPlayer");
    audio.pause();
  }

  function IncreasePlaybackSpeed() {
    var audio = document.getElementById("audioPlayer");
    audio.playbackRate += playbackStep;
  }

  function DecreasePlaybackSpeed() {
    var audio = document.getElementById("audioPlayer");
    if (audio.playbackRate - playbackStep > 0) {
      audio.playbackRate -= playbackStep;
    } else {
      audio.playbackRate = 1;
    }
  }

  function ClearUgabuga() {
    var audio = document.getElementById("audioPlayer");
    audio.playbackRate = 1;
  }
}

function SetButton(button, config, isPlayButton = false) {
  switch (isPlayButton ? config.playButtonShape : config.pauseButtonShape) {
    case "circle":
      button.style.borderRadius = "50%";
      break;
    case "square":
      button.style.borderRadius = "0";
      break;
    default:
      button.style.borderRadius = "50%";
      break;
  }

  button.style.backgroundColor = isPlayButton ? config.playButtonColor : config.pauseButtonColor;
}

function GenerateConfig(_time, _audio_format) {
  var config = {
    time: _time,
    audio_format: _audio_format,
    text_step: textFastingStep,
    playback_step: playbackStep,
    shouldPlayReverse: false,
    playButtonShape: "circle",
    pauseButtonShape: "circle",
    playButtonColor: "feda4a",
    pauseButtonColor: "feda4a",
    textColor: "feda4a",
  };

  var configJSON = JSON.stringify(config, null, 2);

  var blob = new Blob([configJSON], { type: "application/json" });

  var url = URL.createObjectURL(blob);

  var link = document.createElement("a");
  link.href = url;
  link.download = "config.json";

  link.click();

  URL.revokeObjectURL(url);
}
