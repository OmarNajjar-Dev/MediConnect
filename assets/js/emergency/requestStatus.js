import { showSuccessToast } from "../common/toast.js";
import {
  startCountdown,
  setCurrentRequestId,
  markRequestAsCompleted,
} from "./countdown.js";

export async function checkExistingEmergencyRequest() {
  // Check if there's a stored request ID in sessionStorage
  const storedRequestId = sessionStorage.getItem("currentEmergencyRequestId");

  if (storedRequestId) {
    try {
      console.log(
        "Checking status of existing emergency request:",
        storedRequestId
      );

      const response = await fetch(
        `/mediconnect/backend/api/emergency/get-emergency-status.php?request_id=${storedRequestId}`
      );
      const data = await response.json();

      if (data.success) {
        const request = data.request;
        setCurrentRequestId(request.request_id);

        console.log("Found existing emergency request:", request);

        if (request.status === "Pending") {
          // Restore the countdown
          replaceHelpButtonSection();
          const statusSection = document.getElementById("status-section");
          if (statusSection) statusSection.classList.remove("hidden");

          // Show info message about restored request
          showSuccessToast(
            "Request Restored",
            `Your emergency request is still active. Estimated arrival: ${request.remaining_minutes} minutes`
          );

          if (request.remaining_minutes > 0) {
            startCountdown(request.remaining_minutes);
          } else {
            // Time has passed, mark as completed
            markRequestAsCompleted();
          }
        } else if (request.status === "Completed") {
          // Show completed status
          replaceHelpButtonSection();
          const statusSection = document.getElementById("status-section");
          if (statusSection) statusSection.classList.remove("hidden");

          import("./statusDisplay.js").then((module) => {
            module.updateStatusDisplay("completed");
          });

          // Show success message for completed request
          showSuccessToast(
            "Request Completed",
            "Your emergency request has been completed successfully"
          );

          const etaText = document.getElementById("eta-text");
          if (etaText) {
            etaText.textContent = "Ambulance has arrived!";
          }
        } else if (request.status === "Canceled") {
          // Clear the stored request ID
          sessionStorage.removeItem("currentEmergencyRequestId");
          setCurrentRequestId(null);
        }
      } else {
        console.log("No valid emergency request found, clearing stored ID");
        sessionStorage.removeItem("currentEmergencyRequestId");
        setCurrentRequestId(null);
      }
    } catch (err) {
      console.error("Error checking existing emergency request:", err);
      sessionStorage.removeItem("currentEmergencyRequestId");
      setCurrentRequestId(null);
    }
  }
}

function replaceHelpButtonSection() {
  const helpSectionWrapper = document.getElementById("request-help-wrapper");
  if (!helpSectionWrapper) return;

  helpSectionWrapper.innerHTML = `
    <div class="relative mx-auto mt-6 w-full max-w-4xl rounded-lg border border-solid border-green-200 bg-green-50 px-6 py-4 text-center">
      <h4 class="font-semibold text-green-800">Emergency request active</h4>
      <p class="text-sm text-green-700">Help is on the way. You can view the status below.</p>
    </div>
  `;
}
