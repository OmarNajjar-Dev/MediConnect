// Wait for Lucide to be ready, then initialize icons
window.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".faq-toggle-icon").forEach((icon) => {
    icon.closest("button").addEventListener("click", function () {
      const borderB = this.closest(".border-b");
      const answer = borderB.querySelector(".faq-answer");

      answer.classList.toggle("hidden");
      icon.classList.toggle("rotate");
    });
  });
});
