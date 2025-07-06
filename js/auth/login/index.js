import { setupPasswordToggle } from "../setupPasswordToggle.js";
import { handleCheckboxToggle } from "../handleCheckboxToggle.js";

import { validateLoginForm } from "./validateLoginForm.js";

window.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  handleCheckboxToggle();
  validateLoginForm();
});
