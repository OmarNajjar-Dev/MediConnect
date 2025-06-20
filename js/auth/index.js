import { setupPasswordToggle } from "./pass.js";
import { validateForm } from "./validateForm.js";
import { handleCheckboxToggle } from "./checkbox.js";
import { initRoleDropdown } from "./select.js";

document.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  validateForm();
  handleCheckboxToggle();
  initRoleDropdown();
});
