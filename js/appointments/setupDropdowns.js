export function setupDropdowns(dropdownButtons) {
    dropdownButtons.forEach((button) => {
        const menu = button.nextElementSibling;
        const selectedText = button.querySelector("span.selected-value");
        let selectedOption = null;

        if (!menu || !selectedText) return;

        // ✅ Make dropdown float (no layout shift)
        makeDropdownFloat(button, menu);

        // ✅ Apply scroll behavior only for Time Slot dropdown
        if (button.id === "timeSlotButton") {
            setupDropdownScroll(menu, 240); // 240px max height
        }

        // Toggle dropdown visibility
        button.addEventListener("click", (e) => {
            e.stopPropagation();

            const isOpen = !menu.classList.contains("hidden");

            // Close all other dropdowns
            document.querySelectorAll("ul[id$='Dropdown']").forEach((el) => {
                if (el !== menu) el.classList.add("hidden");
            });

            menu.classList.toggle("hidden");

            if (!isOpen) {
                makeDropdownFloat(button, menu);
                document.body.style.overflow = "hidden"; // ✅ Disable page scroll
            } else {
                document.body.style.overflow = ""; // ✅ Re-enable page scroll
            }
        });

        // Option selection
        const options = menu.querySelectorAll("button.select-btn");
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
                document.body.style.overflow = ""; // ✅ Re-enable scroll after selection
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

        // ✅ Close dropdown when clicking outside
        document.addEventListener("click", (e) => {
            if (!button.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add("hidden");
                document.body.style.overflow = "";
            }
        });
    });
}

// ✅ Makes the dropdown float absolutely without affecting layout
function makeDropdownFloat(button, dropdown) {
    const container = button.parentElement;

    // Ensure parent is relatively positioned
    if (getComputedStyle(container).position === "static") {
        container.style.position = "relative";
    }

    // Float the dropdown
    dropdown.style.position = "absolute";
    dropdown.style.left = "0";
    dropdown.style.zIndex = "1000";
    dropdown.style.width = "100%";
    dropdown.style.backgroundColor = "#ffffff";
    dropdown.style.boxShadow = "0 4px 12px rgba(0, 0, 0, 0.1)";

    // Determine space available
    const buttonRect = button.getBoundingClientRect();
    const dropdownHeight = dropdown.offsetHeight || 240; // fallback height
    const spaceBelow = window.innerHeight - buttonRect.bottom;
    const spaceAbove = buttonRect.top;

    if (spaceBelow >= dropdownHeight || spaceBelow >= spaceAbove) {
        // Show below
        dropdown.style.top = `${button.offsetHeight + 4}px`;
        dropdown.style.bottom = "auto";
    } else {
        // Show above
        dropdown.style.top = "auto";
        dropdown.style.bottom = `${button.offsetHeight + 4}px`;
    }
}

// ✅ Enables scroll only inside dropdown (Time Slot)
function setupDropdownScroll(dropdownElement, maxHeight = 240) {
    dropdownElement.style.maxHeight = `${maxHeight}px`;
    dropdownElement.style.overflowY = "auto";

    // Optional: prevent body scroll while scrolling inside dropdown
    dropdownElement.addEventListener("wheel", (e) => {
        const atTop = dropdownElement.scrollTop === 0;
        const atBottom = dropdownElement.scrollHeight - dropdownElement.scrollTop === dropdownElement.clientHeight;

        if ((atTop && e.deltaY < 0) || (atBottom && e.deltaY > 0)) {
            e.preventDefault(); // prevent page scroll
        }
    }, { passive: false });
}
