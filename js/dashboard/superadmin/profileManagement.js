export function initProfileManagement() {
  setupProfileImageUpload();
  setupProfileFormSubmission();
}

function setupProfileImageUpload() {
  const profileUpload = document.getElementById("profile-upload");
  const profileAvatarContainer = document.getElementById(
    "profile-avatar-container"
  );

  if (!profileUpload || !profileAvatarContainer) return;

  profileUpload.addEventListener("change", handleImageUpload);

  async function handleImageUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    // Validate file type
    if (!file.type.startsWith("image/")) {
      showToast("Invalid File", "Please select a valid image file.", "error");
      return;
    }

    // Validate file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
      showToast(
        "File Too Large",
        "Please select an image smaller than 5MB.",
        "error"
      );
      return;
    }

    try {
      // Create preview
      const reader = new FileReader();
      reader.onload = function (e) {
        updateAvatarPreview(e.target.result);
      };
      reader.readAsDataURL(file);

      // Upload image
      const formData = new FormData();
      formData.append("profile_image", file);

      const response = await fetch(
        "/mediconnect/backend/api/upload-profile-image.php",
        {
          method: "POST",
          body: formData,
        }
      );

      const result = await response.json();

      if (result.success) {
        showToast("Success", "Profile image updated successfully!", "success");
        // Update header avatar as well
        updateHeaderAvatar(result.imageUrl);
      } else {
        showToast(
          "Upload Failed",
          result.message || "Failed to upload image",
          "error"
        );
        // Revert preview
        revertAvatarPreview();
      }
    } catch (error) {
      console.error("Error uploading image:", error);
      showToast(
        "Upload Error",
        "An error occurred while uploading the image.",
        "error"
      );
      revertAvatarPreview();
    }
  }

  function updateAvatarPreview(imageUrl) {
    profileAvatarContainer.innerHTML = `<img src="${imageUrl}" alt="Profile" class="w-24 h-24 rounded-full object-cover">`;
  }

  function updateHeaderAvatar(imageUrl) {
    // Update header avatar if it exists
    const headerAvatar = document.querySelector(
      ".dropdown button > div, .dropdown button > img"
    );
    if (headerAvatar) {
      const userName = headerAvatar.getAttribute("alt") || "User";
      headerAvatar.outerHTML = `<img src="${imageUrl}" alt="${userName}" class="w-8 h-8 rounded-full object-cover">`;
    }
  }

  function revertAvatarPreview() {
    // This would need to revert to the original avatar
    // For now, just reload the page
    location.reload();
  }
}

function setupProfileFormSubmission() {
  const profileForm = document.querySelector('[data-section="my-profile"]');
  const saveButton = profileForm?.querySelector('button[type="button"]');

  if (!saveButton) return;

  saveButton.addEventListener("click", handleProfileSave);

  async function handleProfileSave() {
    const nameInput = document.getElementById("admin-name");
    const emailInput = document.getElementById("admin-email");
    const currentPasswordInput = document.getElementById("current-password");
    const newPasswordInput = document.getElementById("new-password");
    const confirmPasswordInput = document.getElementById("confirm-password");

    if (!nameInput || !emailInput) return;

    const profileData = {
      name: nameInput.value.trim(),
      email: emailInput.value.trim(),
    };

    // Validate inputs
    if (!profileData.name || !profileData.email) {
      showToast(
        "Validation Error",
        "Please fill in all required fields.",
        "error"
      );
      return;
    }

    // If password fields are filled, validate them
    if (
      currentPasswordInput.value ||
      newPasswordInput.value ||
      confirmPasswordInput.value
    ) {
      if (
        !currentPasswordInput.value ||
        !newPasswordInput.value ||
        !confirmPasswordInput.value
      ) {
        showToast(
          "Password Error",
          "Please fill in all password fields to change password.",
          "error"
        );
        return;
      }

      if (newPasswordInput.value !== confirmPasswordInput.value) {
        showToast("Password Error", "New passwords do not match.", "error");
        return;
      }

      if (newPasswordInput.value.length < 8) {
        showToast(
          "Password Error",
          "New password must be at least 8 characters long.",
          "error"
        );
        return;
      }

      profileData.currentPassword = currentPasswordInput.value;
      profileData.newPassword = newPasswordInput.value;
    }

    try {
      // Show loading state
      const originalText = saveButton.textContent;
      saveButton.textContent = "Saving...";
      saveButton.disabled = true;

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
        showToast("Success", "Profile updated successfully!", "success");

        // Clear password fields
        if (currentPasswordInput) currentPasswordInput.value = "";
        if (newPasswordInput) newPasswordInput.value = "";
        if (confirmPasswordInput) confirmPasswordInput.value = "";

        // Update header name if changed
        const headerName = document.querySelector(".dropdown button span");
        if (headerName && profileData.name) {
          headerName.textContent = profileData.name;
        }
      } else {
        showToast(
          "Update Failed",
          result.message || "Failed to update profile",
          "error"
        );
      }
    } catch (error) {
      console.error("Error updating profile:", error);
      showToast(
        "Update Error",
        "An error occurred while updating profile.",
        "error"
      );
    } finally {
      // Restore button
      saveButton.textContent = originalText;
      saveButton.disabled = false;
    }
  }
}

function showToast(title, message, type) {
  // Use the existing toast system
  if (typeof window.showToast === "function") {
    window.showToast(title, message, type);
  } else {
    // Fallback alert
    alert(`${title}: ${message}`);
  }
}
