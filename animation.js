// Function to check if an element is in the viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Function to add animation class to elements when they come into view
function addAnimationToElements() {
    const elements = document.querySelectorAll('.traveltips, .card');
    elements.forEach(element => {
        if (isInViewport(element)) {
            element.classList.add('fadeIn');
            element.classList.remove('fadeOut');
        } else {
            element.classList.remove('fadeIn');
            element.classList.add('fadeOut');
        }
    });
}

// Listen for scroll events and add animation to elements
window.addEventListener('scroll', addAnimationToElements);

// Initial check for elements in view on page load
addAnimationToElements();
