function StartAnimation(config) {
  const translateZValue = 20;
  const updateTime = 10;
  let incrementValue = config.shouldPlayReverse ? 1 : -1;
  const defaultIncrementValue = incrementValue;
  let crawlAnimationInterval;
  let fastForwardIntervalId;
  let fastBackwardIntervalId;
  let isPaused = false;
  let translateYValue = -100;
  textFastingStep = config.text_step;
  playbackStep = config.playback_step;

  let playButton = document.getElementById("play");
  let pauseButton = document.getElementById("pause");

  playButton.addEventListener("click", function (event) {
    ToggleAnimation();
  });

  pauseButton.addEventListener("click", function (event) {
    ToggleAnimation();
  });
  
  if (config.shouldPlayReverse) { 
    const crawlElement = document.getElementById("crawl");
    // Subtract the height of the viewport from the scroll height of the element to get the initial top value
    translateYValue = -(crawlElement.scrollHeight + window.innerHeight);
  }

  SetButton(playButton, config, true);
  SetButton(pauseButton, config, false);
  SetTextColor(config.textColor);

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
    
    if (isPaused && playButton.style.display !== "none") {
      playButton.style.display = "block";
      pauseButton.style.display = "none";
    }
    else {
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

  function SetTextColor(textColor) {
    if (textColor) {
      let crawl = document.getElementById("crawl");
      crawl.style.color = textColor;
    }
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
        ClearPlaybackRate();
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
        ClearPlaybackRate();
      }
    });

    document.addEventListener("keydown", function(event) {
      var audio = document.getElementById("audioPlayer");
      
      // Increase volume on up key press
      if (event.key === "ArrowUp") {
        event.preventDefault();
        audio.volume += 0.1; // Increasing volume by 10%
        if (audio.volume > 1) {
          audio.volume = 1;
        }
      }
      
      // Decrease volume on down key press
      if (event.key === "ArrowDown") {
        event.preventDefault();
        audio.volume -= 0.1; // Decreasing volume by 10%
        if (audio.volume < 0) {
          audio.volume = 0;
        }
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
      document.getElementById("crawl").style.transform = `rotateX(25deg) translateY(${translateYValue}px) translateZ(${translateZValue}px)`;
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

  function ClearPlaybackRate() {
    var audio = document.getElementById("audioPlayer");
    audio.playbackRate = 1;
  }
}

function SetButton(button, config, isPlayButton = false) {
  let shouldHaveBackground = true;

  switch (isPlayButton ? config.playButtonShape : config.pauseButtonShape) {
    case "circle":
      button.style.borderRadius = "50%";
      break;
    case "square":
      button.style.borderRadius = "0";
      break;
    case "none":
      button.style.backgroundColor = "rgba(0, 0, 0, 0)";
      shouldHaveBackground = false;
      break;
    default:
      button.style.borderRadius = "50%";
      break;
  }

  if (shouldHaveBackground) {
    button.style.backgroundColor = isPlayButton ? config.playButtonColor : config.pauseButtonColor;
  }
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
    playButtonColor: "#feda4a",
    pauseButtonColor: "#feda4a",
    textColor: "#feda4a",
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
