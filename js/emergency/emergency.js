const requestHelpBtn = document.getElementById("request-help-btn");
const drawer = document.getElementById("drawer");
const confirmationMessage = document.getElementById("confirmationMessage");
const helpSectionWrapper = document.getElementById("request-help-wrapper");
const statusSection = document.getElementById("status-section");
const statusCancelBtn = document.getElementById("status-cancel-btn");

let drawerTimeout = null;
let messageTimeout = null;
let requestCancelled = false;
let currentRequestId = null;

// Save original help section HTML to restore later
const originalHelpHTML = helpSectionWrapper.innerHTML;

// Initial state
confirmationMessage.classList.add("hidden");
statusSection.classList.add("hidden");

// Event bindings
requestHelpBtn.addEventListener("click", handleEmergencyClick);

if (statusCancelBtn) {
  statusCancelBtn.addEventListener("click", resetEmergency);
}

function handleEmergencyClick() {
  requestCancelled = false;
  drawer.classList.remove("hidden");

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        const { latitude, longitude } = position.coords;

        fetch("/mediconnect/backend/api/handle_emergency.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ latitude, longitude }),
        })
          .then((res) => res.json())
          .then((data) => {
            if (data.success && data.estimated_time_minutes !== undefined) {
              currentRequestId = data.request_id;
              startCountdown(data.estimated_time_minutes);
            } else {
              console.error("Error:", data.message);
            }
          })
          .catch((err) => {
            console.error("Error sending location:", err);
          });
      },
      (error) => {
        console.error("Geolocation error:", error);
      }
    );
  }

  drawerTimeout = setTimeout(() => {
    if (!requestCancelled) {
      drawer.classList.add("hidden");
      showConfirmationMessage();
      replaceHelpButtonSection();
      statusSection.classList.remove("hidden");
    }
  }, 4000);
}

function showConfirmationMessage() {
  if (requestCancelled) return;

  confirmationMessage.classList.remove("hidden");

  messageTimeout = setTimeout(() => {
    confirmationMessage.classList.add("hidden");
  }, 3000);
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

function startCountdown(minutes) {
  let remaining = minutes;
  const etaText = document.getElementById("eta-text");
  if (!etaText) return;

  function updateCountdown() {
    if (remaining > 0) {
      etaText.textContent = `Estimated arrival: ${remaining} minute(s)`;
      remaining--;
      setTimeout(updateCountdown, 60000);
    } else {
      etaText.textContent = `Ambulance has arrived.`;
    }
  }

  updateCountdown();
}

function closeDrawer() {
  drawer.classList.add("hidden");
}

function cancelRequest() {
  requestCancelled = true;
  clearTimeout(drawerTimeout);
  clearTimeout(messageTimeout);
  drawer.classList.add("hidden");
  confirmationMessage.classList.add("hidden");

  if (!currentRequestId) {
    console.warn("No active request to cancel.");
    return;
  }

  fetch("/mediconnect/backend/api/cancel_request.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ request_id: currentRequestId }),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        console.log("Request canceled on server.");
        currentRequestId = null;
      } else {
        console.error("Cancel failed:", data.message);
      }
    })
    .catch((err) => {
      console.error("Cancel request error:", err);
    });
}

function resetEmergency() {
  cancelRequest();
  currentRequestId = null;
  statusSection.classList.add("hidden");
  helpSectionWrapper.innerHTML = originalHelpHTML;

  const newRequestBtn = document.getElementById("request-help-btn");
  if (newRequestBtn) {
    newRequestBtn.addEventListener("click", handleEmergencyClick);
  }

  console.log("Emergency page fully reset.");
}

// Expose some functions globally if needed
window.closeDrawer = closeDrawer;
window.cancelRequest = cancelRequest;
window.resetEmergency = resetEmergency;
