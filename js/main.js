// ============================
// Header Scroll Effect
// ============================
// When the page is scrolled, adjust the header classes to shrink it and add a shadow.
// If scrollY is greater than 20, remove extra padding and add shadow and blur.
// Otherwise, revert to the original padding and remove shadow/blur.
const headerElement = document.querySelector("header");
window.addEventListener("scroll", () => {
  if (window.scrollY > 20) {
    headerElement.classList.remove("py-5");
    headerElement.classList.add("shadow-sm", "backdrop-blur-md", "py-3");
  } else {
    headerElement.classList.add("py-5");
    headerElement.classList.remove("shadow-sm", "backdrop-blur-md", "py-3");
  }
});

// ============================
// Mobile Navigation Toggle
// ============================
// This toggles the mobile navigation menu when the menu button is clicked.
// It also toggles the body overflow to prevent background scrolling.
const mobileNavElement = document.getElementById("mobile-nav");
const menuButtonElement = document.getElementById("menu-button");
menuButtonElement.addEventListener("click", () => {
  mobileNavElement.classList.toggle("hidden");
  document.body.classList.toggle("overflow-hidden");
});
