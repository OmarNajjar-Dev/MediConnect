// Toggle mobile navigation menu
const menuBtn = document.getElementById("menu-button");
const mobileNav = document.getElementById("mobile-nav");
menuBtn?.addEventListener("click", () => {
  mobileNav?.classList.toggle("hidden");
  document.body.classList.toggle("overflow-hidden");
});
