import { handleEmergencyClick } from "./handleEmergency.js";
import { cancelRequest, resetEmergency } from "./cancelRequest.js";
import { checkExistingEmergencyRequest } from "./requestStatus.js";

// Initialize emergency system
window.addEventListener("DOMContentLoaded", () => {
  const requestHelpBtn = document.getElementById("request-help-btn");
  const statusCancelBtn = document.getElementById("status-cancel-btn");

  // Event bindings
  if (requestHelpBtn) {
    requestHelpBtn.addEventListener("click", handleEmergencyClick);
  }

  if (statusCancelBtn) {
    statusCancelBtn.addEventListener("click", resetEmergency);
  }

  // Check for existing emergency request on page load
  checkExistingEmergencyRequest();

  // Make functions available globally for HTML onclick handlers
  window.closeDrawer = () => {
    const drawer = document.getElementById("drawer");
    if (drawer) drawer.classList.add("hidden");
  };

  window.cancelRequest = cancelRequest;
  window.resetEmergency = resetEmergency;
});
