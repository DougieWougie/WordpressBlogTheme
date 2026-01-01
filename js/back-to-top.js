document.addEventListener('DOMContentLoaded', function () {
    const backToTopButtons = document.querySelectorAll('.back-to-top-button');

    backToTopButtons.forEach(button => {
        button.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
});