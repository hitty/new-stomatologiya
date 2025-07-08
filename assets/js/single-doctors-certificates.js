document.addEventListener('DOMContentLoaded', function () {
    const certImages = document.querySelectorAll('.certificate-img');
    const modal = document.getElementById('certModal');
    const modalContent = document.getElementById('certModalContent');
    const closeBtn = document.querySelector('.cert-modal-close');

    if (certImages) {
        certImages.forEach(img => {
            img.addEventListener('click', () => {
                modalContent.innerHTML = `<img src="${img.dataset.full}" alt="Certificate">`;
                modal.style.display = 'flex';
            });
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Карусель
    const carousel = document.querySelector('.certificates-wrapper.has-carousel');
    if (!carousel) return;

    const prevBtn = document.querySelector('.prev-arrow');
    const nextBtn = document.querySelector('.next-arrow');

    if (!prevBtn || !nextBtn) return; // Без кнопок навигации ничего не делаем

    // Ширина одного сертификата + gap (10px)
    const gap = 10;
    const item = carousel.querySelector('.certificate-item');
    if (!item) return;

    // Получаем точную ширину элемента вместе с gap для прокрутки
    const itemWidth = item.offsetWidth + gap;

    prevBtn.addEventListener('click', () => {
        carousel.scrollBy({left: -itemWidth, behavior: 'smooth'});
    });

    nextBtn.addEventListener('click', () => {
        carousel.scrollBy({left: itemWidth, behavior: 'smooth'});
    });
});