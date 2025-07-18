import { showSuccessToast, showErrorToast } from "../../common/toast.js";

class ProfileManager {
  constructor() {
    this.originalData = {};
    this.currentImageFile = null;
    this.originalImageSrc = null;
    this.isInitialized = false;
  }

  init() {
    if (this.isInitialized) return;

    this.setupInitialState();
    this.setupEventListeners();
    this.isInitialized = true;
  }

  setupInitialState() {
    // Store original values
    const nameInput = document.getElementById("admin-name");
    const emailInput = document.getElementById("admin-email");
    const cityInput = document.getElementById("admin-city");
    const addressInput = document.getElementById("admin-address");
    const profileAvatar = document.querySelector(
      "#profile-avatar-container img, #profile-avatar-container div"
    );

    if (nameInput) {
      this.originalData.name = nameInput.value;
    }
    if (emailInput) {
      this.originalData.email = emailInput.value;
    }
    if (cityInput) {
      this.originalData.city = cityInput.value;
    }
    if (addressInput) {
      this.originalData.address = addressInput.value;
    }
    if (profileAvatar) {
      if (profileAvatar.tagName === "IMG") {
        this.originalImageSrc = profileAvatar.src;
      } else {
        // Handle avatar div case
        this.originalImageSrc = null;
      }
    }
  }

  setupEventListeners() {
    // Profile image upload
    const profileUpload = document.getElementById("profile-upload");
    if (profileUpload) {
      profileUpload.addEventListener(
        "change",
        this.handleImageSelection.bind(this)
      );
    }

    // Save button
    const saveButton = document.getElementById("save-profile-changes");
    if (saveButton) {
      saveButton.addEventListener("click", this.handleSaveChanges.bind(this));
    }

    // Discard button
    const discardButton = document.getElementById("discard-profile-changes");
    if (discardButton) {
      discardButton.addEventListener(
        "click",
        this.handleDiscardChanges.bind(this)
      );
    }
  }

  handleImageSelection(event) {
    const file = event.target.files[0];
    if (!file) return;

    // Validate file type
    if (!file.type.startsWith("image/")) {
      showErrorToast("Invalid File", "Please select a valid image file.");
      this.resetFileInput();
      return;
    }

    // Validate file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
      showErrorToast(
        "File Too Large",
        "Please select an image smaller than 5MB."
      );
      this.resetFileInput();
      return;
    }

    // Store the file for later upload
    this.currentImageFile = file;

