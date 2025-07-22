import { showSuccessToast, showErrorToast } from "../../common/toast.js";

class HospitalManagement {
  constructor() {
    this.hospitals = [];
    this.filteredHospitals = [];
    this.currentEditingHospital = null;
    this.init();
  }

  async init() {
    await this.loadHospitals();
    this.setupEventListeners();
    this.setupModal();
  }

  async loadHospitals() {
    try {
      const response = await fetch(
        "/mediconnect/backend/api/get-hospitals.php"
      );
      const data = await response.json();

      // Handle both old format (direct array) and new format (with success property)
      if (data.success && data.hospitals) {
        this.hospitals = data.hospitals;
      } else if (Array.isArray(data)) {
        this.hospitals = data;
      } else {
        this.hospitals = [];
      }

      this.filteredHospitals = [...this.hospitals];
      this.renderHospitals();
      this.updateHospitalCount();
    } catch (error) {
      console.error("Error loading hospitals:", error);
      this.hospitals = [];
      this.filteredHospitals = [];
      showErrorToast("Error", "Failed to load hospitals");
    }
  }

  setupEventListeners() {
    // Search functionality
    const searchInput = document.getElementById("hospital-search");
    if (searchInput) {
      searchInput.addEventListener("input", (e) => {
        this.filterHospitals(e.target.value);
      });
    }

    // Form submission
    const hospitalForm = document.getElementById("hospital-form");
    if (hospitalForm) {
      hospitalForm.addEventListener("submit", (e) => {
        e.preventDefault();
        this.handleHospitalSubmit();
      });
    }
  }

