export function initDropdown() {
  const dropdownButtons = document.querySelectorAll('[data-dropdown="button"]');

  dropdownButtons.forEach((button) => {
    const menu = button
      .closest('[data-dropdown="container"]')
      .querySelector('[data-dropdown="menu"]');
    const selectedText = button.querySelector("span");

    if (!menu || !selectedText) return;

    let selectedOption = null;

    button.addEventListener("click", (e) => {
      e.stopPropagation();
      menu.classList.toggle("hidden");
    });

    const options = menu.querySelectorAll('[data-dropdown="option"]');

    options.forEach((option) => {
      option.addEventListener("click", (e) => {
        e.stopPropagation();
        const label = option.textContent.trim();
        selectedText.textContent = label;

        options.forEach((btn) => {
          const icon = btn.querySelector("svg");
          icon?.classList.add("hidden");
          icon?.classList.remove("text-medical-500");

          btn.classList.remove("bg-medical-50", "text-medical-500");
          btn.classList.add("bg-white");
        });

        const icon = option.querySelector("svg");
        icon?.classList.remove("hidden");
        icon?.classList.add("text-medical-500");

        option.classList.remove("bg-white");
        option.classList.add("bg-medical-50", "text-medical-500");

        selectedOption = option;

        menu.classList.add("hidden");
      });

      option.addEventListener("mouseenter", () => {
        if (selectedOption && selectedOption !== option) {
          const selectedIcon = selectedOption.querySelector("svg");
          selectedOption.classList.remove("bg-medical-50", "text-medical-500");
          selectedOption.classList.add("bg-white");
          selectedIcon?.classList.remove("text-medical-500");
        }
      });

      option.addEventListener("mouseleave", () => {
        if (selectedOption) {
          const selectedIcon = selectedOption.querySelector("svg");
          selectedOption.classList.remove("bg-white");
          selectedOption.classList.add("bg-medical-50", "text-medical-500");
          selectedIcon?.classList.add("text-medical-500");
        }
      });
    });
  });

  window.addEventListener("click", () => {
    document.querySelectorAll('[data-dropdown="menu"]').forEach((menu) => {
      menu.classList.add("hidden");
    });
  });
}
