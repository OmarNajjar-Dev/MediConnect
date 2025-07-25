// js/dashboard/patient/profile.js
import { showSuccessToast, showErrorToast } from "../../common/toast.js";

class ProfileManager {
  constructor() {
    this.originalData = {};
    this.originalImageUrl = null;
    this.currentImageFile = null;
    this.isInitialized = false;

    this.init();
  }

  init() {
    if (this.isInitialized) return;

    this.initElements();
    this.initEventListeners();
    this.isInitialized = true;
  }

  // 1. DOM Elements
  initElements() {
    this.modal = document.getElementById("edit-profile-modal");
    this.overlay = document.getElementById("edit-profile-overlay");

    this.editButton = document.getElementById("edit-profile-btn");
    this.closeButton = document.getElementById("close-profile-modal-btn");
    this.cancelButton = document.getElementById("cancel-profile-edit-btn");
    this.discardButton = document.getElementById("discard-profile-changes-btn");

    this.form = document.getElementById("edit-profile-form");
    this.nameInput = document.getElementById("profile-name");
    this.emailInput = document.getElementById("profile-email");
    this.birthdateInput = document.getElementById("profile-birthdate");
    this.genderInput = document.querySelector('[data-dropdown="container"]');
    this.cityInput = document.getElementById("profile-city");
    this.addressInput = document.getElementById("profile-address");

    this.uploadInput = document.getElementById("profile-upload");
    this.previewContainer = document.getElementById(
      "profile-image-preview-container"
    );

    this.saveButton = document.getElementById("save-profile-changes-btn");
    this.saveText = document.getElementById("save-profile-text");
    this.saveLoading = document.getElementById("save-profile-loading");

    // Validate that all required elements exist
    if (!this.modal || !this.form || !this.editButton) {
      console.error("Required profile management elements not found");
      return;
    }
  }

  // 2. Events
  initEventListeners() {
    this.editButton?.addEventListener("click", () => this.openModal());
    this.closeButton?.addEventListener("click", () => this.closeModal());
    this.cancelButton?.addEventListener("click", () => this.closeModal());
    this.discardButton?.addEventListener("click", () => this.resetForm());

    this.overlay?.addEventListener("click", (e) => {
      if (e.target === this.overlay) this.closeModal();
    });

    this.uploadInput?.addEventListener("change", (e) =>
      this.handleImageSelection(e)
    );

    // Monitor form changes
    this.form?.addEventListener("input", () => this.toggleDiscardButton());
    this.form?.addEventListener("submit", (e) => {
      e.preventDefault();
      this.submitForm();
    });

    // Initialize dropdown functionality
    this.initDropdown();
  }

  // 3. Dropdown initialization
  initDropdown() {
    if (!this.genderInput) return;

    const button = this.genderInput.querySelector('[data-dropdown="button"]');
    const menu = this.genderInput.querySelector('[data-dropdown="menu"]');
    const options = this.genderInput.querySelectorAll(
      '[data-dropdown="option"]'
    );
    const hiddenInput = document.getElementById("gender-input");

    if (!button || !menu || !hiddenInput) return;

    // Toggle dropdown
    button.addEventListener("click", () => {
      menu.classList.toggle("hidden");
    });

    // Handle option selection
    options.forEach((option) => {
      option.addEventListener("click", () => {
        const value = option.getAttribute("data-value");

        // Update hidden input
        hiddenInput.value = value;

        // Update button text
        button.querySelector("span").textContent = this.capitalize(value);

        // Update checkmarks
        options.forEach((opt) => {
          const checkIcon = opt.querySelector("svg");
          if (opt.getAttribute("data-value") === value) {
            checkIcon?.classList.remove("hidden");
          } else {
            checkIcon?.classList.add("hidden");
          }
        });

        // Close dropdown
        menu.classList.add("hidden");

        // Check for changes
        this.toggleDiscardButton();
      });
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", (e) => {
      if (!this.genderInput.contains(e.target)) {
        menu.classList.add("hidden");
      }
    });
  }

  // 4. Modal
  openModal() {
    if (!this.modal) return;

    document.body.style.overflow = "hidden";
    this.modal.classList.remove("hidden");
    this.fetchProfileData();
    this.hideDiscardButton();
  }

