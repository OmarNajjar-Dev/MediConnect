// Get the mobile navigation element
const mobileNav = document.getElementById("mobile-nav");

// Get the menu button element
const menuButton = document.getElementById("menu-button");

// Toggle the 'hidden' class on the mobile nav when the button is clicked
menuButton.addEventListener("click", () => {
  mobileNav.classList.toggle("hidden");
});
