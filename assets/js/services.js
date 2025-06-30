document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.filter-button');
  const categories = document.querySelectorAll('.service-category');
  const breadcrumbCurrent = document.querySelector('.breadcrumb-item.current');

  buttons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const group = this.dataset.group;
      const isActive = this.classList.contains('active');

      // Сброс активных кнопок
      buttons.forEach(btn => btn.classList.remove('active'));

      if (isActive) {
        // Если нажали повторно на активную — показываем все
        categories.forEach(category => category.style.display = '');
        if (breadcrumbCurrent) {
          breadcrumbCurrent.textContent = 'Все услуги клиники';
        }
      } else {
        // Активируем кнопку
        this.classList.add('active');

        // Фильтрация
        categories.forEach(category => {
          if (category.dataset.group === group) {
            category.style.display = '';
          } else {
            category.style.display = 'none';
          }
        });

        if (breadcrumbCurrent) {
          breadcrumbCurrent.textContent = group;
        }
      }
    });
  });
});