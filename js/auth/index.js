import { setupPasswordToggle } from "./pass.js";
import { validateForm } from "./validateForm.js";
import { handleCheckboxToggle } from "./checkbox.js";
import { initRoleDropdown } from "./select.js";

window.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  validateForm();
  handleCheckboxToggle();
  initRoleDropdown();
});
