export function setupTabNavigation() {
  const tabButtons = document.querySelectorAll("button[data-target]");
  const tabSections = document.querySelectorAll("div[data-section]");

  if (!tabButtons.length || !tabSections.length) return;

  tabButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const target = button.dataset.target;

      // Reset all buttons
      tabButtons.forEach((btn) =>
        btn.classList.remove("bg-blue-50", "text-blue-700")
      );

      // Hide all sections
      tabSections.forEach((section) => section.classList.add("hidden"));

      // Activate current
      button.classList.add("bg-blue-50", "text-blue-700");
      document
        .querySelector(`div[data-section="${target}"]`)
        ?.classList.remove("hidden");
    });
  });
}
