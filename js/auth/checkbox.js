export function handleCheckboxToggle(checkboxId, buttonId) {
    const checkbox = document.getElementById("agree-checkbox");
    const button = document.getElementById("signup-btn");

    checkbox.addEventListener("change", function () {
        if (this.checked) {
            button.classList.remove("bg-medical-200", "pointer-events-none");
            button.classList.add("bg-medical-500", "hover:bg-medical-700");
        } else {
            button.classList.add("bg-medical-200", "pointer-events-none");
            button.classList.remove("bg-medical-500", "hover:bg-medical-700");
        }
    });
}
