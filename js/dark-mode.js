document.addEventListener('DOMContentLoaded', function () {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;
    const toggleBall = document.querySelector('.toggle-ball');
    const sunIcon = document.querySelector('.dark-mode-label .sun');
    const moonIcon = document.querySelector('.dark-mode-label .moon');

    // Constants for animation
    const ANIMATION_DURATION = 500;
    
    function getTranslateDistance() {
        return window.matchMedia('(max-width: 768px)').matches ? 20 : 24;
    }

    function setVisualState(isDark, animate = false) {
        const distance = getTranslateDistance();
        const ballTransform = isDark ? `translateX(${distance}px)` : 'translateX(0)';
        const sunTransform = isDark ? 'scale(0)' : 'scale(1)';
        const sunOpacity = isDark ? 0 : 1;
        const moonTransform = isDark ? 'scale(1)' : 'scale(0)';
        const moonOpacity = isDark ? 1 : 0;

        if (animate) {
            // Ball Animation
            toggleBall.animate([
                { transform: toggleBall.style.transform || 'translateX(0)' },
                { transform: ballTransform }
            ], { duration: 300, easing: 'ease-out', fill: 'forwards' });

            // Icons Animation
            sunIcon.animate([
                { transform: sunIcon.style.transform || 'scale(1)', opacity: sunIcon.style.opacity || 1 },
                { transform: sunTransform, opacity: sunOpacity }
            ], { duration: 300, easing: 'ease-out', fill: 'forwards' });

            moonIcon.animate([
                { transform: moonIcon.style.transform || 'scale(0)', opacity: moonIcon.style.opacity || 0 },
                { transform: moonTransform, opacity: moonOpacity }
            ], { duration: 300, easing: 'ease-out', fill: 'forwards' });

        } else {
            // Set immediately (initial load)
            toggleBall.style.transform = ballTransform;
            sunIcon.style.transform = sunTransform;
            sunIcon.style.opacity = sunOpacity;
            moonIcon.style.transform = moonTransform;
            moonIcon.style.opacity = moonOpacity;
        }
    }

    // Initial Setup
    const savedMode = localStorage.getItem('darkMode');
    const isDark = savedMode === 'enabled';
    
    if (isDark) {
        body.classList.add('dark-mode');
        darkModeToggle.checked = true;
    }
    setVisualState(isDark, false);

    // Toggle Event
    darkModeToggle.addEventListener('change', function () {
        const isNowDark = this.checked;
        const translateDistance = getTranslateDistance();

        // 1. Capture current colors (before class toggle)
        const startBg = getComputedStyle(body).backgroundColor;
        const startColor = getComputedStyle(body).color;

        // 2. Toggle Class and Save
        if (isNowDark) {
            body.classList.add('dark-mode');
            localStorage.setItem('darkMode', 'enabled');
        } else {
            body.classList.remove('dark-mode');
            localStorage.setItem('darkMode', 'disabled');
        }

        // 3. Capture new colors (after class toggle)
        const endBg = getComputedStyle(body).backgroundColor;
        const endColor = getComputedStyle(body).color;

        // 4. Animate Body Colors
        body.animate([
            { backgroundColor: startBg, color: startColor },
            { backgroundColor: endBg, color: endColor }
        ], {
            duration: ANIMATION_DURATION,
            easing: 'ease'
        });

        // 5. Animate Toggle Elements
        setVisualState(isNowDark, true);
    });
    
    // Handle Resize (Update ball position if screen size changes)
    window.addEventListener('resize', () => {
        const currentIsDark = darkModeToggle.checked;
        setVisualState(currentIsDark, false);
    });
});