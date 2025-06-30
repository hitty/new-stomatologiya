document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.filter-button');
  const articles = document.querySelectorAll('.article-card');
  const breadcrumbCurrent = document.querySelector('.breadcrumb-item.current');

  buttons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const filterValue = this.dataset.filter;
      const isActive = this.classList.contains('active');

      // Сброс активных кнопок
      buttons.forEach(btn => btn.classList.remove('active'));

      if (isActive) {
        // Повторный клик — показать все
        articles.forEach(article => article.style.display = '');
        if (breadcrumbCurrent) {
          breadcrumbCurrent.textContent = 'Все статьи';
        }
      } else {
        // Активируем текущую кнопку
        this.classList.add('active');

        // Фильтруем статьи
        articles.forEach(article => {
          const articleCategories = article.dataset.category.split(' ');
          if (articleCategories.includes(filterValue)) {
            article.style.display = '';
          } else {
            article.style.display = 'none';
          }
        });

        if (breadcrumbCurrent) {
          breadcrumbCurrent.textContent = this.textContent;
        }
      }
    });
  });
});