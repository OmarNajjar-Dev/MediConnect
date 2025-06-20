export function initRoleDropdown() {
  const button = document.getElementById("role-trigger");
  const menu = document.getElementById("role-options");
  const selectedText = document.getElementById("selected-role");
  const hiddenInput = document.getElementById("role-input");

  if (!button || !menu || !selectedText || !hiddenInput) return;

  let selectedOption = null;

  button.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });

  const options = menu.querySelectorAll("button.option-btn");

  options.forEach((option) => {
    option.addEventListener("click", () => {
      const label = option.querySelector("span").textContent.trim();
      const value = option.getAttribute("data-value");

      selectedText.textContent = label;
      hiddenInput.value = value;

      options.forEach((btn) => {
        const icon = btn.querySelector("svg");
        if (icon) icon.classList.add("hidden");
        btn.classList.remove("bg-gray-100");
        btn.classList.add("bg-white");
      });

      const icon = option.querySelector("svg");
      if (icon) icon.classList.remove("hidden");

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
      if (selectedOption) {
        selectedOption.classList.remove("bg-white");
        selectedOption.classList.add("bg-gray-100");
      }
    });
  });

  document.addEventListener("click", (e) => {
    if (!button.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.add("hidden");
    }
  });
}