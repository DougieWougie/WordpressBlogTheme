document.addEventListener('DOMContentLoaded', function() {
    // Elements to animate
    const elements = [
        document.getElementById('masthead'),
        document.querySelector('.site-main'),
        document.querySelector('.site-footer')
    ];

    // Filter out nulls in case some elements are missing
    const targets = elements.filter(el => el);

    // Initial state: Hide them immediately
    // Note: ideally this is done in CSS to avoid FOUC, but we are moving logic to JS.
    targets.forEach(el => {
        el.style.opacity = '0';
    });

    // Staggered Fade In
    targets.forEach((el, index) => {
        el.animate([
            { opacity: 0, transform: 'translateY(10px)' },
            { opacity: 1, transform: 'translateY(0)' }
        ], {
            duration: 800,
            delay: index * 200, // 200ms stagger
            easing: 'ease-out',
            fill: 'forwards'
        });
    });
});
