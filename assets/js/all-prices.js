document.addEventListener('DOMContentLoaded', function () {
  const items = document.querySelectorAll('.accordion-item');

  items.forEach(item => {
    const toggle = item.querySelector('.accordion-toggle');

    toggle.addEventListener('click', () => {
      items.forEach(i => {
        if (i !== item) {
          i.classList.remove('active');
          i.querySelector('.accordion-toggle').classList.remove('open');
        }
      });

      item.classList.toggle('active');
      toggle.classList.toggle('open');
    });
  });
});