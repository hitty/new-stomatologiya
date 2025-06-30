document.addEventListener("DOMContentLoaded", function () {
  // --- Замена иконок по ховеру ---
  const iconMap = [
    {
      className: "tg-icon",
      hoverSrc: "/wp-content/themes/frymstom/assets/img/tg1.svg",
      defaultSrc: "/wp-content/themes/frymstom/assets/img/tg.svg",
    },
    {
      className: "ok-icon",
      hoverSrc: "/wp-content/themes/frymstom/assets/img/ok1.svg",
      defaultSrc: "/wp-content/themes/frymstom/assets/img/ok.svg",
    },
    {
      className: "vk-icon",
      hoverSrc: "/wp-content/themes/frymstom/assets/img/vk1.svg",
      defaultSrc: "/wp-content/themes/frymstom/assets/img/vk.svg",
    },
    {
      className: "yt-icon",
      hoverSrc: "/wp-content/themes/frymstom/assets/img/youtube1.svg",
      defaultSrc: "/wp-content/themes/frymstom/assets/img/youtube.svg",
    }
  ];

  iconMap.forEach(icon => {
    const el = document.querySelector(`.${icon.className}`);
    if (!el) return;

    el.addEventListener("mouseenter", () => {
      el.classList.add("fade-out");
      setTimeout(() => {
        el.setAttribute("src", icon.hoverSrc);
        el.classList.remove("fade-out");
        el.classList.add("fade-in");
      }, 150);
    });

    el.addEventListener("mouseleave", () => {
      el.classList.add("fade-out");
      setTimeout(() => {
        el.setAttribute("src", icon.defaultSrc);
        el.classList.remove("fade-out");
        el.classList.add("fade-in");
      }, 150);
    });

    el.addEventListener("animationend", () => {
      el.classList.remove("fade-in");
    });
  });

  // --- Выпадающий список филиалов ---
  const toggleBtn = document.querySelector(".branch-toggle");
  const dropdown = document.querySelector(".branches-dropdown");
  const addressText = document.querySelector(".address-text");

  if (toggleBtn && dropdown && addressText) {
    toggleBtn.addEventListener("click", () => {
      dropdown.classList.toggle("active");
    });

    document.querySelectorAll(".branch-item").forEach(item => {
      item.addEventListener("click", () => {
        addressText.textContent = item.textContent;
        dropdown.classList.remove("active");
      });
    });

    document.addEventListener("click", (e) => {
      if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.remove("active");
      }
    });
  }
});