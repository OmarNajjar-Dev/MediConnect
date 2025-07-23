import { showErrorToast, showSuccessToast } from "../common/toast.js";
import { updateStatusDisplay } from "./statusDisplay.js";

let currentRequestId = null;

export function setCurrentRequestId(requestId) {
  currentRequestId = requestId;
}

export function getCurrentRequestId() {
  return currentRequestId;
}

export function startCountdown(minutes) {
  let remaining = minutes;
  const etaText = document.getElementById("eta-text");
  if (!etaText) return;

  async function updateCountdown() {
    if (remaining > 0) {
      etaText.textContent = `Estimated arrival: ${remaining} minute(s)`;
      remaining--;
      setTimeout(updateCountdown, 60000); // Update every minute
    } else {
      // Ambulance has arrived
      etaText.textContent = `Ambulance has arrived!`;

      if (currentRequestId) {
        try {
          console.log("Marking emergency request as completed...");

          const res = await fetch(
            "/mediconnect/backend/api/mark-completed.php",
            {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify({ request_id: currentRequestId }),
            }
          );

          const data = await res.json();
          console.log("Mark completed response:", data);

          if (data.success) {
            console.log(
              "✅ Emergency request marked as completed successfully"
            );

            // Show success message to user using toast
            showSuccessToast(
              "Ambulance Arrived!",
              "Emergency response team has successfully reached your location"
            );

            // Update the status display
            updateStatusDisplay("completed");
          } else {
            console.error("❌ Completion failed:", data.message);
            showErrorToast(
              "Completion Failed",
              "Failed to update request status: " + data.message
            );
          }
        } catch (err) {
          console.error("❌ Complete request error:", err);
          showErrorToast(
            "Network Error",
            "Network error while updating request status"
          );
        }
      } else {
        console.warn("No current request ID to mark as completed");
      }
    }
  }

  updateCountdown();
}

export async function markRequestAsCompleted() {
  if (!currentRequestId) return;

  try {
    const res = await fetch("/mediconnect/backend/api/mark-completed.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ request_id: currentRequestId }),
    });

    const data = await res.json();

    if (data.success) {
      console.log("✅ Emergency request marked as completed");
      updateStatusDisplay("completed");

      const etaText = document.getElementById("eta-text");
      if (etaText) {
        etaText.textContent = "Ambulance has arrived!";
      }
    } else {
      console.error("❌ Failed to mark as completed:", data.message);
    }
  } catch (err) {
    console.error("❌ Error marking as completed:", err);
  }
}
