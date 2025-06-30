// assets/js/reviews.js
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.yandex-reviews-container');
    const prevBtn = document.querySelector('.prev-arrow');
    const nextBtn = document.querySelector('.next-arrow');
    
    if (!container || !prevBtn || !nextBtn) return;
    
    const scrollAmount = 400;
    
    prevBtn.addEventListener('click', () => {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });
    
    nextBtn.addEventListener('click', () => {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
    
    // Инициализация iframe после загрузки
    const iframes = container.querySelectorAll('iframe');
    iframes.forEach(iframe => {
        iframe.onload = function() {
            console.log('Yandex reviews iframe loaded');
        };
    });
});