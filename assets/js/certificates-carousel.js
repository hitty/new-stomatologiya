document.addEventListener('DOMContentLoaded', function() {
  const carousel = document.querySelector('.certificates-container.has-carousel');
  if (!carousel) return;

  const prevBtn = document.querySelector('.prev-arrow');
  const nextBtn = document.querySelector('.next-arrow');

  if (!prevBtn || !nextBtn) return;

  const gap = 10;
  const item = carousel.querySelector('.cert-item');
  if (!item) return;
  const itemWidth = item.offsetWidth + gap;

  prevBtn.addEventListener('click', () => {
    carousel.scrollBy({ left: -itemWidth, behavior: 'smooth' });
  });

  nextBtn.addEventListener('click', () => {
    carousel.scrollBy({ left: itemWidth, behavior: 'smooth' });
  });

  // Optional: Disable buttons when at start/end
  const updateButtons = () => {
    prevBtn.disabled = carousel.scrollLeft <= 0;
    nextBtn.disabled = carousel.scrollLeft + carousel.offsetWidth >= carousel.scrollWidth;
  };

  carousel.addEventListener('scroll', updateButtons);
  updateButtons();
});