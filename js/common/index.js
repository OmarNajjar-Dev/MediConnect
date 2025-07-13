import { setupScrollHeaderEffect } from "./setupScrollHeaderEffect.js";
import { setupMobileMenuToggle } from "./setupMobileMenuToggle.js";
import { initDropdownMenu } from "./initDropdownMenu.js";

window.addEventListener("DOMContentLoaded", () => {
  setupScrollHeaderEffect();
  setupMobileMenuToggle();
  initDropdownMenu();
});
