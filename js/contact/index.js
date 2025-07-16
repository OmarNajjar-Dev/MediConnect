import { initDropdown } from "./initDropdown.js";
import { validateForm } from "./validateForm.js";
import { sendEmail } from "./sendEmail.js";

window.addEventListener("DOMContentLoaded", () => {
  initDropdown();

  const form = document.querySelector("form");

  form?.addEventListener("submit", async (e) => {
    e.preventDefault(); // Always prevent default to control submission manually

    if (validateForm()) {
      await sendEmail(); // Send the email after validation passes
      form.reset(); // Reset the form after sending
    }
  });

  lucide.createIcons();
});
