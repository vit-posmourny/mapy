const scrollContainer = document.getElementById("scroll-container");


function isPortrait() {
    return window.matchMedia('(orientation: portrait)').matches;
}


if (isPortrait()) {
    document.addEventListener("DOMContentLoaded", function () {
       // Restore scroll position
        const savedScrollPosition = localStorage.getItem("scrollPosition");
        if (savedScrollPosition) {
            scrollContainer.scrollLeft = parseInt(savedScrollPosition, 10);
        }

        // Save scroll position on scroll
        scrollContainer.addEventListener("scroll", function () {
            localStorage.setItem("scrollPosition", scrollContainer.scrollLeft);
        });
    });
}