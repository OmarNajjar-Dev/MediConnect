export function validateForm() {
    let isValid = true;

    function toggleError(condition, errorId) {
        const errorEl = document.getElementById(errorId);
        if (condition) {
            errorEl.classList.remove("hidden");
            isValid = false;
        } else {
            errorEl.classList.add("hidden");
        }
    }

    const selectedValues = document.querySelectorAll(".selected-value");
    const specialtyText = selectedValues[0]?.textContent.trim();
    const doctorText = selectedValues[1]?.textContent.trim();
    const dateText = selectedValues[2]?.textContent.trim();
    const timeText = selectedValues[3]?.textContent.trim();

    toggleError(specialtyText === "" || specialtyText.toLowerCase().includes("select"), "error-speciality");
    toggleError(doctorText === "" || doctorText === "Select a doctor", "error-doctor");
    toggleError(dateText === "" || dateText === "Pick a date", "error-date");
    toggleError(timeText === "" || timeText === "Select a time", "error-timeSlot");

    const reasonText = document.getElementById("reason").value.trim();
    toggleError(reasonText === "", "error-required");

    return isValid;
}
