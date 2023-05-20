class Animation {
    constructor(data, config) {
        this.data = data;
        this.config = config;
    }
    // methods to handle animations
}

function StartAnimation(audioFilePath, playTime) {
    var isPaused = true;
    var delay = 0;
    const delayChangeStep = 1;
    ToggleAnimation();
    PlayMusic(audioFilePath, playTime);

    document.addEventListener('keydown', function(event) {
        if (event.code === 'Space') {
            ToggleAnimation();
        }
    });

    document.addEventListener('keyup', function(event) {
        if (event.code === 'ArrowRight') {
            // Reset the speed of the animation back to its original duration
            DecreaseDelay();
        }
    });

    document.addEventListener('keyup', function(event) {
        if (event.code === 'ArrowLeft') {
            // Reset the speed of the animation back to its original duration
            IncreaseDelay();
        }
    });

    function ToggleAnimation() {
        isPaused = !isPaused;
        document.querySelector('.crawl').style.animationPlayState = isPaused ? 'paused' : 'running';
    }

    function IncreaseDelay() {
        var scrollText = document.querySelector('.crawl');
        delay += delayChangeStep;
        scrollText.style.animationDelay = `${delay}s`;
    }

    function DecreaseDelay() {
        var scrollText = document.querySelector('.crawl');
        delay -= delayChangeStep;
        scrollText.style.animationDelay = `${delay}s`;
    }

    function PlayMusic(filename, playTime) {
        console.log(filename);
        const defaultAudioPath = "../assets/audio/Star_Wars_Main_Theme.mp3";
        
        audio = new Audio(filename !== "" ? filename : defaultAudioPath);
        audio.play();

        if (playTime) {
            audio.currentTime = playTime;
        }
    }
};

