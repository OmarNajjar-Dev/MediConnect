import {
  showErrorToast,
  showSuccessToast,
  showWarningToast,
} from "../common/toast.js";
import { getCurrentRequestId, setCurrentRequestId } from "./countdown.js";

let requestCancelled = false;
let drawerTimeout = null;
let messageTimeout = null;

// Save original help section HTML to restore later
const helpSectionWrapper = document.getElementById("request-help-wrapper");
const originalHelpHTML = helpSectionWrapper ? helpSectionWrapper.innerHTML : "";

export async function cancelRequest() {
  requestCancelled = true;
  clearTimeout(drawerTimeout);
  clearTimeout(messageTimeout);

  const drawer = document.getElementById("drawer");
  if (drawer) drawer.classList.add("hidden");

  const confirmationMessage = document.getElementById("confirmationMessage");
  if (confirmationMessage) confirmationMessage.classList.add("hidden");

  const currentRequestId = getCurrentRequestId();

  if (!currentRequestId) {
    console.warn("No active request to cancel.");
    return;
  }

  try {
    const response = await fetch(
      "/mediconnect/backend/api/cancel-request.php",
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
  }
}

export function resetEmergency() {
  cancelRequest();
  setCurrentRequestId(null);

  // Clear the stored request ID
  sessionStorage.removeItem("currentEmergencyRequestId");

  const statusSection = document.getElementById("status-section");
  if (statusSection) statusSection.classList.add("hidden");

  if (helpSectionWrapper) {
    helpSectionWrapper.innerHTML = originalHelpHTML;
  }

  const newRequestBtn = document.getElementById("request-help-btn");
  if (newRequestBtn) {
    newRequestBtn.addEventListener("click", () => {
      // Re-import and call the handler
      import("./handleEmergency.js").then((module) => {
        module.handleEmergencyClick();
      });
    });
  }

  // Show success message
  showSuccessToast(
    "System Reset",
    "Emergency system has been reset. You can request help again if needed."
  );

  console.log("Emergency page fully reset.");
}

// Export for use in other modules
export { requestCancelled, drawerTimeout, messageTimeout };
