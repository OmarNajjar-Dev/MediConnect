export function setupDropdowns(dropdownButtons) {

    dropdownButtons.forEach((button) => {
        const menu = button.nextElementSibling;
        const selectedText = button.querySelector("span.selected-value");
        let selectedOption = null;

        if (!menu || !selectedText) return;

        button.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });

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

        document.addEventListener("click", (e) => {
            if (!button.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add("hidden");
            }
        });
    });

}


    