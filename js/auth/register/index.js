import { setupPasswordToggle } from "../utils/setupPasswordToggle.js";

import { initRoleDropdown } from "./select.js";
import { autoFillLocation } from "./autoFillLocation.js";
import { handleCheckboxToggle } from "./handleCheckboxToggle.js";
import { validateRegisterForm } from "./validateRegisterForm.js";

window.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  initRoleDropdown();
  autoFillLocation();
  handleCheckboxToggle();
  validateRegisterForm();
});
