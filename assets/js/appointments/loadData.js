import { setupDropdowns, setupOptionListeners } from "./setupDropdowns.js";

// Load specialties and doctors from database for appointments
export async function loadSpecialties() {
  try {
    const response = await fetch(
      "/mediconnect/backend/api/appointments/get-appointment-specialties.php"
    );
    const data = await response.json();

    if (data.success) {
      const specialtyOptions = document.getElementById("specialty-options");
      specialtyOptions.innerHTML = "";

      data.specialties.forEach((specialty) => {
        const li = document.createElement("li");
        li.innerHTML = `
          <button type="button" 
            class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md"
            data-specialty-id="${specialty.specialty_id}">
            <span>${specialty.name}</span>
            <i data-lucide="check" class="w-4 h-4 text-medical-700 hidden"></i>
          </button>
        `;
        specialtyOptions.appendChild(li);
      });

      // Reinitialize Lucide icons
      lucide.createIcons();

      // Reattach event listeners for specialty dropdown
      const specialtyButton = document.getElementById("speciality-button");
      const specialtyMenu = document.getElementById("specialty-options");
      const specialtySelectedText = specialtyButton.querySelector(
        "span.selected-value"
      );
      if (specialtyButton && specialtyMenu && specialtySelectedText) {
        setupOptionListeners(
          specialtyButton,
          specialtyMenu,
          specialtySelectedText,
          null
        );
      }
    }
  } catch (error) {
    console.error("Error loading specialties:", error);
  }
}

export async function loadDoctors(specialtyId = null) {
  try {
    const url = specialtyId
      ? `/mediconnect/backend/api/appointments/get-appointment-doctors.php?specialty_id=${specialtyId}`
      : "/mediconnect/backend/api/appointments/get-appointment-doctors.php";

    const response = await fetch(url);
    const data = await response.json();

    if (data.success) {
      const doctorOptions = document.getElementById("doctor-options");
      doctorOptions.innerHTML = "";

      if (data.doctors.length === 0) {
        const li = document.createElement("li");
        li.innerHTML = `
          <div class="px-3 py-1.5 text-sm text-gray-500">
            No doctors available for this specialty
          </div>
        `;
        doctorOptions.appendChild(li);
      } else {
        data.doctors.forEach((doctor) => {
          const li = document.createElement("li");
          li.innerHTML = `
            <button type="button" 
              class="select-btn bg-white flex items-center justify-between border-none w-full px-3 py-1.5 text-sm hover:bg-medical-50 hover:text-medical-500 cursor-pointer rounded-md"
              data-doctor-id="${doctor.doctor_id}">
              <span>Dr. ${doctor.first_name} ${doctor.last_name} - ${
            doctor.specialty || "General Medicine"
          }</span>
              <i data-lucide="check" class="w-4 h-4 text-medical-700 hidden"></i>
            </button>
          `;
          doctorOptions.appendChild(li);
        });
      }

      // Reinitialize Lucide icons
      lucide.createIcons();

      // Reattach event listeners for doctor dropdown
      const doctorButton = document.getElementById("doctor-button");
      const doctorMenu = document.getElementById("doctor-options");
      const doctorSelectedText = doctorButton.querySelector(
        "span.selected-value"
      );
      if (doctorButton && doctorMenu && doctorSelectedText) {
        setupOptionListeners(
          doctorButton,
          doctorMenu,
          doctorSelectedText,
          null
        );
      }
    }
  } catch (error) {
    console.error("Error loading doctors:", error);
  }
}

// Initialize data loading
export async function initializeDataLoading() {
  // Load specialties on page load
  await loadSpecialties();

  // Load all doctors initially
  await loadDoctors();
}
