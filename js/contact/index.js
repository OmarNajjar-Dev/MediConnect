import { initDropdown } from './select.js';
import { validateForm } from './validateForm.js';
import { sendEmail } from './sendEmail.js';

document.addEventListener('DOMContentLoaded', () => {
  initDropdown();

  const form = document.querySelector("form");
  if (form) {
    form.addEventListener("submit", async (e) => {
      e.preventDefault(); // Always prevent default to control submission manually

      const isValid = validateForm();
      if (isValid) {
        await sendEmail(); // Send the email after validation passes
        form.reset();      // Reset the form after sending
      }
    });
  }

  lucide.createIcons();
});
