document.addEventListener("DOMContentLoaded", function() {
  const prevBtn = document.querySelector(".doctors-nav-btn.prev");
  const nextBtn = document.querySelector(".doctors-nav-btn.next");
  const track = document.querySelector(".doctors-cards-track");
  const cards = document.querySelectorAll(".doctor-card");

  if (!track || cards.length === 0) return;

  let currentIndex = 0;
  const cardWidth = cards[0].offsetWidth + 10;
  const visibleCards = Math.floor(1160 / cardWidth);

  function updateSliderPosition() {
    track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    track.style.transition = "transform 0.4s ease";
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

  track.addEventListener("transitionend", () => {
    track.style.transition = "none";
  });
});