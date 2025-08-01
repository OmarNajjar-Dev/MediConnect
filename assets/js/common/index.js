import { setupScrollHeaderEffect } from "./setupScrollHeaderEffect.js";
import { setupMobileMenuToggle } from "./setupMobileMenuToggle.js";
import { initDropdownMenu } from "./initDropdownMenu.js";
import { initDropdown } from "./initDropdown.js";
import {
  showToast,
  showSuccessToast,
  showErrorToast,
  showWarningToast,
  hideToast,
} from "./toast.js";

window.addEventListener("DOMContentLoaded", () => {
  setupScrollHeaderEffect();
  setupMobileMenuToggle();
  initDropdownMenu();
  initDropdown();
});

// Make toast functions available globally
window.showToast = showToast;
window.showSuccessToast = showSuccessToast;
window.showErrorToast = showErrorToast;
window.showWarningToast = showWarningToast;
window.hideToast = hideToast;
