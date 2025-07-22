export function validateForm() {
  let isValid = true;
  const errors = [];

  function toggleError(condition, errorId, errorMessage) {
    const errorEl = document.getElementById(errorId);
    if (!errorEl) {
      console.warn(`Error element with id '${errorId}' not found`);
      return;
    }

    if (condition) {
      errorEl.classList.remove("hidden");
      isValid = false;
      errors.push(errorMessage);
    } else {
      errorEl.classList.add("hidden");
    }
  }

  const selectedValues = document.querySelectorAll(".selected-value");
  const specialtyText = selectedValues[0]?.textContent.trim();
  const doctorText = selectedValues[1]?.textContent.trim();
  const dateText = selectedValues[2]?.textContent.trim();
  const timeText = selectedValues[3]?.textContent.trim();

  toggleError(
    specialtyText === "" || specialtyText.toLowerCase().includes("select"),
    "error-speciality",
    "Specialty selection is required"
  );

  toggleError(
    doctorText === "" || doctorText === "Select a doctor",
    "error-doctor",
    "Doctor selection is required"
  );

  toggleError(
    dateText === "" || dateText === "Pick a date",
    "error-date",
    "Appointment date is required"
  );

  toggleError(
    timeText === "" || timeText === "Select a time",
    "error-timeSlot",
    "Time slot selection is required"
  );

  const reasonText = document.getElementById("reason")?.value.trim() || "";
  toggleError(
    reasonText === "",
    "error-reason",
    "Reason for visit is required"
  );

  // Additional validation: Check if date is in the future
  if (
    dateText &&
    dateText !== "Pick a date" &&
    timeText &&
    timeText !== "Select a time"
  ) {
    const appointmentDateTime = new Date(`${dateText} ${timeText}`);
    const now = new Date();

    if (appointmentDateTime <= now) {
      toggleError(
        true,
        "error-date",
        "Appointment must be scheduled for a future date and time"
      );
    }
  }

  return isValid;
}
