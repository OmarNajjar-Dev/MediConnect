import {
  showErrorToast,
  showSuccessToast,
  showWarningToast,
} from "../common/toast.js";
import { startCountdown, setCurrentRequestId } from "./countdown.js";

// Global variables for emergency state
let currentRequestId = null;
let requestCancelled = false;
let drawerTimeout = null;

// Save original help section HTML to restore later
const helpSectionWrapper = document.getElementById("request-help-wrapper");
const originalHelpHTML = helpSectionWrapper ? helpSectionWrapper.innerHTML : "";

export async function handleEmergencyClick() {
  requestCancelled = false;
  const drawer = document.getElementById("drawer");
  if (drawer) drawer.classList.remove("hidden");

  // Show info message about location access
  showWarningToast(
    "Accessing Location",
    "Please allow location access to send emergency help to your exact location"
  );

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      async (position) => {
        const { latitude, longitude } = position.coords;

        try {
          console.log("Sending emergency request with coordinates:", {
            latitude,
            longitude,
          });

          const response = await fetch(
            "/mediconnect/backend/api/emergency/handle-emergency.php",
            {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify({ latitude, longitude }),
            }
          );

          const data = await response.json();
          console.log("Emergency API response:", data);

          if (data.success && data.estimated_time_minutes !== undefined) {
            currentRequestId = data.request_id;
            setCurrentRequestId(data.request_id);

            // Store the request ID in sessionStorage for persistence
            sessionStorage.setItem(
              "currentEmergencyRequestId",
              data.request_id
            );

            console.log(
              "Emergency request successful. Request ID:",
              data.request_id
            );
            console.log("Debug info:", data.debug);

            // Show success message
            showSuccessToast(
              "Emergency Request Sent!",
              `Help is on the way! Estimated arrival: ${data.estimated_time_minutes} minutes`
            );

            startCountdown(data.estimated_time_minutes);
          } else {
            console.error("Emergency request failed:", data.message);
            console.error("Debug info:", data.debug);

            // Show error message to user using toast
            showErrorToast(
              "Emergency Request Failed",
              data.message || "Failed to send emergency request"
            );
          }
        } catch (err) {
          console.error("Error sending emergency request:", err);
          showErrorToast(
            "Network Error",
            "Unable to send emergency request. Please check your connection and try again."
          );
        }
      },
      (error) => {
        console.error("Geolocation error:", error);
        showErrorToast(
          "Location Access Denied",
          "Unable to access your location. Please enable location services in your browser settings."
        );
      }
    );
  } else {
    console.error("Geolocation not supported");
    showErrorToast(
      "Location Not Supported",
      "Your browser does not support location services. Please use a modern browser."
    );
  }

  drawerTimeout = setTimeout(() => {
    if (!requestCancelled) {
      const drawer = document.getElementById("drawer");
      if (drawer) drawer.classList.add("hidden");
      replaceHelpButtonSection();
      const statusSection = document.getElementById("status-section");
      if (statusSection) statusSection.classList.remove("hidden");
    }
  }, 4000);
}

function replaceHelpButtonSection() {
  if (!helpSectionWrapper) return;

  helpSectionWrapper.innerHTML = `
    <div class="relative mx-auto mt-6 w-full max-w-4xl rounded-lg border border-solid border-green-200 bg-green-50 px-6 py-4 text-center">
      <h4 class="font-semibold text-green-800">Emergency request active</h4>
      <p class="text-sm text-green-700">Help is on the way. You can view the status below.</p>
    </div>
  `;
}

// Export for use in other modules
export { currentRequestId, requestCancelled, drawerTimeout };
