import { setupPasswordToggle } from "../setupPasswordToggle.js";
import { handleCheckboxToggle } from "../handleCheckboxToggle.js";

import { initRoleDropdown } from "./select.js";
import { autoFillLocation } from "./autoFillLocation.js";
import { validateRegisterForm } from "./validateRegisterForm.js";

window.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  handleCheckboxToggle();
  initRoleDropdown();
  autoFillLocation();
  validateRegisterForm();
});
