export function setupTabNavigation() {
  const tabButtons = document.querySelectorAll("button[data-target]");
  const tabSections = document.querySelectorAll("div[data-section]");

  if (!tabButtons.length || !tabSections.length) return;

  tabButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const target = button.dataset.target;

      // Reset all buttons
      tabButtons.forEach((btn) =>
        btn.classList.remove("bg-white", "text-gray-900")
      );

      // Hide all sections
      tabSections.forEach((section) => section.classList.add("hidden"));

      // Activate current
      button.classList.add("bg-white", "text-gray-900");
      document
        .querySelector(`div[data-section="${target}"]`)
        ?.classList.remove("hidden");
    });
  });
}
