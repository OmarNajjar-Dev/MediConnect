import { showSuccessToast, showErrorToast } from "../../common/toast.js";

/**
 * Initialize appointment management functionality
 */
export function initAppointmentManagement() {
  setupAppointmentButtons();
}

/**
 * Setup appointment action buttons
 */
function setupAppointmentButtons() {
  // Buttons are disabled with tooltips - no functionality needed
  // This function is kept for future implementation
}

/**
 * Refresh appointment statistics
 */
async function refreshAppointmentStats() {
  try {
    const response = await fetch(
      "/backend/api/doctors/get-doctor-appointments.php?date=" +
        new Date().toISOString().split("T")[0]
    );
    const data = await response.json();

    if (data.success) {
      const statElements = document.querySelectorAll(
        ".glass-card .text-2xl.font-bold"
      );
      if (statElements.length >= 4) {
        statElements[0].textContent = data.stats.total || 0;
        statElements[1].textContent = data.stats.scheduled || 0;
        statElements[2].textContent = data.stats.completed || 0;
        statElements[3].textContent = data.stats.cancelled || 0;
      }
    }
  } catch (error) {
    console.error("Error refreshing stats:", error);
  }
}
