import { loadDoctors } from "./loadData.js";

let currentOpenDropdown = null; // Tracks currently open dropdown and its button

// Main setup function
export function setupDropdowns(dropdownButtons) {
  dropdownButtons.forEach((button) => {
    const menu = button.nextElementSibling;
    const selectedText = button.querySelector("span.selected-value");
    let selectedOption = null;

    if (!menu || !selectedText) return;

    // Position the dropdown absolutely
    makeDropdownFloat(button, menu);

    // Enable internal scroll only for specific dropdowns
    const shouldHaveScroll = [
      "speciality-button",
      "doctor-button",
      "time-slot-button",
    ].includes(button.id);
    if (shouldHaveScroll) {
      const maxHeight = button.id === "time-slot-button" ? 360 : 200;
      setupDropdownScroll(menu, maxHeight);
    }

    // When button is clicked
    button.addEventListener("click", (e) => {
      e.stopPropagation(); // Allow custom control

      const isOpening = menu.classList.contains("hidden");

      // Close any previously open dropdown
      if (currentOpenDropdown && currentOpenDropdown.menu !== menu) {
        currentOpenDropdown.menu.classList.add("hidden");
      }

      // Toggle visibility of this one
      menu.classList.toggle("hidden");

      if (isOpening) {
        makeDropdownFloat(button, menu);
        document.body.classList.add("overflow-hidden");
        currentOpenDropdown = { button, menu }; // Track current
      } else {
        document.body.classList.remove("overflow-hidden");
        currentOpenDropdown = null;
      }
    });

    // Setup option event listeners
    setupOptionListeners(button, menu, selectedText, selectedOption);
  });
}

// Separate function to setup option listeners (can be called after dynamic content loading)
export function setupOptionListeners(
  button,
  menu,
  selectedText,
  selectedOption
) {
  // Remove existing listeners first
  const existingOptions = menu.querySelectorAll("button.select-btn");
  existingOptions.forEach((option) => {
    option.replaceWith(option.cloneNode(true));
  });

  // Get fresh references after cloning
  const options = menu.querySelectorAll("button.select-btn");

  options.forEach((option) => {
    option.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();

      selectedText.textContent = option.textContent.trim();

      // Reset all options
      options.forEach((btn) => {
        btn.querySelector("svg")?.classList.add("hidden");
        btn.classList.remove("bg-neutral-100");
        btn.classList.add("bg-white");
      });

      // Style the selected one
      option.querySelector("svg")?.classList.remove("hidden");
      option.classList.remove("bg-white");
      option.classList.add("bg-neutral-100");

      selectedOption = option;
      menu.classList.add("hidden");
      document.body.classList.remove("overflow-hidden");
      currentOpenDropdown = null;

      // Handle specialty selection - filter doctors
      if (button.id === "speciality-button") {
        const specialtyId = option.getAttribute("data-specialty-id");
        if (specialtyId) {
          // Reset doctor selection
          const doctorButton = document.getElementById("doctor-button");
          const doctorSelectedText = doctorButton.querySelector(
            "span.selected-value"
          );
          doctorSelectedText.textContent = "Select a doctor";

          // Load doctors for selected specialty
          loadDoctors(specialtyId);
        }
      }
    });

    // Visual feedback
    option.addEventListener("mouseenter", () => {
      if (selectedOption && selectedOption !== option) {
        selectedOption.classList.remove("bg-neutral-100");
        selectedOption.classList.add("bg-white");
      }
    });

    option.addEventListener("mouseleave", () => {
      selectedOption?.classList.remove("bg-white");
      selectedOption?.classList.add("bg-neutral-100");
    });
  });
}

// ✅ Global listener to close dropdown when clicking anywhere else
document.addEventListener("click", (e) => {
  if (
    currentOpenDropdown &&
    !currentOpenDropdown.menu.contains(e.target) &&
    !currentOpenDropdown.button.contains(e.target)
  ) {
    currentOpenDropdown.menu.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
    currentOpenDropdown = null;
  }
});

// ✅ Floating dropdown logic
function makeDropdownFloat(button, dropdown) {
  const container = button.parentElement;

  if (getComputedStyle(container).position === "static") {
    container.style.position = "relative";
  }

  dropdown.style.position = "absolute";
  dropdown.style.left = "0";
  dropdown.style.zIndex = "1000";
  dropdown.style.width = "100%";
  dropdown.style.backgroundColor = "#ffffff";

  const buttonRect = button.getBoundingClientRect();
  const dropdownHeight = dropdown.offsetHeight || 240;
  const spaceBelow = window.innerHeight - buttonRect.bottom;
  const spaceAbove = buttonRect.top;

  if (spaceBelow >= dropdownHeight || spaceBelow >= spaceAbove) {
    dropdown.style.top = `${button.offsetHeight + 4}px`;
    dropdown.style.bottom = "auto";
  } else {
    dropdown.style.top = "auto";
    dropdown.style.bottom = `${button.offsetHeight + 4}px`;
  }
}

// ✅ Allow scroll inside dropdown only for specific dropdowns
function setupDropdownScroll(dropdownElement, maxHeight = 200) {
  dropdownElement.style.maxHeight = `${maxHeight}px`;
  dropdownElement.style.overflowY = "auto";

  dropdownElement.addEventListener(
    "wheel",
    (e) => {
      const atTop = dropdownElement.scrollTop === 0;
      const atBottom =
        dropdownElement.scrollHeight - dropdownElement.scrollTop ===
        dropdownElement.clientHeight;

      if ((atTop && e.deltaY < 0) || (atBottom && e.deltaY > 0)) {
        e.preventDefault(); // Prevent page scroll
      }
    },
    { passive: false }
  );
}
