jQuery(document).ready(function ($) {
    //инициализация select2
    if ($('.select2-enable').length) {
        $('.select2-enable').each(function () {
            var _class = $(this).hasClass('topnav-location') ? 'locations-list' : '';
            $(this).select2({
                minimumResultsForSearch: Infinity
            });
        })
    }
})

document.addEventListener('DOMContentLoaded', function () {
    const openButtons = document.querySelectorAll('[data-popup-target]');
    const closeButtons = document.querySelectorAll('[data-close]');
    const popups = document.querySelectorAll('[data-popup]');
    // Открытие попапа
    openButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const selector = btn.getAttribute('data-popup-target');
            const popup = document.querySelector(selector);
            if (popup) {
                popup.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // Закрытие попапа по крестику
    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const popup = btn.closest('[data-popup]');
            popup.classList.add('hidden');
            document.body.style.overflow = 'visible';
        });
    });

    // Закрытие по клику вне попапа
    popups.forEach(popup => {
        popup.addEventListener('click', (e) => {
            if (!e.target.closest('.popup')) {
                popup.classList.add('hidden');
                document.body.style.overflow = 'visible';
            }
        });
    });

    // Закрытие по ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            popups.forEach(popup => popup.classList.add('hidden'));
            document.body.style.overflow = 'visible';
        }
    });

    // Пример обработки форм (для всех попапов)
    popups.forEach(popup => {
        const form = popup.querySelector('form');
        if (form) {
            const submitBtn = form.querySelector('[type="submit"]');
            const requiredFields = form.querySelectorAll('[required]');
            const emailField = form.querySelector('input[name="email"]');

            const createError = (input, message) => {
                input.classList.add('error');
                let error = input.parentElement.querySelector('.error-message');
                if (!error) {
                    error = document.createElement('div');
                    error.className = 'error-message';
                    error.style.color = 'red';
                    error.style.fontSize = '12px';
                    input.parentElement.appendChild(error);
                }
                error.textContent = message;
            };

            const clearError = (input) => {
                input.classList.remove('error');
                const error = input.parentElement.querySelector('.error-message');
                if (error) error.remove();
            };

            const validateField = (input, button_check) => {
                if (button_check === false) clearError(input);
                if (input.hasAttribute('required') && input.value.trim() === '') {
                    if (button_check === false) createError(input, 'Обязательное поле');
                    return false;
                }
                if (input.name === 'email') {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(input.value.trim())) {
                        if (button_check === false) createError(input, 'Введите верный email');
                        return false;
                    }
                }
                return true;
            };

            const checkFormValid = (button_check = true) => {
                let isValid = true;
                requiredFields.forEach((input) => {
                    if (!validateField(input, button_check)) isValid = false;
                });
                submitBtn.disabled = !isValid;
                return isValid;
            };

            requiredFields.forEach(input => {
                input.addEventListener('input', () => {
                    validateField(input, false);
                    checkFormValid(true);
                });
            });

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                if (!checkFormValid(false)) return;

                const formData = new FormData(form);
                formData.append('action', 'form_send'); // Название WP-экшена

                submitBtn.disabled = true;

                fetch('/wp-admin/admin-ajax.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(res => {
                        console.log(res);
                        res.json()
                    })
                    .then(data => {
                        form.reset();
                        document.location.href = '/thank-you/?callback'
                    })
                    .catch(() => {
                        alert('Ошибка отправки.');
                        submitBtn.disabled = false;
                    });
            });
        }
    });

});