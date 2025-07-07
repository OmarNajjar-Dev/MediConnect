// Get DOM elements
const requestHelpBtn = document.getElementById("requestHelpBtn");
const drawer = document.getElementById("drawer");
const confirmationMessage = document.getElementById("confirmationMessage");
const helpSectionWrapper = document.getElementById("requestHelpWrapper");

let drawerTimeout = null;
let messageTimeout = null;
let requestCancelled = false;

// ✅ Ensure confirmation message is hidden on load
confirmationMessage.classList.add("hidden");

// ✅ Handle click on "Request Emergency Help"
requestHelpBtn.addEventListener("click", () => {
  requestCancelled = false;

  // Show the center drawer
  drawer.classList.remove("hidden");

  // Access location
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        console.log("User location:", position.coords);
      },
      (error) => {
        console.warn("Location access error:", error);
      }
    );
  }

  // After 4 seconds: hide drawer, show message, and replace help section
  drawerTimeout = setTimeout(() => {
    if (!requestCancelled) {
      drawer.classList.add("hidden");
      showConfirmationMessage();
      replaceHelpButtonSection();
    }
  }, 4000);
});

// ✅ Show bottom-right confirmation message
function showConfirmationMessage() {
  if (requestCancelled) return;

  confirmationMessage.classList.remove("hidden");

  messageTimeout = setTimeout(() => {
    confirmationMessage.classList.add("hidden");
  }, 3000);
}

// ✅ Replace button section with success message
function replaceHelpButtonSection() {
  if (!helpSectionWrapper) return;

  helpSectionWrapper.innerHTML = `
    <div class="relative mx-auto mt-6 w-full max-w-4xl rounded-lg border border-solid border-green-200 bg-green-50 px-6 py-4 text-center">
      <h4 class="font-semibold text-green-800">Emergency request active</h4>
      <p class="text-sm text-green-700">Help is on the way. You can view the status below.</p>
    </div>
  `;
}

// ✅ X Button (only hide drawer, continue process)
function closeDrawer() {
  drawer.classList.add("hidden");
}

// ✅ Cancel Button (fully cancel everything)
function cancelRequest() {
  requestCancelled = true;

  clearTimeout(drawerTimeout);
  clearTimeout(messageTimeout);

  drawer.classList.add("hidden");
  confirmationMessage.classList.add("hidden");

  console.log("Request fully cancelled.");
}

// ✅ Expose cancel/close functions to HTML
window.closeDrawer = closeDrawer;
window.cancelRequest = cancelRequest;
