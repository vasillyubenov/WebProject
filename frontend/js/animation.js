var textFastingStep = 4;
var playbackStep = 0.3;
let playButton;
let pauseButton;

document.addEventListener("DOMContentLoaded", () => {
  playButton = document.getElementById("play");
  pauseButton = document.getElementById("pause");

  playButton.addEventListener("click", function (event) {
    StartAnimation();
    if (playButton) {
      playButton.style.display = "none";
    }
  });

  pauseButton.addEventListener("click", function (event) {
    StartAnimation();
    if (playButton) {
      playButton.style.display = "none";
    }
  });
});

function StartAnimation(config) {
  const translateZValue = 20;
  const updateTime = 10;
  let incrementValue = config.shouldPlayReverse ? 1 : -1;
  // let incrementValue = true ? 1 : -1;
  const defaultIncrementValue = incrementValue;
  let crawlAnimationInterval;
  let fastForwardIntervalId;
  let fastBackwardIntervalId;
  let isPaused = false;
  let translateYValue = -100;
  textFastingStep = config.text_step;
  playbackStep = config.playback_step;
  
  if (config.shouldPlayReverse) { 
    const crawlElement = document.getElementById("crawl");
    // Subtract the height of the viewport from the scroll height of the element to get the initial top value
    translateYValue = -(crawlElement.scrollHeight + window.innerHeight);
  }

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
    incrementValue = config.shouldPlayReverse ? textFastingStep : -textFastingStep;
  }

  function FastBackward() {
    incrementValue = config.shouldPlayReverse ? -textFastingStep : textFastingStep;
  }

  function StartAnimationLoop() {
    crawlAnimationInterval = setInterval(function () {
      translateYValue += incrementValue;
      document.getElementById("crawl").style = `transform: rotateX(25deg) translateY(${translateYValue}px) translateZ(${translateZValue}px);`;
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
