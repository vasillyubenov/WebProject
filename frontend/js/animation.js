class Animation {
    constructor(data, config) {
        this.data = data;
        this.config = config;
    }
    // methods to handle animations
}

window.onload = function() {
    // Get the element and the paragraph
    var element = document.querySelector('.crawl');
    var paragraph = document.querySelector('.crawl > p'); // assuming your text is in a <p> tag within the .crawl div

    // Determine the height of the text
    var textHeight = paragraph.offsetHeight;

    // Calculate the end top position and animation duration based on the text height
    // Here, we're assuming that each 100px of text takes 1 second to scroll past
    var endTopPosition = -textHeight;
    var animationDuration = textHeight / 100 * 1000; // convert from px/100 to milliseconds

    // Calculate the end translateZ position based on the text height
    // Here, we're assuming that each 100px of text moves 50px closer in the z direction
    var endTranslateZ = -textHeight / 2;

    var animation = element.animate([
    { // Start state
        top: '0px',
        transform: 'rotateX(20deg)  translateZ(0)'
    },
    { // End state
        top: `${endTopPosition}px`,
        transform: `rotateX(25deg) translateZ(${endTranslateZ}px)`
    }
    ], {
        duration: animationDuration,
    });
}

function StartAnimation(audioFilePath, playTime) {
    var isPaused = true;
    var delay = 0;
    const delayChangeStep = 1;
    ToggleAnimation();
    // PlayMusic(audioFilePath, playTime);

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

