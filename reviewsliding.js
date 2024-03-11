document.addEventListener('DOMContentLoaded', function () {
    const reviewBox = document.getElementById('review-box');
    const reviews = reviewBox.querySelectorAll('.review');
    let currentIndex = 0;
    let intervalId;

    function slideReview() {
        // Hide the current review with slide-out animation
        reviews[currentIndex].classList.remove('active');
        reviews[currentIndex].classList.add('slideOutLeft');

        // Increment index or loop back to the beginning
        currentIndex = (currentIndex + 1) % reviews.length;

        // Show the next review with slide-in animation
        reviews[currentIndex].classList.add('active');
        reviews[currentIndex].classList.remove('slideOutLeft');
        reviews[currentIndex].classList.add('slideInLeft');
    }

    function startSlideInterval() {
        // Start sliding the reviews every 2 seconds
        intervalId = setInterval(slideReview, 1500);
    }

    function stopSlideInterval() {
        // Stop sliding the reviews
        clearInterval(intervalId);
    }

    // Initially show the first review and start the interval
    reviews[currentIndex].classList.add('active');
    reviews[currentIndex].classList.add('slideInLeft');
    startSlideInterval();

    // Pause animation on mouseenter
    reviewBox.addEventListener('mouseenter', function () {
        stopSlideInterval();
    });

    // Resume animation on mouseleave
    reviewBox.addEventListener('mouseleave', function () {
        startSlideInterval();
    });
});
