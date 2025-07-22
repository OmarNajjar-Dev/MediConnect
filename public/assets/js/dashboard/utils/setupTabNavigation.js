export function setupTabNavigation() {
  const tabButtons = document.querySelectorAll("button[data-target]");
  const tabSections = document.querySelectorAll("div[data-section]");

  if (!tabButtons.length || !tabSections.length) return;

  tabButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const target = button.dataset.target;

      // Reset all buttons: gray bg, remove white bg and text-gray-900
      tabButtons.forEach((btn) => {
        btn.classList.remove("bg-white", "text-gray-900");
        btn.classList.add("bg-gray-150");
      });

      // Hide all sections
      tabSections.forEach((section) => section.classList.add("hidden"));

      // Activate clicked button: white bg, text-gray-900
      button.classList.add("bg-white", "text-gray-900");
      button.classList.remove("bg-gray-150");

      // Show corresponding section
      document.querySelector(`div[data-section="${target}"]`)?.classList.remove("hidden");
    });
  });

  // Activate the first tab by default
  if (tabButtons.length > 0) {
    tabButtons[0].click();
  }
}
