import {
  showErrorToast,
  showSuccessToast,
  showWarningToast,
} from "../common/toast.js";
import {
  getCurrentRequestId,
  setCurrentRequestId,
  stopCountdown,
} from "./countdown.js";

let requestCancelled = false;
let drawerTimeout = null;

// Save original help section HTML to restore later
const helpSectionWrapper = document.getElementById("request-help-wrapper");
const originalHelpHTML = helpSectionWrapper ? helpSectionWrapper.innerHTML : "";

export async function cancelRequest() {
  requestCancelled = true;
  clearTimeout(drawerTimeout);

  // Stop the countdown immediately
  stopCountdown();

  // Set global state to prevent drawer timeout
  window.emergencyRequestCancelled = true;

  const drawer = document.getElementById("drawer");
  if (drawer) drawer.classList.add("hidden");

  const currentRequestId = getCurrentRequestId();

  if (!currentRequestId) {
    console.warn("No active request to cancel.");
    // Reset UI even if no request ID
    resetEmergencyUI();
    return;
  }

  try {
    const response = await fetch(
      "/mediconnect/backend/api/emergency/cancel-request.php",
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ request_id: currentRequestId }),
      }
    );

    const data = await response.json();

    if (data.success) {
      console.log("Request canceled on server.");
      setCurrentRequestId(null);

      // Clear the stored request ID
      sessionStorage.removeItem("currentEmergencyRequestId");

      // Reset the UI
      resetEmergencyUI();

      // Show warning message
      showWarningToast(
        "Request Canceled",
        "Your emergency request has been canceled successfully"
      );
    } else {
      console.error("Cancel failed:", data.message);
      showErrorToast(
        "Cancel Failed",
        "Failed to cancel request: " + data.message
      );
    }
  } catch (err) {
    console.error("Cancel request error:", err);
    showErrorToast(
      "Network Error",
      "Failed to cancel request due to network error"
    );
  }
}

function resetEmergencyUI() {
  const statusSection = document.getElementById("status-section");
  if (statusSection) statusSection.classList.add("hidden");

  // Reset the ETA text to original state
  const etaText = document.getElementById("eta-text");
  if (etaText) {
    etaText.textContent = "Estimated arrival: 10 minutes";
  }

  if (helpSectionWrapper) {
    helpSectionWrapper.innerHTML = originalHelpHTML;
  }

  const newRequestBtn = document.getElementById("request-help-btn");
  if (newRequestBtn) {
    // Remove existing event listeners and add new one
    newRequestBtn.replaceWith(newRequestBtn.cloneNode(true));
    const freshBtn = document.getElementById("request-help-btn");
    freshBtn.addEventListener("click", () => {
      // Re-import and call the handler
      import("./handleEmergency.js").then((module) => {
        module.handleEmergencyClick();
      });
    });
  }
}

export function resetEmergency() {
  // First try to cancel the request in the database
  cancelRequest();

  // Show success message
  showSuccessToast(
    "System Reset",
    "Emergency system has been reset. You can request help again if needed."
  );

  console.log("Emergency page fully reset.");
}

// Export for use in other modules
export { requestCancelled, drawerTimeout };
