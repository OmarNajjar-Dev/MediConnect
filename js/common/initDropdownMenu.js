export function initDropdownMenu() {
  const dropdown = document.querySelector(".dropdown");
  const dropdownToggle = dropdown?.querySelector("button");
  const dropdownMenu = dropdown?.querySelector(".dropdown-content");

  if (!dropdown || !dropdownToggle || !dropdownMenu) return;

  let isClicked = false;
  
  // Toggle menu on click (persistent)
  dropdownToggle.addEventListener("click", (e) => {
    isClicked = !isClicked;
    dropdownMenu.classList.toggle("hidden", !isClicked);
  });

  // Show menu on hover
  dropdown.addEventListener("mouseenter", () => {
    if (!isClicked) {
      dropdownMenu.classList.remove("hidden");
    }
  });

  // Hide menu on mouse leave (only if not clicked)
  dropdown.addEventListener("mouseleave", () => {
    if (!isClicked) {
      dropdownMenu.classList.add("hidden");
    }
  });

  // Hide menu when clicking outside (if it was clicked)
  document.addEventListener("click", (e) => {
    if (!dropdown.contains(e.target)) {
      isClicked = false;
      dropdownMenu.classList.add("hidden");
    }
  });
}
