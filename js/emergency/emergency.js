// Get DOM elements
const requestHelpBtn = document.getElementById("requestHelpBtn");
const drawer = document.getElementById("drawer");
const confirmationMessage = document.getElementById("confirmationMessage");

let locationRequestTimeout = null;
let requestCancelled = false;

// Handle emergency help button click
requestHelpBtn.addEventListener("click", () => {
  requestCancelled = false;
  drawer.classList.remove("hidden");

  // Start timeout for showing confirmation message after 4 seconds
  locationRequestTimeout = setTimeout(() => {
    if (!requestCancelled) {
      showConfirmationMessage();
    }
  }, 4000);

  // Try to access user location
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        console.log("User location:", position.coords);
        // Store or send the coordinates as needed
      },
      (error) => {
        console.warn("Location access error:", error);
        // Optional: show fallback UI or message
      }
    );
  } else {
    console.warn("Geolocation not supported.");
  }
});

// Show confirmation message
function showConfirmationMessage() {
  confirmationMessage.classList.remove("hidden");
  setTimeout(() => {
    confirmationMessage.classList.add("hidden");
  }, 6000); // Hide after 6 seconds
}

// X button handler: hide drawer only
function closeDrawer() {
  drawer.classList.add("hidden");
}

// Cancel button handler: abort everything
function cancelRequest() {
  requestCancelled = true;
  clearTimeout(locationRequestTimeout);
  drawer.classList.add("hidden");
  confirmationMessage.classList.add("hidden");
  console.log("Emergency request canceled");
}

// Expose functions to window for HTML use
window.closeDrawer = closeDrawer;
window.cancelRequest = cancelRequest;
