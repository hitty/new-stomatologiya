document.addEventListener('DOMContentLoaded', function () {
    const accordionCards = document.querySelectorAll('.accordion-card,.accordion-item');
    if (accordionCards) {
        accordionCards.forEach(card => {
            console.log(accordionCards)
            const header = card.querySelector('.accordion-header');
            const toggleIcon = card.querySelector('.accordion-toggle');

            // ✅ Если карточка уже активна при загрузке — ставим .rotated на иконку
            if (card.classList.contains('active') && toggleIcon) {
                toggleIcon.classList.add('rotated');
            }

            header.addEventListener('click', function () {
                const isActive = card.classList.contains('active');

                // Снимаем активность и вращение со всех
                accordionCards.forEach(c => {
                    c.classList.remove('active');
                    const icon = c.querySelector('.accordion-toggle');
                    if (icon) icon.classList.remove('rotated');
                });

                // Если не активен — активируем и прокручиваем
                if (!isActive) {
                    card.classList.add('active');
                    if (toggleIcon) toggleIcon.classList.add('rotated');

                    setTimeout(() => {
                        const rect = card.getBoundingClientRect();
                        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                        const offsetTop = rect.top + scrollTop - 150;

                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }, 350);
                }
            });
        });
    }
});