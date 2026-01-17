document.addEventListener('DOMContentLoaded', function () {
    const backToTopButton = document.getElementById('back-to-top');

    if (backToTopButton) {
        // Scroll to top functionality
        backToTopButton.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Toggle visibility function
        function toggleBackToTop() {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        }

        // Add scroll listener
        window.addEventListener('scroll', toggleBackToTop);

        // Initial check in case page is reloaded scrolled down
        toggleBackToTop();
    }
});