  setupModal() {
    // Modal triggers
    const addHospitalBtn = document.querySelector(
      '[data-modal-trigger="hospital"]'
    );
    if (addHospitalBtn) {
      addHospitalBtn.addEventListener("click", () => {
        this.openHospitalModal();
      });
    }

    // Modal close buttons
    const closeButtons = document.querySelectorAll(
      '[data-modal-close="hospital"]'
    );
    closeButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        this.closeHospitalModal();
      });
    });

    // Close modal on overlay click
    const overlay = document.querySelector(
      '[data-dialog="overlay"][data-modal-type="hospital"]'
    );
    if (overlay) {
      overlay.addEventListener("click", () => {
        this.closeHospitalModal();
      });
    }
  }

  openHospitalModal(hospital = null) {
    this.currentEditingHospital = hospital;
    const modal = document.querySelector(
      '[data-dialog="modal"][data-modal-type="hospital"]'
    );
    const overlay = document.querySelector(
      '[data-dialog="overlay"][data-modal-type="hospital"]'
    );
    const title = document.getElementById("hospital-modal-title");
    const submitText = document.getElementById("hospital-submit-text");

    if (hospital) {
      // Edit mode
      title.textContent = "Edit Hospital";
      submitText.textContent = "Update Hospital";
      this.populateHospitalForm(hospital);
    } else {
      // Add mode
      title.textContent = "Add New Hospital";
      submitText.textContent = "Add Hospital";
      this.resetHospitalForm();
    }

    overlay.classList.remove("hidden");
    overlay.classList.add("fixed");
    modal.classList.remove("hidden");
    modal.classList.add("fixed");
  }

  closeHospitalModal() {
    const modal = document.querySelector(
      '[data-dialog="modal"][data-modal-type="hospital"]'
    );
    const overlay = document.querySelector(
      '[data-dialog="overlay"][data-modal-type="hospital"]'
    );

    overlay.classList.add("hidden");
    overlay.classList.remove("fixed");
    modal.classList.add("hidden");
    modal.classList.remove("fixed");

    this.currentEditingHospital = null;
    this.resetHospitalForm();
  }

  populateHospitalForm(hospital) {
    document.getElementById("hospital-name").value = hospital.name || "";
    document.getElementById("hospital-address").value = hospital.address || "";
    document.getElementById("hospital-contact").value = hospital.contact || "";
    document.getElementById("hospital-beds").value =
      hospital.available_beds || "";
    document.getElementById("hospital-emergency").checked =
      hospital.emergency_services == 1;
    document.getElementById("hospital-image").value = hospital.image_url || "";
  }

  resetHospitalForm() {
    document.getElementById("hospital-form").reset();
  }

  async handleHospitalSubmit() {
    const submitBtn = document.getElementById("hospital-submit-btn");
    const submitText = document.getElementById("hospital-submit-text");
    const submitLoading = document.getElementById("hospital-submit-loading");

    // Show loading state
    submitBtn.disabled = true;
    submitText.classList.add("hidden");
    submitLoading.classList.remove("hidden");

    try {
      const formData = new FormData(document.getElementById("hospital-form"));
      const hospitalData = Object.fromEntries(formData.entries());

      // Convert checkbox to boolean
      hospitalData.emergencyServices =
        document.getElementById("hospital-emergency").checked;

      // Validate required fields
      if (
        !hospitalData.name ||
        !hospitalData.address ||
        !hospitalData.contact
      ) {
        throw new Error("Please fill in all required fields");
      }

      const url = this.currentEditingHospital
        ? "/mediconnect/backend/api/update-hospital.php"
        : "/mediconnect/backend/api/create-hospital.php";

      const method = this.currentEditingHospital ? "PUT" : "POST";

      if (this.currentEditingHospital) {
        hospitalData.hospitalId = this.currentEditingHospital.hospital_id;
      }

      const response = await fetch(url, {
        method: method,
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(hospitalData),
      });

      const result = await response.json();

      if (result.success) {
        showSuccessToast("Success", result.message);
        this.closeHospitalModal();
        await this.loadHospitals();
      } else {
        throw new Error(result.message || "Operation failed");
      }
    } catch (error) {
      console.error("Error submitting hospital:", error);
      showErrorToast("Error", error.message);
    } finally {
      // Reset loading state
      submitBtn.disabled = false;
      submitText.classList.remove("hidden");
      submitLoading.classList.add("hidden");
    }
  }

  async deleteHospital(hospitalId) {
    if (
      !confirm(
        "Are you sure you want to delete this hospital? This action cannot be undone."
      )
    ) {
      return;
    }

    try {
      const response = await fetch(
        "/mediconnect/backend/api/delete-hospital.php",
        {
          method: "DELETE",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ hospitalId }),
        }
      );

      const result = await response.json();

      if (result.success) {
        showSuccessToast("Success", result.message);
        await this.loadHospitals();
      } else {
        throw new Error(result.message || "Failed to delete hospital");
      }
    } catch (error) {
      console.error("Error deleting hospital:", error);
      showErrorToast("Error", error.message);
    }
  }

  filterHospitals(searchTerm) {
    this.filteredHospitals = this.hospitals.filter((hospital) => {
      return (
        !searchTerm ||
        hospital.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        hospital.address.toLowerCase().includes(searchTerm.toLowerCase()) ||
        hospital.contact.toLowerCase().includes(searchTerm.toLowerCase())
      );
    });

    this.renderHospitals();
    this.updateHospitalCount();
  }

  renderHospitals() {
    const tbody = document.getElementById("hospitals-table-body");
    if (!tbody) return;

    if (this.filteredHospitals.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="7" class="p-8 text-center text-gray-500">
            No hospitals found
          </td>
        </tr>
      `;
      return;
    }

    tbody.innerHTML = this.filteredHospitals
      .map((hospital) => this.createHospitalRow(hospital))
      .join("");

    // Re-initialize Lucide icons
    if (window.lucide) {
      lucide.createIcons();
    }
  }

  createHospitalRow(hospital) {
    const emergencyBadge =
      hospital.emergency_services == 1
        ? '<div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-green-100 text-green-800">Yes</div>'
        : '<div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-gray-100 text-gray-800">No</div>';

    return `
      <tr class="border-b border-solid border-card-soft transition-colors hover:bg-muted/50">
        <td class="p-4 font-medium">${hospital.name}</td>
        <td class="p-4">
          <div class="flex items-center">
            <i data-lucide="map-pin" class="h-4 w-4 mr-1 text-gray-400"></i>
            ${hospital.address}
          </div>
        </td>
        <td class="p-4">
          <div class="flex items-center">
            <i data-lucide="phone" class="h-4 w-4 mr-1 text-gray-400"></i>
            ${hospital.contact}
          </div>
        </td>
        <td class="p-4">
          <div class="flex items-center">
            <i data-lucide="building" class="h-4 w-4 mr-1 text-gray-400"></i>
            ${hospital.available_beds || 0}
          </div>
        </td>
        <td class="p-4 hidden sm:table-cell">
          ${emergencyBadge}
        </td>
        <td class="p-4">
          <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors border border-solid border-transparent bg-primary text-white hover:bg-medical-400">
            active
          </div>
        </td>
        <td class="p-4 text-right">
          <div class="flex gap-2 justify-end">
            <button onclick="hospitalManagement.openHospitalModal(${JSON.stringify(
              hospital
            ).replace(/"/g, "&quot;")})" 
                    class="rounded-md h-8 w-8 p-0 hover:bg-accent cursor-pointer bg-transparent border-none hover:text-medical-500">
              <i data-lucide="square-pen" class="h-4 w-4"></i>
            </button>
            <button onclick="hospitalManagement.deleteHospital(${
              hospital.hospital_id
            })" 
                    class="rounded-md h-8 w-8 p-0 text-red-600 hover:text-red-800 hover:bg-red-50 cursor-pointer bg-transparent border-none">
              <i data-lucide="trash-2" class="h-4 w-4"></i>
            </button>
          </div>
        </td>
      </tr>
    `;
  }

  updateHospitalCount() {
    const countElement = document.getElementById("hospitals-count");
    if (countElement) {
      countElement.textContent = `All Hospitals (${this.filteredHospitals.length})`;
    }
  }
}

// Initialize and export
const hospitalManagement = new HospitalManagement();
window.hospitalManagement = hospitalManagement;

export default hospitalManagement;
