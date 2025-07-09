import { setupDropdowns } from "./setupDropdowns.js";
import { validateForm } from "./validateForm.js";
import { renderCalendar } from "./renderCalendar.js";

document.addEventListener("DOMContentLoaded", () => {
  setupDropdowns(document.querySelectorAll("button[role='combobox']"));
  window.validateForm = validateForm;
  renderCalendar();

  lucide.createIcons();
});
