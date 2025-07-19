import { showSuccessToast, showErrorToast } from "../../common/toast.js";

class ProfileManager {
  constructor() {
    this.originalData = {};
    this.currentImageFile = null;
    this.originalImageSrc = null;
    this.isInitialized = false;

    this.initializeElements();
    this.setupEventListeners();
    this.isInitialized = true;
  }

  initializeElements() {
    this.editProfileBtn = document.getElementById("edit-profile-btn");
    this.modal = document.getElementById("edit-profile-modal");
    this.overlay = document.getElementById("edit-profile-overlay");
    this.closeModalBtn = document.getElementById("close-profile-modal-btn");
    this.cancelBtn = document.getElementById("cancel-profile-edit-btn");
    this.discardBtn = document.getElementById("discard-profile-changes-btn");
    this.form = document.getElementById("edit-profile-form");
    this.imagePreview = document.getElementById("profile-image-preview");
    this.avatarInitials = document.getElementById("profile-avatar-initials");
    this.imageUploadInput = document.getElementById("profile-upload");
    this.saveButton = document.getElementById("save-profile-changes-btn");
    this.saveText = document.getElementById("save-profile-text");
    this.saveLoading = document.getElementById("save-profile-loading");
  }

  setupEventListeners() {
    // Modal triggers
    this.editProfileBtn?.addEventListener("click", () => this.openModal());
    this.closeModalBtn?.addEventListener("click", () => this.closeModal());
    this.cancelBtn?.addEventListener("click", () => this.closeModal());
    this.discardBtn?.addEventListener("click", () =>
      this.handleDiscardChanges()
    );

    // Overlay click to close
    this.overlay?.addEventListener("click", (e) => {
      if (e.target === this.overlay) {
        this.closeModal();
      }
    });

    // Form submission
    this.form?.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleFormSubmit(e);
    });

    // Image upload handling
    this.imageUploadInput?.addEventListener("change", (e) =>
      this.handleImageSelection(e)
    );

    // Track changes to show/hide discard button
    this.form?.addEventListener("input", () => this.checkForChanges());
  }

  openModal() {
    if (!this.modal) return;

    document.body.style.overflow = "hidden";
    this.modal.classList.remove("hidden");
    this.fetchProfileData();
    this.resetDiscardButton();
  }

  closeModal() {
    if (!this.modal) return;

    document.body.style.overflow = "";
    this.modal.classList.add("hidden");
    this.form?.reset();
    this.currentImageFile = null;
    this.resetDiscardButton();
    this.restoreOriginalImage();
  }

  async fetchProfileData() {
    try {
      const response = await fetch(
        "/mediconnect/backend/api/get-doctor-profile.php"
      );
      const result = await response.json();

      if (result.success) {
        this.populateForm(result.data);
        this.setupInitialState(result.data);
      } else {
        showErrorToast("Error", result.message);
        this.closeModal();
      }
    } catch (error) {
      console.error("Error fetching profile data:", error);
      showErrorToast("Error", "Failed to load profile data");
      this.closeModal();
    }
  }

  setupInitialState(data) {
    // Store original values for comparison
    this.originalData = {
      name: data.name || "",
      email: data.email || "",
      bio: data.bio || "",
      profile_image: data.profile_image || null,
    };

    // Store original image source
    this.originalImageSrc = data.profile_image || null;
  }

  populateForm(data) {
    // Populate text fields
    const nameInput = document.getElementById("profile-name");
    const emailInput = document.getElementById("profile-email");
    const bioInput = document.getElementById("profile-bio");

    if (nameInput) nameInput.value = data.name || "";
    if (emailInput) emailInput.value = data.email || "";
    if (bioInput) bioInput.value = data.bio || "";

    // Handle profile image display
    this.updateAvatarDisplay(data.profile_image, data.name);
  }

  updateAvatarDisplay(imagePath, name) {
    if (imagePath) {
      this.imagePreview.src = imagePath;
      this.imagePreview.classList.remove("hidden");
      this.avatarInitials.classList.add("hidden");
    } else {
      this.avatarInitials.textContent = (name || "")
        .split(" ")
        .map((n) => n[0])
        .join("")
        .toUpperCase();
      this.avatarInitials.classList.remove("hidden");
      this.imagePreview.classList.add("hidden");
    }
  }

  handleImageSelection(event) {
    const file = event.target.files[0];
    if (!file) return;

    this.currentImageFile = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      this.imagePreview.src = e.target.result;
      this.imagePreview.classList.remove("hidden");
      this.avatarInitials.classList.add("hidden");
      this.checkForChanges();
    };
    reader.readAsDataURL(file);
  }

  checkForChanges() {
    if (!this.isInitialized || !this.discardBtn) return;

    const nameInput = document.getElementById("profile-name");
    const bioInput = document.getElementById("profile-bio");

    const hasChanges =
      (nameInput && nameInput.value !== this.originalData.name) ||
      (bioInput && bioInput.value !== this.originalData.bio) ||
      this.currentImageFile !== null;

    if (hasChanges) {
      this.discardBtn.classList.remove("hidden");
    } else {
      this.discardBtn.classList.add("hidden");
    }
  }

  handleDiscardChanges() {
    // Reset form to original values
    const nameInput = document.getElementById("profile-name");
    const bioInput = document.getElementById("profile-bio");

    if (nameInput) nameInput.value = this.originalData.name;
    if (bioInput) bioInput.value = this.originalData.bio;

    // Reset image
    this.currentImageFile = null;
    this.imageUploadInput.value = "";
    this.restoreOriginalImage();

    this.resetDiscardButton();
  }

  restoreOriginalImage() {
    if (this.originalImageSrc) {
      this.imagePreview.src = this.originalImageSrc;
      this.imagePreview.classList.remove("hidden");
      this.avatarInitials.classList.add("hidden");
    } else {
      this.imagePreview.classList.add("hidden");
      this.avatarInitials.classList.remove("hidden");
    }
  }

  resetDiscardButton() {
    if (this.discardBtn) {
      this.discardBtn.classList.add("hidden");
    }
  }

  async handleFormSubmit(event) {
    event.preventDefault();

    if (!this.saveButton || !this.saveText || !this.saveLoading) return;

    try {
      // Show loading state
      this.saveButton.disabled = true;
      this.saveText.classList.add("hidden");
      this.saveLoading.classList.remove("hidden");

      const formData = new FormData(this.form);
      if (this.currentImageFile) {
        formData.append("profile_image", this.currentImageFile);
      }

      const response = await fetch(
        "/mediconnect/backend/api/update-doctor-profile.php",
        {
          method: "POST",
          body: formData,
        }
      );

      const result = await response.json();

      if (result.success) {
        showSuccessToast("Success", "Profile updated successfully");
        this.closeModal();

        // Update the original data with new values
        const nameInput = document.getElementById("profile-name");
        const bioInput = document.getElementById("profile-bio");

        if (nameInput) this.originalData.name = nameInput.value;
        if (bioInput) this.originalData.bio = bioInput.value;

        // Update the page elements with new profile data
        this.updatePageElements(
          nameInput?.value,
          bioInput?.value,
          this.currentImageFile
        );

        // Update header avatar if image was changed
        if (this.currentImageFile) {
          this.updateHeaderAvatar();
        }

        // Remove the page reload - let the toast stay visible
        // window.location.reload(); // REMOVED: This was causing the toast to disappear
      } else {
        throw new Error(result.message || "Failed to update profile");
      }
    } catch (error) {
      console.error("Error updating profile:", error);
      showErrorToast("Error", error.message);
    } finally {
      // Restore button state
      this.saveButton.disabled = false;
      this.saveText.classList.remove("hidden");
      this.saveLoading.classList.add("hidden");
    }
  }

  updatePageElements(name, bio, imageFile) {
    // Update welcome messages with doctor name
    if (name) {
      // Update "Welcome back, Dr. {name}" message
      const welcomeHeader = document.querySelector(
        "h1.text-2xl.font-bold.text-gray-900"
      );
      if (welcomeHeader) {
        welcomeHeader.textContent = `Welcome back, Dr. ${name}`;
      }

      // Update "Welcome, Dr. {name}" message in doctor panel
      const welcomePanel = document.querySelector(".text-gray-600");
      if (welcomePanel && welcomePanel.textContent.startsWith("Welcome, Dr.")) {
        welcomePanel.textContent = `Welcome, Dr. ${name}`;
      }

      // Update profile section name display
      const profileNameElement = document.querySelector(
        ".lg\\:col-span-2 .grid .min-w-0 p"
      );
      if (
        profileNameElement &&
        profileNameElement.textContent.startsWith("Dr.")
      ) {
        profileNameElement.textContent = `Dr. ${name}`;
      }

      // Update dropdown header name
      const dropdownName = document.querySelector(".dropdown .max-w-24");
      if (dropdownName) {
        dropdownName.textContent = name;
      }
    }

    // Update bio in profile section
    if (bio !== undefined) {
      const bioElement = document.querySelector(
        '[data-section="profile"] .text-gray-700.leading-relaxed'
      );
      const bioContainer = bioElement?.parentElement;

      if (bioContainer) {
        if (bio && bio.trim()) {
          // Show bio text with proper escaping
          const label = document.createElement("label");
          label.className = "font-medium text-sm";
          label.textContent = "Professional Bio";

          const bioParagraph = document.createElement("p");
          bioParagraph.className =
            "text-gray-700 text-sm sm:text-base leading-relaxed";
          bioParagraph.textContent = bio;

          bioContainer.innerHTML = "";
          bioContainer.appendChild(label);
          bioContainer.appendChild(bioParagraph);
        } else {
          // Show "no bio" message
          bioContainer.innerHTML = `
            <label class="font-medium text-sm">Professional Bio</label>
            <p class="text-gray-500 text-sm sm:text-base leading-relaxed italic">
              No bio available. Click "Edit Profile" to add your professional background.
            </p>
          `;
        }
      }
    }

    // Update profile picture in profile section if image was uploaded
    if (imageFile && this.imagePreview.src) {
      const profileDisplayAvatar = document.querySelector(
        '[data-section="profile"] .w-24.h-24'
      );
      if (profileDisplayAvatar) {
        // Replace with new image
        const newImg = document.createElement("img");
        newImg.src = this.imagePreview.src;
        newImg.className = "w-24 h-24 rounded-full object-cover";
        newImg.alt = "Profile Picture";
        profileDisplayAvatar.parentNode.replaceChild(
          newImg,
          profileDisplayAvatar
        );
      }
    }
  }

  updateHeaderAvatar() {
    // Update the header avatar with the current image preview
    const headerAvatar = document.querySelector(
      ".dropdown button img, .dropdown button div"
    );
    if (headerAvatar && this.imagePreview.src) {
      if (headerAvatar.tagName === "IMG") {
        headerAvatar.src = this.imagePreview.src;
      } else {
        // Replace the initials div with an image
        const imgElement = document.createElement("img");
        imgElement.src = this.imagePreview.src;
        imgElement.className = "w-8 h-8 rounded-full object-cover";
        imgElement.alt = "Profile";
        headerAvatar.parentNode.replaceChild(imgElement, headerAvatar);
      }
    }
  }
}

export function initProfileManagement() {
  new ProfileManager();
}
