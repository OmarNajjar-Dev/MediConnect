import { setupDropdowns } from "./setupDropdowns.js";
import { validateForm } from "./validateForm.js";
import { renderCalendar } from "./renderCalendar.js";
import { submitAppointment } from "./submitAppointments.js";

document.addEventListener("DOMContentLoaded", () => {
  setupDropdowns(document.querySelectorAll("button[role='combobox']"));
  renderCalendar();
  lucide.createIcons();

  // Add listener for the form submission
  const form = document.getElementById("appointment-form"); // adjust ID if needed
  if (form) {
    form.addEventListener("submit", (event) => {
      event.preventDefault(); // prevent default form submission

      const isValid = validateForm();
      if (isValid) {
        submitAppointment(); // only called if valid
      }
    });
  }
});
