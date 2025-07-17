import { generateInitials } from "../../utils/userUtils.js";
import { showToast } from "../../common/toast.js";

class ProfileManagement {
  constructor() {
    this.currentUser = null;
    this.init();
  }

  async init() {
    await this.loadUserProfile();
    this.setupEventListeners();
    this.setupAvatar();
  }

  async loadUserProfile() {
    try {
      // Get current user info from session context
      // This would typically be passed from the server-side PHP
      const userName =
        document.querySelector(".dropdown .text-sm.font-medium")?.textContent ||
        "User";
      const userEmail =
        document.querySelector(".dropdown .text-xs")?.textContent ||
        "user@example.com";

      this.currentUser = {
        name: userName,
        email: userEmail,
        // Split name for avatar initials
        firstName: userName.split(" ")[0] || "U",
        lastName: userName.split(" ")[1] || "N",
      };

      this.populateProfileForm();
    } catch (error) {
      console.error("Error loading user profile:", error);
      showToast("Failed to load profile", "error");
    }
  }

  setupEventListeners() {
    // Profile image upload
    const profileUpload = document.getElementById("profile-upload");
    if (profileUpload) {
      profileUpload.addEventListener("change", (e) => {
        this.handleImageUpload(e);
      });
    }

    // Profile form submission (if needed)
    const profileForm = document.querySelector(
      '[data-section="my-profile"] form'
    );
    if (profileForm) {
      profileForm.addEventListener("submit", (e) => {
        e.preventDefault();
        this.handleProfileUpdate();
      });
    }

    // Save changes button
    const saveButton = document.querySelector(
      '[data-section="my-profile"] button[type="submit"]'
    );
    if (saveButton) {
      saveButton.addEventListener("click", (e) => {
        e.preventDefault();
        this.handleProfileUpdate();
      });
    }
  }

  setupAvatar() {
    this.updateAvatarDisplay();
  }

  updateAvatarDisplay(imageUrl = null) {
    const avatarElements = document.querySelectorAll(".rounded-full");

    avatarElements.forEach((element) => {
      if (
        element.classList.contains("w-8") ||
        element.classList.contains("w-24")
      ) {
        if (imageUrl) {
          // Replace with actual image
          element.innerHTML = `<img src="${imageUrl}" alt="Profile" class="w-full h-full rounded-full object-cover">`;
        } else {
          // Show initials
          const initials = generateInitials(
            this.currentUser?.firstName || "U",
            this.currentUser?.lastName || "N"
          );
          element.innerHTML = `<span class="flex h-full w-full items-center justify-center text-medical-700 font-medium">${initials}</span>`;
        }
      }
    });
  }

  populateProfileForm() {
    if (!this.currentUser) return;

    // Populate form fields
    const nameInput = document.getElementById("admin-name");
    const emailInput = document.getElementById("admin-email");

    if (nameInput) {
      nameInput.value = this.currentUser.name;
    }

    if (emailInput) {
      emailInput.value = this.currentUser.email;
    }
  }

  async handleImageUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    // Validate file type
    if (!file.type.startsWith("image/")) {
      showToast("Please select a valid image file", "error");
      return;
    }

    // Validate file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
      showToast("Image size must be less than 5MB", "error");
      return;
    }

    try {
      // Create preview
      const reader = new FileReader();
      reader.onload = (e) => {
        this.updateAvatarDisplay(e.target.result);
      };
      reader.readAsDataURL(file);

      // Here you would typically upload to server
      // For now, we'll just show the preview
      showToast("Profile image updated successfully", "success");
    } catch (error) {
      console.error("Error uploading image:", error);
      showToast("Failed to upload image", "error");
    }
  }

  async handleProfileUpdate() {
    try {
      const nameInput = document.getElementById("admin-name");
      const emailInput = document.getElementById("admin-email");
      const currentPassword = document.getElementById("current-password");
      const newPassword = document.getElementById("new-password");
      const confirmPassword = document.getElementById("confirm-password");

      const updateData = {
        name: nameInput?.value || "",
        email: emailInput?.value || "",
      };

      // Validate email
      if (updateData.email && !this.validateEmail(updateData.email)) {
        showToast("Please enter a valid email address", "error");
        return;
      }

      // Handle password change if provided
      if (newPassword?.value) {
        if (!currentPassword?.value) {
          showToast("Current password is required to change password", "error");
          return;
        }

        if (newPassword.value !== confirmPassword?.value) {
          showToast("New passwords do not match", "error");
          return;
        }

        if (newPassword.value.length < 8) {
          showToast("New password must be at least 8 characters long", "error");
          return;
        }

        updateData.currentPassword = currentPassword.value;
        updateData.newPassword = newPassword.value;
      }

      // Here you would typically send the update to the server
      // For now, we'll just show success message
      showToast("Profile updated successfully", "success");

      // Clear password fields
      if (currentPassword) currentPassword.value = "";
      if (newPassword) newPassword.value = "";
      if (confirmPassword) confirmPassword.value = "";

      // Update current user data
      this.currentUser.name = updateData.name;
      this.currentUser.email = updateData.email;

      // Update avatar if name changed
      const nameParts = updateData.name.split(" ");
      this.currentUser.firstName = nameParts[0] || "U";
      this.currentUser.lastName = nameParts[1] || "N";
      this.updateAvatarDisplay();
    } catch (error) {
      console.error("Error updating profile:", error);
      showToast("Failed to update profile", "error");
    }
  }

  validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
}

// Initialize and export
const profileManagement = new ProfileManagement();
window.profileManagement = profileManagement;

export default profileManagement;
