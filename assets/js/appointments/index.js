import { setupDropdowns } from "./setupDropdowns.js";
import { validateForm } from "./validateForm.js";
import { renderCalendar } from "./renderCalendar.js";
import { submitAppointment } from "./submitAppointments.js";
import { initializeDataLoading } from "./loadData.js";
import { showErrorToast } from "../common/toast.js";

document.addEventListener("DOMContentLoaded", async () => {
  try {
    // Initialize data loading first
    await initializeDataLoading();

    // Setup dropdowns after data is loaded
    const dropdownButtons = document.querySelectorAll(
      "button[role='combobox']"
    );
    setupDropdowns(dropdownButtons);

    // Setup calendar
    renderCalendar();

    // Initialize Lucide icons
    lucide.createIcons();

    // Add listener for the form submission
    const form = document.getElementById("appointment-form");
    if (form) {
      form.addEventListener("submit", (event) => {
        event.preventDefault(); // prevent default form submission

        const isValid = validateForm();
        if (isValid) {
          submitAppointment(); // only called if valid
        } else {
          showErrorToast(
            "Validation Error",
            "Please fill in all required fields correctly."
          );
        }
      });
    }
  } catch (error) {
    console.error("Error initializing appointments page:", error);
    showErrorToast(
      "Initialization Error",
      "Failed to load the appointment form. Please refresh the page."
    );
  }
});
