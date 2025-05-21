// contact/select.js

export function initDropdown() {
  const button = document.getElementById("dropdownButton");
  const menu = document.getElementById("dropdownMenu");
  const selectedText = document.getElementById("selectedSubject");

  if (!button || !menu || !selectedText) return;

  // Toggle menu visibility
  button.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });

  // Handle option click
  const options = menu.querySelectorAll("button.option-btn");

  options.forEach((option) => {
    option.addEventListener("click", () => {
      const value = option.getAttribute("data-value");
      const label = option.textContent.trim();

      // Set selected text in main button
      selectedText.textContent = label;
      console.log("Selected:", value);

      // Hide all check icons first
      options.forEach((btn) => {
        const icon = btn.querySelector('svg');
        if (icon) {
          icon.classList.add("hidden");
        }
      });

      // Show the icon for the selected option
      const icon = option.querySelector('svg');
      if (icon) {
        icon.classList.remove("hidden");
      }

      // Hide menu after selection
      menu.classList.add("hidden");
    });
  });

  // Close dropdown if clicked outside
  document.addEventListener("click", (e) => {
    if (!button.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.add("hidden");
    }
  });
}