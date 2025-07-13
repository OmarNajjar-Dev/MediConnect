import { setupPasswordToggle } from "../utils/setupPasswordToggle.js";

import { validateLoginForm } from "./validateLoginForm.js";

window.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  validateLoginForm();
});
