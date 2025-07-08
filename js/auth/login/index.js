import { setupPasswordToggle } from "../utils/setupPasswordToggle.js";
import { handleCheckboxToggle } from "../utils/handleCheckboxToggle.js";

import { validateLoginForm } from "./validateLoginForm.js";

window.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  handleCheckboxToggle();
  validateLoginForm();
});
