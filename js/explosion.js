document.addEventListener('click', function(e) {
    const link = e.target.closest('a');
    
    // Only trigger if it's a link and not a modifier click (new tab)
    if (!link || e.ctrlKey || e.metaKey || e.shiftKey || e.button !== 0) return;

    // Optional: Don't explode on anchor links on the same page if you prefer
    // if (link.getAttribute('href').startsWith('#')) return;

    e.preventDefault();

    const x = e.clientX;
    const y = e.clientY;

    createExplosion(x, y);

    // Wait for animation (approx 800ms) then navigate
    setTimeout(() => {
        window.location.href = link.href;
    }, 800);
});

function createExplosion(x, y) {
    const particleCount = 30;
    const colors = ['#D35400', '#E67E22', '#3E2723', '#FFF8E1']; // Theme colors

    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('explosion-particle');
        document.body.appendChild(particle);

        // Initial Position
        const size = 5 + Math.random() * 10;
        particle.style.position = 'fixed';
        particle.style.left = `${x}px`;
        particle.style.top = `${y}px`;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        particle.style.borderRadius = '50%';
        particle.style.pointerEvents = 'none';
        particle.style.zIndex = '9999';

        // Random destination
        const angle = Math.random() * Math.PI * 2;
        const velocity = 100 + Math.random() * 200; // Distance
        const tx = Math.cos(angle) * velocity;
        const ty = Math.sin(angle) * velocity;

        // Animation
        const animation = particle.animate([
            { transform: 'translate(-50%, -50%) scale(1)', opacity: 1 },
            { transform: `translate(calc(-50% + ${tx}px), calc(-50% + ${ty}px)) scale(0)`, opacity: 0 }
        ], {
            duration: 800 + Math.random() * 400,
            easing: 'cubic-bezier(0, .9, .57, 1)',
        });

        // Cleanup
        animation.onfinish = () => particle.remove();
    }
}
