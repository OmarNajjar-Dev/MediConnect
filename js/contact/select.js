export function initDropdown() {
  const button = document.getElementById("dropdown-button");
  const menu = document.getElementById("dropdown-menu");
  const selectedText = button.querySelector("span");

  if (!button || !menu || !selectedText) return;

  let selectedOption = null;

  button.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });

  const options = menu.querySelectorAll("button.option-btn");

  options.forEach((option) => {
    option.addEventListener("click", () => {
      const label = option.textContent.trim();
      selectedText.textContent = label;

      options.forEach((btn) => {
        const icon = btn.querySelector("svg");
        icon?.classList.add("hidden");
        btn.classList.remove("bg-gray-100");
        btn.classList.add("bg-white");
      });

      const icon = option.querySelector("svg");
      icon?.classList.remove("hidden");

      option.classList.remove("bg-white");
      option.classList.add("bg-gray-100");

      selectedOption = option;

      menu.classList.add("hidden");
    });

    option.addEventListener("mouseenter", () => {
      if (selectedOption && selectedOption !== option) {
        selectedOption.classList.remove("bg-gray-100");
        selectedOption.classList.add("bg-white");
      }
    });

    option.addEventListener("mouseleave", () => {
      selectedOption?.classList.remove("bg-white");
      selectedOption?.classList.add("bg-gray-100");
    });
  });

  window.addEventListener("click", (e) => {
    if (!button.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.add("hidden");
    }
  });
}
