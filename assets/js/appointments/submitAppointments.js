import { showSuccessToast, showErrorToast } from "../common/toast.js";

export async function submitAppointment() {
  // Get submit button and set loading state
  const submitButton = document.querySelector(
    '#appointment-form button[type="submit"]'
  );
  const originalButtonText = submitButton.textContent;

  // Set loading state
  submitButton.disabled = true;
  submitButton.textContent = "Scheduling...";
  submitButton.classList.add("opacity-50", "cursor-not-allowed");

  try {
    // Get form values
    const specialty = document
      .getElementById("selected-speciality")
      ?.textContent.trim();
    const doctorText = document
      .getElementById("selected-doctor")
      ?.textContent.trim();
    const date = document.getElementById("selected-date")?.textContent.trim();
    const time = document.getElementById("selected-time")?.textContent.trim();
    const reason = document.getElementById("reason")?.value.trim();
    const notes = document.getElementById("notes")?.value.trim();

    // Extract doctor_id from the selected doctor button
    let doctorId = null;
    const doctorOptions = document.querySelectorAll(
      "#doctor-options button.select-btn"
    );
    doctorOptions.forEach((btn) => {
      if (btn.textContent.trim() === doctorText) {
        doctorId = btn.getAttribute("data-doctor-id");
      }
    });

    // Validate required fields
    if (!specialty || specialty === "Select a specialty") {
      showErrorToast("Validation Error", "Please select a specialty");
      return;
    }

    if (!doctorId) {
      showErrorToast("Validation Error", "Please select a doctor");
      return;
    }

    if (!date || date === "Pick a date") {
      showErrorToast("Validation Error", "Please select a date");
      return;
    }

    if (!time || time === "Select a time") {
      showErrorToast("Validation Error", "Please select a time");
      return;
    }

    if (!reason) {
      showErrorToast(
        "Validation Error",
        "Please provide a reason for your visit"
      );
      return;
    }

    const response = await fetch(
      "/mediconnect/backend/api/appointments/create-appointment.php",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          specialty,
          doctor: doctorId,
          date,
          time,
          reason,
          notes,
        }),
      }
    );

    const result = await response.json();

    if (result.success) {
      showSuccessToast(
        "Success!",
        "Appointment scheduled successfully. You will receive a confirmation shortly."
      );
      // Reset form
      resetForm();
    } else {
      showErrorToast(
        "Error",
        result.message || "Failed to schedule appointment. Please try again."
      );
    }
  } catch (error) {
    console.error("Submission error:", error);
    showErrorToast(
      "Network Error",
      "Unable to connect to the server. Please check your internet connection and try again."
    );
  } finally {
    // Reset button state
    submitButton.disabled = false;
    submitButton.textContent = originalButtonText;
    submitButton.classList.remove("opacity-50", "cursor-not-allowed");
  }
}

function resetForm() {
  // Reset all selected values
  const selectedValues = document.querySelectorAll(".selected-value");
  selectedValues[0].textContent = "Select a specialty"; // specialty
  selectedValues[1].textContent = "Select a doctor"; // doctor
  selectedValues[2].textContent = "Pick a date"; // date
  selectedValues[3].textContent = "Select a time"; // time

  // Reset text areas
  document.getElementById("reason").value = "";
  document.getElementById("notes").value = "";

  // Reset dropdown selections
  const selectedButtons = document.querySelectorAll(".select-btn");
  selectedButtons.forEach((btn) => {
    btn.querySelector("svg")?.classList.add("hidden");
    btn.classList.remove("bg-neutral-100");
    btn.classList.add("bg-white");
  });

  // Hide error messages
  const errorMessages = document.querySelectorAll("[id^='error-']");
  errorMessages.forEach((error) => {
    error.classList.add("hidden");
  });
}