    // Create preview
    const reader = new FileReader();
    reader.onload = (e) => {
      this.updateAvatarPreview(e.target.result);
    };
    reader.readAsDataURL(file);
  }

  updateAvatarPreview(imageUrl) {
    const profileAvatarContainer = document.getElementById(
      "profile-avatar-container"
    );
    if (profileAvatarContainer) {
      profileAvatarContainer.innerHTML = `<img src="${imageUrl}" alt="Profile Preview" class="w-24 h-24 rounded-full object-cover">`;
    }
  }

  resetFileInput() {
    const profileUpload = document.getElementById("profile-upload");
    if (profileUpload) {
      profileUpload.value = "";
    }
    this.currentImageFile = null;
  }

  async handleSaveChanges() {
    const saveButton = document.getElementById("save-profile-changes");
    const saveText = document.getElementById("save-profile-text");
    const saveLoading = document.getElementById("save-profile-loading");

    if (!saveButton || !saveText || !saveLoading) return;

    // Show loading state
    saveButton.disabled = true;
    saveText.classList.add("hidden");
    saveLoading.classList.remove("hidden");

    try {
      // Handle profile image upload first if there's a new image
      if (this.currentImageFile) {
        const imageUploadSuccess = await this.uploadProfileImage();
        if (!imageUploadSuccess) {
          return; // Stop if image upload failed
        }
      }

      // Handle profile data update
      await this.updateProfileData();
    } catch (error) {
      console.error("Error saving changes:", error);
      showErrorToast(
        "Save Error",
        "An unexpected error occurred while saving changes."
      );
    } finally {
      // Restore button state
      saveButton.disabled = false;
      saveText.classList.remove("hidden");
      saveLoading.classList.add("hidden");
    }
  }

  async uploadProfileImage() {
    try {
      const formData = new FormData();
      formData.append("profile_image", this.currentImageFile);

      const response = await fetch(
        "/mediconnect/backend/api/upload-profile-image.php",
        {
          method: "POST",
          body: formData,
        }
      );

      const result = await response.json();

      if (result.success) {
        // Update the original image source
        this.originalImageSrc = result.imageUrl;
        this.updateHeaderAvatar(result.imageUrl);
        this.currentImageFile = null;
        this.resetFileInput();
        return true;
      } else {
        showErrorToast(
          "Upload Failed",
          result.message || "Failed to upload profile image."
        );
        return false;
      }
    } catch (error) {
      console.error("Error uploading image:", error);
      showErrorToast(
        "Upload Error",
        "An error occurred while uploading the image."
      );
      return false;
    }
  }

  async updateProfileData() {
    const nameInput = document.getElementById("admin-name");
    const emailInput = document.getElementById("admin-email");
    const cityInput = document.getElementById("admin-city");
    const addressInput = document.getElementById("admin-address");
    const currentPasswordInput = document.getElementById("current-password");
    const newPasswordInput = document.getElementById("new-password");
    const confirmPasswordInput = document.getElementById("confirm-password");

    if (!nameInput || !emailInput) {
      showErrorToast("System Error", "Profile form elements not found.");
      return;
    }

    const profileData = {
      name: nameInput.value.trim(),
      email: emailInput.value.trim(),
      city: cityInput.value.trim(),
      address: addressInput.value.trim(),
    };

    // Validate required fields
    if (!profileData.name) {
      showErrorToast("Validation Error", "Full name is required.");
      return;
    }

    // Handle password change validation
    const hasPasswordFields =
      currentPasswordInput?.value ||
      newPasswordInput?.value ||
      confirmPasswordInput?.value;

    if (hasPasswordFields) {
      if (
        !currentPasswordInput?.value ||
        !newPasswordInput?.value ||
        !confirmPasswordInput?.value
      ) {
        showErrorToast(
          "Password Error",
          "Please fill in all password fields to change password."
        );
        return;
      }

      if (newPasswordInput.value !== confirmPasswordInput.value) {
        showErrorToast("Password Error", "New passwords do not match.");
        return;
      }

      if (newPasswordInput.value.length < 8) {
        showErrorToast(
          "Password Error",
          "New password must be at least 8 characters long."
        );
        return;
      }

      profileData.currentPassword = currentPasswordInput.value;
      profileData.newPassword = newPasswordInput.value;
    }

    try {
      const response = await fetch(
        "/mediconnect/backend/api/update-profile.php",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(profileData),
        }
      );

      const result = await response.json();

      if (result.success) {
        // Update original data
        this.originalData.name = profileData.name;
        this.originalData.email = profileData.email;
        this.originalData.city = profileData.city;
        this.originalData.address = profileData.address;

        // Clear password fields
        if (currentPasswordInput) currentPasswordInput.value = "";
        if (newPasswordInput) newPasswordInput.value = "";
        if (confirmPasswordInput) confirmPasswordInput.value = "";

        // Update header name if changed
        this.updateHeaderName(profileData.name);

        // Show success message
        const hasPasswordUpdate =
          profileData.currentPassword && profileData.newPassword;
        if (hasPasswordUpdate) {
          showSuccessToast(
            "Profile Updated",
            "Profile information and password updated successfully!"
          );
        } else {
          showSuccessToast(
            "Profile Updated",
            "Profile information updated successfully!"
          );
        }
      } else {
        showErrorToast(
          "Update Failed",
          result.message || "Failed to update profile."
        );
      }
    } catch (error) {
      console.error("Error updating profile:", error);
      showErrorToast(
        "Update Error",
        "An error occurred while updating profile."
      );
    }
  }

  handleDiscardChanges() {
    // Revert name field
    const nameInput = document.getElementById("admin-name");
    if (nameInput && this.originalData.name !== undefined) {
      nameInput.value = this.originalData.name;
    }

    // Email field is read-only, but ensure it shows original value
    const emailInput = document.getElementById("admin-email");
    if (emailInput && this.originalData.email !== undefined) {
      emailInput.value = this.originalData.email;
    }

    // Revert city and address fields
    const cityInput = document.getElementById("admin-city");
    if (cityInput && this.originalData.city !== undefined) {
      cityInput.value = this.originalData.city;
    }
    const addressInput = document.getElementById("admin-address");
    if (addressInput && this.originalData.address !== undefined) {
      addressInput.value = this.originalData.address;
    }

    // Clear password fields
    const currentPasswordInput = document.getElementById("current-password");
    const newPasswordInput = document.getElementById("new-password");
    const confirmPasswordInput = document.getElementById("confirm-password");

    if (currentPasswordInput) currentPasswordInput.value = "";
    if (newPasswordInput) newPasswordInput.value = "";
    if (confirmPasswordInput) confirmPasswordInput.value = "";

    // Revert profile image
    this.revertProfileImage();

    // Clear file input and stored file
    this.resetFileInput();

    showSuccessToast(
      "Changes Discarded",
      "All changes have been reverted to original values."
    );
  }

  revertProfileImage() {
    const profileAvatarContainer = document.getElementById(
      "profile-avatar-container"
    );
    if (!profileAvatarContainer) return;

    if (this.originalImageSrc) {
      // Revert to original image
      profileAvatarContainer.innerHTML = `<img src="${this.originalImageSrc}" alt="Profile" class="w-24 h-24 rounded-full object-cover">`;
    } else {
      // Revert to original avatar div (if it was a generated avatar)
      // This would need to be reconstructed based on the original user data
      // For now, we'll reload the page to get the original state
      location.reload();
    }
  }

  updateHeaderAvatar(imageUrl) {
    const headerAvatar = document.querySelector(
      ".dropdown button img, .dropdown button div"
    );
    if (headerAvatar) {
      if (headerAvatar.tagName === "IMG") {
        headerAvatar.src = imageUrl;
      } else {
        // Replace div with img
        const userName = headerAvatar.textContent || "User";
        headerAvatar.outerHTML = `<img src="${imageUrl}" alt="${userName}" class="w-8 h-8 rounded-full object-cover">`;
      }
    }
  }

  updateHeaderName(name) {
    const headerName = document.querySelector(".dropdown button span");
    if (headerName) {
      headerName.textContent = name;
    }
  }
}

// Initialize profile management
let profileManager = null;

export function initProfileManagement() {
  if (!profileManager) {
    profileManager = new ProfileManager();
  }
  profileManager.init();
}
