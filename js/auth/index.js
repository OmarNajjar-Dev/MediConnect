import { setupPasswordToggle } from "./pass.js";
import { setupPasswordMatchCheck } from "./validate.js";
import { handleCheckboxToggle } from "./checkbox.js";

document.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  setupPasswordMatchCheck();
  handleCheckboxToggle();
});
