import { showSuccessToast, showErrorToast } from "../../common/toast.js";

class ProfileManager {
  constructor() {
    this.originalData = {};
    this.originalImageUrl = null;
    this.currentImageFile = null;

    this.initElements();
    this.initEventListeners();
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
    this.bioInput = document.getElementById("profile-bio");

    this.uploadInput = document.getElementById("profile-upload");
    this.previewContainer = document.getElementById("profile-image-preview-container");

    this.saveButton = document.getElementById("save-profile-changes-btn");
    this.saveText = document.getElementById("save-profile-text");
    this.saveLoading = document.getElementById("save-profile-loading");
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

    this.uploadInput?.addEventListener("change", (e) => this.handleImageSelection(e));
    this.form?.addEventListener("input", () => this.toggleDiscardButton());
    this.form?.addEventListener("submit", (e) => {
      e.preventDefault();
      this.submitForm();
    });
  }

  // 3. Modal
  openModal() {
    document.body.style.overflow = "hidden";
    this.modal.classList.remove("hidden");
    this.fetchProfileData();
    this.hideDiscardButton();
  }

  closeModal() {
    document.body.style.overflow = "";
    this.modal.classList.add("hidden");
    this.form.reset();
    this.currentImageFile = null;
    this.restoreOriginalImage();
    this.hideDiscardButton();
  }

  // 4. Fetch Data
  async fetchProfileData() {
    try {
      const res = await fetch("/mediconnect/backend/api/doctors/get-doctor-profile.php");
      const json = await res.json();
      if (!json.success) throw new Error(json.message || "Failed to load profile");

      const { name, email, bio, profile_image } = json.data;

      this.nameInput.value = name || "";
      this.emailInput.value = email || "";
      this.bioInput.value = bio || "";

      this.originalData = { name, email, bio };
      this.originalImageUrl = profile_image || null;

      this.renderImage(profile_image);
    } catch (err) {
      console.error(err);
      showErrorToast("Error", err.message);
      this.closeModal();
    }
  }

  // 5. Image Preview
  renderImage(url) {
    this.clearPreview();
    if (!url) return; // fallback handled by PHP

    const img = document.createElement("img");
    img.src = url;
    img.className = "w-24 h-24 rounded-full object-cover";
    img.alt = "Profile Picture";
    img.id = "profile-image-preview";

    img.onload = () => {
      this.previewContainer.prepend(img);
    };
  }

  clearPreview() {
    const existing = this.previewContainer.querySelector("#profile-image-preview");
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

  // 6. Discard
  toggleDiscardButton() {
    const changed =
      this.nameInput.value !== this.originalData.name ||
      this.bioInput.value !== this.originalData.bio ||
      this.currentImageFile !== null;
    this.discardButton.classList.toggle("hidden", !changed);
  }

  hideDiscardButton() {
    this.discardButton.classList.add("hidden");
  }

  resetForm() {
    this.nameInput.value = this.originalData.name;
    this.bioInput.value = this.originalData.bio;
    this.uploadInput.value = "";
    this.currentImageFile = null;
    this.restoreOriginalImage();
    this.hideDiscardButton();
  }

  // 7. Submit
  async submitForm() {
    this.saveButton.disabled = true;
    this.saveText.classList.add("hidden");
    this.saveLoading.classList.remove("hidden");

    try {
      const formData = new FormData(this.form);
      if (this.currentImageFile) {
        formData.append("profile_image", this.currentImageFile);
      }

      const res = await fetch("/mediconnect/backend/api/doctors/update-doctor-profile.php", {
        method: "POST",
        body: formData,
      });

      const json = await res.json();
      if (!json.success) throw new Error(json.message || "Failed to update profile");

      const { name, bio, profile_image } = json.data;

      this.originalData = { name, bio };
      this.originalImageUrl = profile_image || null;
      this.currentImageFile = null;

      this.updateStaticContent(name, bio);
      this.updateAvatars(profile_image);
      showSuccessToast("Success", "Profile updated successfully");
      this.closeModal();
    } catch (err) {
      console.error(err);
      showErrorToast("Error", err.message);
    } finally {
      this.saveButton.disabled = false;
      this.saveText.classList.remove("hidden");
      this.saveLoading.classList.add("hidden");
    }
  }

  // 8. Update static content
  updateStaticContent(name, bio) {
    const welcomeHeader = document.querySelector("h1.text-2xl.font-bold.text-gray-900");
    if (welcomeHeader) welcomeHeader.textContent = `Welcome back, Dr. ${name}`;

    const panelHeader = document.querySelector(".text-gray-600");
    if (panelHeader?.textContent?.startsWith("Welcome, Dr.")) {
      panelHeader.textContent = `Welcome, Dr. ${name}`;
    }

    const profileName = document.querySelector('[data-profile-name]');
    if (profileName?.textContent?.startsWith("Dr.")) {
      profileName.textContent = `Dr. ${name}`;
    }

    const dropdownName = document.querySelector(".dropdown .max-w-24");
    if (dropdownName) dropdownName.textContent = name;

    const bioParagraph = document.querySelector('[data-profile-bio]');
    if (bioParagraph) {
      if (bio?.trim()) {
        bioParagraph.className = "text-gray-700 text-sm sm:text-base leading-relaxed";
        bioParagraph.textContent = bio;
      } else {
        bioParagraph.className = "text-gray-500 text-sm sm:text-base italic leading-relaxed";
        bioParagraph.textContent = 'No bio available. Click "Edit Profile" to add your professional background.';
      }
    }
  }

  // 9. Update avatars
  updateAvatars(imageUrl) {
    if (!imageUrl || imageUrl === "null" || imageUrl.trim() === "") return;

    // header
    const headerAvatar = document.querySelector(".dropdown button img, .dropdown button div");
    if (headerAvatar) {
      const newImg = document.createElement("img");
      newImg.src = imageUrl;
      newImg.className = "w-8 h-8 rounded-full object-cover";
      newImg.alt = "Profile";
      headerAvatar.parentNode.replaceChild(newImg, headerAvatar);
    }

    // profile section
    const profileAvatar = document.querySelector('[data-section="my-profile"] .w-24.h-24');
    if (profileAvatar) {
      const newImg = document.createElement("img");
      newImg.src = imageUrl;
      newImg.className = "w-24 h-24 rounded-full object-cover";
      newImg.alt = "Profile";
      profileAvatar.parentNode.replaceChild(newImg, profileAvatar);
    }

    // modal preview
    this.renderImage(imageUrl);
  }
}

// Initialize
export function initProfileManagement() {
  new ProfileManager();
}
