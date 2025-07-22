export function setupDropdowns() {
  const toggleButtons = document.querySelectorAll("[data-dropdown-toggle]");

  toggleButtons.forEach((button) => {
    const menuId = button.dataset.dropdownId;
    const menu = document.querySelector(`[data-dropdown-menu]#${menuId}`);
    const selectedSpan = button.querySelector("[data-selected-value] span");

    if (!menu || !selectedSpan) return;

    // Toggle menu on button click
    button.addEventListener("click", (e) => {
      e.stopPropagation();
      menu.classList.toggle("hidden");
    });

    // Handle option selection
    const options = menu.querySelectorAll("[data-dropdown-option]");
    options.forEach((option) => {
      option.addEventListener("click", () => {
        const valueText = option.querySelector("span")?.textContent?.trim();
        if (valueText) selectedSpan.textContent = valueText;

        // Hide all check icons and remove selection
        options.forEach((opt) => {
          const icon = opt.querySelector('svg');
          if (icon) icon.classList.add("hidden");
          opt.removeAttribute("data-selected");
        });

        // Show check icon for selected option
        const icon = option.querySelector('svg');
        if (icon) icon.classList.remove("hidden");
        option.setAttribute("data-selected", "true");

        // Close the dropdown
        menu.classList.add("hidden");
      });
    });
  });

  // Close all dropdowns when clicking outside
  document.addEventListener("click", () => {
    document.querySelectorAll("[data-dropdown-menu]").forEach((menu) => {
      menu.classList.add("hidden");
    });
  });
}
