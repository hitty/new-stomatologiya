document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll('.btn-view-pdf');
  const modal = document.getElementById('pdf-modal');
  const iframe = document.getElementById('pdf-frame');
  const closeBtn = document.getElementById('pdf-modal-close');

  let scrollPosition = 0;  // для сохранения скролла страницы

  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      const pdfUrl = btn.getAttribute('data-pdf-url');
      if (!pdfUrl) {
        alert('PDF документ не найден');
        return;
      }

      // Сохраняем текущий скролл страницы
      scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

      // Блокируем прокрутку страницы и фиксируем позицию
      document.body.style.position = 'fixed';
      document.body.style.top = `-${scrollPosition}px`;
      document.body.style.left = '0';
      document.body.style.right = '0';
      document.body.style.width = '100%';

      iframe.src = pdfUrl;
      modal.style.display = 'flex';
    });
  });

  function closeModal() {
    iframe.src = '';
    modal.style.display = 'none';

    // Разблокируем прокрутку и возвращаем позицию скролла
    document.body.style.position = '';
    document.body.style.top = '';
    document.body.style.left = '';
    document.body.style.right = '';
    document.body.style.width = '';

    window.scrollTo(0, scrollPosition);
  }

  closeBtn.addEventListener('click', closeModal);

  modal.addEventListener('click', e => {
    if (e.target === modal) {
      closeModal();
    }
  });
});