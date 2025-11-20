import './bootstrap';
document.querySelectorAll('.animate-bounce-slow').forEach(el => {
    el.animate(
        [
            { transform: 'translateY(0px)' },
            { transform: 'translateY(-20px)' },
            { transform: 'translateY(0px)' }
        ],
        {
            duration: 3000 + Math.random() * 2000,
            iterations: Infinity
        }
    );
});
