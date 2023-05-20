// var scrollSpeed = 10; // Speed of scrolling in pixels per frame

// function scrollCredits(direction) {
//     var credits = document.getElementById("credits");
//     var currentScroll = window.pageYOffset;
//     var windowHeight = window.innerHeight;
//     var creditsHeight = credits.offsetHeight;
//     var scrollMax = creditsHeight - windowHeight;
    
//     if (direction === "up") {
//         // Scroll up
//         var newScroll = Math.max(currentScroll - scrollSpeed, 0);
//         window.scrollTo(0, newScroll);
//     } else if (direction === "down") {
//         // Scroll down
//         var newScroll = Math.min(currentScroll + scrollSpeed, scrollMax);
//         window.scrollTo(0, newScroll);
//     }
// }

// window.addEventListener("scroll", function() {
//     var scroll = window.pageYOffset;
//     var credits = document.getElementById("credits");
    
//     var topFontSize = 40; // Initial font size at the top
//     var bottomFontSize = 100; // Initial font size at the bottom
//     var fontSizeDifference = bottomFontSize - topFontSize;
//     var windowHeight = window.innerHeight;
//     var creditsHeight = credits.offsetHeight;
//     var scrollMax = creditsHeight - windowHeight;
    
//     // Calculate the new font size based on the scroll position
//     var fontSize = topFontSize + (fontSizeDifference * (scroll / scrollMax));
    
//     // Update the font size
//     credits.style.fontSize = fontSize + "px";
// });

var scrollSpeed = 100; // Speed of scrolling in pixels per frame
var credits = document.getElementById("content");
var scrollHeight = credits.scrollHeight;

function animateScroll() {
    credits.scrollTop += scrollSpeed;
    
    if (credits.scrollTop >= scrollHeight) {
        credits.scrollTop = 0;
    }
}

function startAnimation() {
    setInterval(animateScroll, 30); // Adjust the interval as needed for smooth scrolling
}

startAnimation();

