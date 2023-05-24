function StartAnimation() {
  var isPaused = false;
  let topValue = -100;
  let translateZValue = 0;
  let incrementValue = 1;
  const defaultIncrementValue = 1;
  let crawlAnimationInterval;
  const updateTime = 10;
  let fastForwardIntervalId;
  let fastBackwardIntervalId;
  let fastingStep = 4;

  ToggleAnimation();

  document.addEventListener("keydown", function (event) {
    if (event.code === "Space") {
      ToggleAnimation();
    }
  });

  function ToggleAnimation() {
    isPaused = !isPaused;
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
        IncreasePlaybackSpeed();
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
        DecreasePlaybackSpeed();
    }
    });
  })();

  function FastForward() {
    incrementValue = fastingStep;
  }

  function FastBackward() {
    incrementValue = -fastingStep;
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
    audio.playbackRate += 0.3;
  }

  function DecreasePlaybackSpeed() {
    var audio = document.getElementById("audioPlayer");
    audio.playbackRate -= 0.3;
  }
}
