import './bootstrap';

// ===== Floating icons animation =====
document.querySelectorAll('.animate-bounce-slow').forEach(el => {
    const duration = 4000 + Math.random() * 3000;      // random speed
    const amplitude = 15 + Math.random() * 15;        // vertical movement
    const rotate = 5 + Math.random() * 10;            // rotation degrees

    el.animate(
        [
            { transform: `translate(0, 0px) rotate(0deg)` },
            { transform: `translate(${Math.random() * 10 - 5}px, -${amplitude}px) rotate(-${rotate}deg)` },
            { transform: `translate(${Math.random() * 10 - 5}px, 0px) rotate(${rotate}deg)` },
            { transform: `translate(${Math.random() * 10 - 5}px, ${amplitude / 2}px) rotate(-${rotate / 2}deg)` },
            { transform: `translate(0, 0px) rotate(0deg)` },
        ],
        {
            duration: duration,
            iterations: Infinity,
            easing: 'ease-in-out',
            direction: 'alternate',
        }
    );
});

// ===== Swiper carousel setup =====
import Swiper, { Navigation, Pagination, Autoplay } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

Swiper.use([Navigation, Pagination, Autoplay]);

// Hero carousel
const heroSwiper = new Swiper('.swiper', {
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
});

// Featured products carousel
const featuredSwiper = new Swiper('.featured-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    navigation: {
        nextEl: '.featured-swiper .swiper-button-next',
        prevEl: '.featured-swiper .swiper-button-prev',
    },
    pagination: {
        el: '.featured-swiper .swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        640: { slidesPerView: 2 },
        1024: { slidesPerView: 3 },
    },
});
