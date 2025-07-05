import { setupPasswordToggle } from "./setupPasswordToggle.js";
import { validateForm } from "./validateForm.js";
import { handleCheckboxToggle } from "./handleCheckboxToggle.js";
import { initRoleDropdown } from "./select.js";
import { autoFillLocation } from "./autoFillLocation.js";


window.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  validateForm();
  handleCheckboxToggle();
  initRoleDropdown();
  autoFillLocation();
});