  closeModal() {
    if (!this.modal) return;

    document.body.style.overflow = "";
    this.modal.classList.add("hidden");
    this.form?.reset();
    this.currentImageFile = null;
    this.restoreOriginalImage();
    this.hideDiscardButton();
  }

  // 5. Fetch Data
  async fetchProfileData() {
    try {
      const res = await fetch("/backend/api/patients/get-patient-profile.php");
      const json = await res.json();
      if (!json.success)
        throw new Error(json.message || "Failed to load profile");

      const { name, email, birthdate, gender, city, address, profile_image } =
        json.data;

      if (this.nameInput) this.nameInput.value = name || "";
      if (this.emailInput) this.emailInput.value = email || "";
      if (this.birthdateInput) this.birthdateInput.value = birthdate || "";
      if (this.cityInput) this.cityInput.value = city || "";
      if (this.addressInput) this.addressInput.value = address || "";

      this.setGenderValue(gender || "");

      this.originalData = { name, birthdate, gender, city, address };
      this.originalImageUrl = profile_image || null;

      this.renderImage(profile_image);
    } catch (err) {
      console.error("Error fetching profile data:", err);
      showErrorToast("Error", err.message);
      this.closeModal();
    }
  }

  // 6. Image Preview
  renderImage(url) {
    this.clearPreview();
    if (!url) return;

    const img = document.createElement("img");
    img.src = url;
    img.className = "w-24 h-24 rounded-full object-cover";
    img.alt = "Profile Picture";
    img.id = "profile-image-preview";

    img.onload = () => {
      if (this.previewContainer) {
        this.previewContainer.prepend(img);
      }
    };
  }

  clearPreview() {
    if (!this.previewContainer) return;

    const existing = this.previewContainer.querySelector(
      "#profile-image-preview"
    );
    if (existing) existing.remove();
  }

  handleImageSelection(e) {
    const file = e.target.files[0];
    if (!file) return;

    if (!file.type.startsWith("image/")) {
      return showErrorToast("Error", "Only image files are allowed");
    }

    if (file.size > 5 * 1024 * 1024) {
      return showErrorToast("Error", "Image size must be less than 5MB");
    }

    this.currentImageFile = file;

    const reader = new FileReader();
    reader.onload = (event) => {
      this.renderPreviewFromDataUrl(event.target.result);
      this.toggleDiscardButton();
    };
    reader.readAsDataURL(file);
  }

  renderPreviewFromDataUrl(dataUrl) {
    this.clearPreview();
    if (!this.previewContainer) return;

    const img = document.createElement("img");
    img.src = dataUrl;
    img.className = "w-24 h-24 rounded-full object-cover";
    img.alt = "Selected Image";
    img.id = "profile-image-preview";
    this.previewContainer.prepend(img);
  }

  restoreOriginalImage() {
    this.renderImage(this.originalImageUrl);
  }

  // 7. Gender handling
  setGenderValue(value) {
    if (!value || !this.genderInput) return;

    const button = this.genderInput.querySelector('[data-dropdown="button"]');
    const options = this.genderInput.querySelectorAll(
      '[data-dropdown="option"]'
    );
    const hiddenInput = document.getElementById("gender-input");

    if (!button || !hiddenInput) return;

    options.forEach((opt) => {
      const optionValue = opt.getAttribute("data-value");
      const checkIcon = opt.querySelector("svg");

      if (optionValue === value.toLowerCase()) {
        checkIcon?.classList.remove("hidden");
        hiddenInput.value = value.toLowerCase();
        // Update button text to show selected gender
        const span = button.querySelector("span");
        if (span) span.textContent = this.capitalize(value);
      } else {
        checkIcon?.classList.add("hidden");
      }
    });
  }

  getSelectedGender() {
    const hiddenInput = document.getElementById("gender-input");
    const value = hiddenInput?.value;
    return value ? this.capitalize(value) : "";
  }

  capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
  }

  // 8. Discard functionality
  toggleDiscardButton() {
    if (!this.discardButton) return;

    const changed =
      (this.nameInput && this.nameInput.value !== this.originalData.name) ||
      (this.birthdateInput &&
        this.birthdateInput.value !== this.originalData.birthdate) ||
      this.getSelectedGender() !== this.originalData.gender ||
      (this.cityInput && this.cityInput.value !== this.originalData.city) ||
      (this.addressInput &&
        this.addressInput.value !== this.originalData.address) ||
      this.currentImageFile !== null;

    this.discardButton.classList.toggle("hidden", !changed);
  }

  hideDiscardButton() {
    if (this.discardButton) {
      this.discardButton.classList.add("hidden");
    }
  }

  resetForm() {
    if (this.nameInput) this.nameInput.value = this.originalData.name || "";
    if (this.birthdateInput)
      this.birthdateInput.value = this.originalData.birthdate || "";
    if (this.cityInput) this.cityInput.value = this.originalData.city || "";
    if (this.addressInput)
      this.addressInput.value = this.originalData.address || "";

    this.setGenderValue(this.originalData.gender || "");

    if (this.uploadInput) this.uploadInput.value = "";
    this.currentImageFile = null;
    this.restoreOriginalImage();
    this.hideDiscardButton();
  }

  // 9. Submit
  async submitForm() {
    if (!this.saveButton || !this.saveText || !this.saveLoading) return;

    this.saveButton.disabled = true;
    this.saveText.classList.add("hidden");
    this.saveLoading.classList.remove("hidden");

    try {
      const formData = new FormData(this.form);
      formData.set("gender", this.getSelectedGender());
      if (this.currentImageFile) {
        formData.append("profile_image", this.currentImageFile);
      }

      const res = await fetch(
        "/backend/api/patients/update-patient-profile.php",
        {
          method: "POST",
          body: formData,
        }
      );

      const json = await res.json();
      if (!json.success)
        throw new Error(json.message || "Failed to update profile");

      const { name, birthdate, gender, city, address, profile_image } =
        json.data;

      this.originalData = { name, birthdate, gender, city, address };
      this.originalImageUrl = profile_image || null;
      this.currentImageFile = null;

      this.updateStaticContent(name, birthdate, gender, city, address);
      this.updateAvatars(profile_image);
      showSuccessToast("Success", "Profile updated successfully");
      this.closeModal();
    } catch (err) {
      console.error("Error updating profile:", err);
      showErrorToast("Error", err.message);
    } finally {
      this.saveButton.disabled = false;
      this.saveText.classList.remove("hidden");
      this.saveLoading.classList.add("hidden");
    }
  }

  // 10. Update Static Content
  updateStaticContent(name, birthdate, gender, city, address) {
    const nameEl = document.querySelector("[data-profile-name]");
    if (nameEl) nameEl.textContent = name;

    const birthdateEl = document.querySelector("[data-profile-birthdate]");
    if (birthdateEl) birthdateEl.textContent = birthdate || "Not specified";

    const genderEl = document.querySelector("[data-profile-gender]");
    if (genderEl) genderEl.textContent = gender || "Not specified";

    const cityEl = document.querySelector("[data-profile-city]");
    if (cityEl) cityEl.textContent = city || "Not specified";

    const addressEl = document.querySelector("[data-profile-address]");
    if (addressEl) addressEl.textContent = address || "Not specified";
  }

  // 11. Update Avatars
  updateAvatars(imageUrl) {
    if (!imageUrl || imageUrl === "null" || imageUrl.trim() === "") return;

    // Update header avatar
    const headerAvatar = document.querySelector(
      ".dropdown button img, .dropdown button div"
    );
    if (headerAvatar) {
      const newImg = document.createElement("img");
      newImg.src = imageUrl;
      newImg.className = "w-8 h-8 rounded-full object-cover";
      newImg.alt = "Profile";
      headerAvatar.parentNode.replaceChild(newImg, headerAvatar);
    }

    // Update profile section avatar
    const profileAvatar = document.querySelector(
      '[data-section="my-profile"] .w-24.h-24'
    );
    if (profileAvatar) {
      const newImg = document.createElement("img");
      newImg.src = imageUrl;
      newImg.className = "w-24 h-24 rounded-full object-cover";
      newImg.alt = "Profile Picture";
      profileAvatar.parentNode.replaceChild(newImg, profileAvatar);
    }

    this.renderImage(imageUrl);
  }
}

// Initialize
export function initProfileManagement() {
  new ProfileManager();
}
