(function () {
  let ytPlayer = null;
  let iframe = null;

  document.addEventListener("DOMContentLoaded", function () {
    iframe = document.getElementById("video-iframe");
    if (!iframe) return;

    const src = iframe.getAttribute("src");

    if (src.includes("youtube.com")) {
      window.onYouTubeIframeAPIReady = onYouTubeIframeAPIReady;
      if (!window.YT) {
        const tag = document.createElement("script");
        tag.src = "https://www.youtube.com/iframe_api";
        document.head.appendChild(tag);
      } else {
        onYouTubeIframeAPIReady();
      }
    }
  });

  function onYouTubeIframeAPIReady() {
    ytPlayer = new YT.Player("video-iframe", {
      events: {
        onReady: () => {
          ytPlayer.mute();
          initObserver();
        }
      }
    });
  }

  function initObserver() {
    const section = document.getElementById("video-section");
    if (!section || !iframe) return;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          playVideo();
        } else {
          pauseVideo();
        }
      });
    }, {
      threshold: 0.5
    });

    observer.observe(section);
  }

  function playVideo() {
    if (ytPlayer) {
      ytPlayer.mute();
      ytPlayer.playVideo();
    }
  }

  function pauseVideo() {
    if (ytPlayer) {
      ytPlayer.pauseVideo();
    }
  }
})();