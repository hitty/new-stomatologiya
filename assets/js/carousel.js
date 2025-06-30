document.addEventListener("DOMContentLoaded", function () {
  const prevBtn = document.querySelector(".special-offers__arrow.left");
  const nextBtn = document.querySelector(".special-offers__arrow.right");
  const track = document.querySelector(".special-offers__cards");
  const cards = document.querySelectorAll(".special-card");

  if (!track || cards.length === 0) return;

  let currentIndex = 0;
  const cardWidth = cards[0].offsetWidth + 10;
  const visibleCards = Math.floor(1160 / cardWidth);

  function updateSliderPosition() {
    track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
  }

  prevBtn.addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--;
      updateSliderPosition();
    }
  });

  nextBtn.addEventListener("click", () => {
    if (currentIndex < cards.length - visibleCards) {
      currentIndex++;
      updateSliderPosition();
    }
  });
});