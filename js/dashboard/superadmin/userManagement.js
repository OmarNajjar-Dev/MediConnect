import { generateInitials, validateEmail } from "../../utils/userUtils.js";
import { showSuccessToast, showErrorToast } from "../../common/toast.js";
import { PasswordStrengthValidator } from "../../common/passwordStrength.js";

class UserManagement {
  constructor() {
    this.users = [];
    this.filteredUsers = [];
    this.roles = [];
    this.hospitals = [];
    this.specialties = [];
    this.currentEditingUser = null;
    this.passwordValidator = null; // Will be initialized when modal opens
    this.init();
  }

  async init() {
    await this.loadInitialData();
    this.setupEventListeners();
    this.setupModal();
  }

  async loadInitialData() {
    try {
      // Load all required data in parallel
      await Promise.all([
        this.loadUsers(),
        this.loadRoles(),
        this.loadHospitals(),
        this.loadSpecialties(),
      ]);
    } catch (error) {
      console.error("Failed to load initial data:", error);
      showErrorToast("Error", "Failed to load data");
    }
  }

  async loadUsers() {
    try {
      const response = await fetch("/mediconnect/backend/api/get-users.php");
      const data = await response.json();

      if (data.success) {
        this.users = data.users;
        this.filteredUsers = [...this.users];
        this.renderUsers();
        this.updateUserCount();
      } else {
        throw new Error(data.message || "Failed to load users");
      }
    } catch (error) {
      console.error("Error loading users:", error);
      showErrorToast("Error", "Failed to load users");
    }
  }

  async loadRoles() {
    try {
      const response = await fetch("/mediconnect/backend/api/get-roles.php");
      const roles = await response.json();
      this.roles = roles;
      this.populateRoleDropdowns();
    } catch (error) {
      console.error("Error loading roles:", error);
    }
  }

  async loadHospitals() {
    try {
      const response = await fetch(
        "/mediconnect/backend/api/get-hospitals.php"
      );
      const hospitals = await response.json();
      this.hospitals = hospitals;
      this.populateHospitalDropdowns();
    } catch (error) {
      console.error("Error loading hospitals:", error);
    }
  }

  async loadSpecialties() {
    try {
      const response = await fetch(
        "/mediconnect/backend/api/get-specialties.php"
      );
      const data = await response.json();

      if (data.success) {
        this.specialties = data.specialties;
        this.populateSpecialtyDropdowns();
      }
    } catch (error) {
      console.error("Error loading specialties:", error);
    }
  }

  populateRoleDropdowns() {
    const roleSelect = document.getElementById("user-role");
    const roleFilter = document.getElementById("role-filter");

    if (roleSelect) {
      roleSelect.innerHTML = '<option value="">Select a role</option>';
      this.roles.forEach((role) => {
        const option = document.createElement("option");
        option.value = role;
        option.textContent = role;
        roleSelect.appendChild(option);
      });
    }

    if (roleFilter) {
      roleFilter.innerHTML = '<option value="">All Roles</option>';
      this.roles.forEach((role) => {
        const option = document.createElement("option");
        option.value = role;
        option.textContent = role;
        roleFilter.appendChild(option);
      });
    }
  }

  populateHospitalDropdowns() {
    const hospitalSelect = document.getElementById("user-hospital");

    if (hospitalSelect) {
      hospitalSelect.innerHTML = '<option value="">Select a hospital</option>';
      this.hospitals.forEach((hospital) => {
        const option = document.createElement("option");
        option.value = hospital.hospital_id;
        option.textContent = hospital.name;
        hospitalSelect.appendChild(option);
      });
    }
  }

  populateSpecialtyDropdowns() {
    const specialtySelect = document.getElementById("user-specialty");

    if (specialtySelect) {
      specialtySelect.innerHTML =
        '<option value="">Select a specialty</option>';
      this.specialties.forEach((specialty) => {
        const option = document.createElement("option");
        option.value = specialty.specialty_id;
        option.textContent = specialty.label_for_doctor;
        specialtySelect.appendChild(option);
      });
    }
  }

  setupEventListeners() {
    // Search functionality
    const searchInput = document.getElementById("user-search");
    if (searchInput) {
      searchInput.addEventListener("input", (e) => {
        this.filterUsers(
          e.target.value,
          document.getElementById("role-filter").value
        );
      });
    }

    // Role filter
    const roleFilter = document.getElementById("role-filter");
    if (roleFilter) {
      roleFilter.addEventListener("change", (e) => {
        this.filterUsers(
          document.getElementById("user-search").value,
          e.target.value
        );
      });
    }

    // Role change handler for conditional fields
    const roleSelect = document.getElementById("user-role");
    if (roleSelect) {
      roleSelect.addEventListener("change", (e) => {
        this.handleRoleChange(e.target.value);
      });
    }

    // Generate password button
    const generatePasswordBtn = document.getElementById("generate-password");
    if (generatePasswordBtn) {
      generatePasswordBtn.addEventListener("click", () => {
        if (this.passwordValidator) {
          const generatedPassword =
            this.passwordValidator.generateSecurePassword();
          document.getElementById("user-password").value = generatedPassword;
          document.getElementById("user-confirm-password").value =
            generatedPassword;
          this.passwordValidator.validatePassword(generatedPassword);
          this.passwordValidator.checkPasswordMatch();
        }
      });
    }

    // Form submission
    const userForm = document.getElementById("user-form");
    if (userForm) {
      userForm.addEventListener("submit", (e) => {
        e.preventDefault();
        this.handleUserSubmit();
      });
    }
  }

  setupModal() {
    // Modal triggers
    const addUserBtn = document.querySelector('[data-modal-trigger="user"]');
    if (addUserBtn) {
      addUserBtn.addEventListener("click", () => {
        this.openUserModal();
      });
    }

    // Modal close buttons
    const closeButtons = document.querySelectorAll('[data-modal-close="user"]');
    closeButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        this.closeUserModal();
      });
    });

    // Close modal on overlay click
    const overlay = document.querySelector(
      '[data-dialog="overlay"][data-modal-type="user"]'
    );
    if (overlay) {
      overlay.addEventListener("click", () => {
        this.closeUserModal();
      });
    }
  }

  openUserModal(user = null) {
    this.currentEditingUser = user;
    const modal = document.querySelector(
      '[data-dialog="modal"][data-modal-type="user"]'
    );
    const overlay = document.querySelector(
      '[data-dialog="overlay"][data-modal-type="user"]'
    );
    const title = document.getElementById("user-modal-title");
    const submitText = document.getElementById("user-submit-text");
    const passwordFields = document.getElementById("password-fields");
    const editPasswordNote = document.getElementById("edit-password-note");

    if (user) {
      // Edit mode
      title.textContent = "Edit User";
      submitText.textContent = "Update User";
      this.populateUserForm(user);

      // Hide password fields and show edit note
      passwordFields.classList.add("hidden");
      editPasswordNote.classList.remove("hidden");

      // Clean up password validator
      this.passwordValidator = null;
    } else {
      // Add mode
      title.textContent = "Add New User";
      submitText.textContent = "Add User";
      this.resetUserForm();

      // Show password fields and hide edit note
      passwordFields.classList.remove("hidden");
      editPasswordNote.classList.add("hidden");

      // Initialize password validator for add mode with correct IDs
      this.passwordValidator = new PasswordStrengthValidator(
        "user-password", // password input ID
        null, // no strength bar in admin modal
        "password-strength", // strength text ID
        "user-confirm-password", // confirm password input ID
        "password-match" // password match indicator ID
      );
    }

    overlay.classList.remove("hidden");
    overlay.classList.add("fixed");
    modal.classList.remove("hidden");
    modal.classList.add("fixed");
  }

  closeUserModal() {
    const modal = document.querySelector(
      '[data-dialog="modal"][data-modal-type="user"]'
    );
    const overlay = document.querySelector(
      '[data-dialog="overlay"][data-modal-type="user"]'
    );

    overlay.classList.add("hidden");
    overlay.classList.remove("fixed");
    modal.classList.add("hidden");
    modal.classList.remove("fixed");

    this.currentEditingUser = null;
    this.resetUserForm();
  }

  populateUserForm(user) {
    document.getElementById(
      "user-fullname"
    ).value = `${user.first_name} ${user.last_name}`;
    document.getElementById("user-email").value = user.email;
    document.getElementById("user-role").value = user.roles[0] || "";
    document.getElementById("user-city").value = user.city || "";
    document.getElementById("user-address").value = user.address_line || "";

    // Handle role-specific fields
    this.handleRoleChange(user.roles[0] || "");

    // Set conditional field values
    if (user.name) {
      const hospitalSelect = document.getElementById("user-hospital");
      const hospital = this.hospitals.find((h) => h.name === user.name);
      if (hospital) {
        hospitalSelect.value = hospital.hospital_id;
      }
    }

    if (user.specialty) {
      const specialtySelect = document.getElementById("user-specialty");
      const specialty = this.specialties.find(
        (s) => s.label_for_doctor === user.specialty
      );
      if (specialty) {
        specialtySelect.value = specialty.specialty_id;
      }
    }

    if (user.ambulance_team_name) {
      document.getElementById("user-team").value = user.ambulance_team_name;
    }
  }

  resetUserForm() {
    document.getElementById("user-form").reset();
    document.getElementById("conditional-fields").classList.add("hidden");
    document.getElementById("hospital-field").classList.add("hidden");
    document.getElementById("specialty-field").classList.add("hidden");
    document.getElementById("team-field").classList.add("hidden");

    // Reset password fields using centralized validator
    if (this.passwordValidator) {
      this.passwordValidator.reset();
    }
  }

  handleRoleChange(role) {
    const conditionalFields = document.getElementById("conditional-fields");
    const hospitalField = document.getElementById("hospital-field");
    const specialtyField = document.getElementById("specialty-field");
    const teamField = document.getElementById("team-field");

    // Hide all conditional fields first
    conditionalFields.classList.add("hidden");
    hospitalField.classList.add("hidden");
    specialtyField.classList.add("hidden");
    teamField.classList.add("hidden");

    // Show relevant fields based on role
    if (role === "Doctor") {
      conditionalFields.classList.remove("hidden");
      hospitalField.classList.remove("hidden");
      specialtyField.classList.remove("hidden");

      // Make hospital and specialty required
      document.getElementById("user-hospital").required = true;
      document.getElementById("user-specialty").required = true;
      document.getElementById("user-team").required = false;
    } else if (role === "Hospital Admin") {
      conditionalFields.classList.remove("hidden");
      hospitalField.classList.remove("hidden");

      // Make hospital required
      document.getElementById("user-hospital").required = true;
      document.getElementById("user-specialty").required = false;
      document.getElementById("user-team").required = false;
    } else if (role === "Ambulance Team") {
      conditionalFields.classList.remove("hidden");
      teamField.classList.remove("hidden");

      // Make team name optional
      document.getElementById("user-hospital").required = false;
      document.getElementById("user-specialty").required = false;
      document.getElementById("user-team").required = false;
    } else {
      // For other roles, no additional fields required
      document.getElementById("user-hospital").required = false;
      document.getElementById("user-specialty").required = false;
      document.getElementById("user-team").required = false;
    }
  }

  async handleUserSubmit() {
    const submitBtn = document.getElementById("user-submit-btn");
    const submitText = document.getElementById("user-submit-text");
    const submitLoading = document.getElementById("user-submit-loading");

    // Show loading state
    submitBtn.disabled = true;
    submitText.classList.add("hidden");
    submitLoading.classList.remove("hidden");

    try {
      const formData = new FormData(document.getElementById("user-form"));
      const userData = Object.fromEntries(formData.entries());

      // Validate required fields
      if (!userData.fullName || !userData.email || !userData.role) {
        throw new Error("Please fill in all required fields");
      }

      // Validate email format
      if (!validateEmail(userData.email)) {
        throw new Error("Please enter a valid email address");
      }

      // Password validation for new users
      if (!this.currentEditingUser) {
        // Adding new user - password is required
        if (!userData.password || !userData.confirmPassword) {
          throw new Error("Please fill in both password fields");
        }

        if (!this.passwordValidator.doPasswordsMatch()) {
          throw new Error("Passwords do not match");
        }

        if (!this.passwordValidator.isPasswordValid(userData.password)) {
          throw new Error("Password does not meet minimum requirements");
        }
      } else {
        // Editing existing user - remove password fields from data
        delete userData.password;
        delete userData.confirmPassword;
      }

      // Validate role-specific requirements
      if (
        userData.role === "Doctor" &&
        (!userData.hospitalId || !userData.specialtyId)
      ) {
        throw new Error("Hospital and specialty are required for doctors");
      }

      const url = this.currentEditingUser
        ? "/mediconnect/backend/api/update-user.php"
        : "/mediconnect/backend/api/create-user.php";

      const method = this.currentEditingUser ? "PUT" : "POST";

      if (this.currentEditingUser) {
        userData.userId = this.currentEditingUser.user_id;
      }

      const response = await fetch(url, {
        method: method,
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(userData),
      });

      const result = await response.json();

      if (result.success) {
        showSuccessToast("Success", result.message);
        this.closeUserModal();
        await this.loadUsers();
      } else {
        throw new Error(result.message || "Operation failed");
      }
    } catch (error) {
      console.error("Error submitting user:", error);
      showErrorToast("Error", error.message);
    } finally {
      // Reset loading state
      submitBtn.disabled = false;
      submitText.classList.remove("hidden");
      submitLoading.classList.add("hidden");
    }
  }

  async deleteUser(userId) {
    if (
      !confirm(
        "Are you sure you want to delete this user? This action cannot be undone."
      )
    ) {
      return;
    }

    try {
      const response = await fetch("/mediconnect/backend/api/delete-user.php", {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ userId }),
      });

      const result = await response.json();

      if (result.success) {
        showSuccessToast("Success", result.message);
        await this.loadUsers();
      } else {
        throw new Error(result.message || "Failed to delete user");
      }
    } catch (error) {
      console.error("Error deleting user:", error);
      showErrorToast("Error", error.message);
    }
  }

  filterUsers(searchTerm, roleFilter) {
    this.filteredUsers = this.users.filter((user) => {
      const matchesSearch =
        !searchTerm ||
        user.first_name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        user.last_name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        user.email.toLowerCase().includes(searchTerm.toLowerCase());

      const matchesRole = !roleFilter || user.roles.includes(roleFilter);

      return matchesSearch && matchesRole;
    });

    this.renderUsers();
    this.updateUserCount();
  }

  renderUsers() {
    const tbody = document.getElementById("users-table-body");
    if (!tbody) return;

    if (this.filteredUsers.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="7" class="p-8 text-center text-gray-500">
            No users found
          </td>
        </tr>
      `;
      return;
    }

    tbody.innerHTML = this.filteredUsers
      .map((user) => this.createUserRow(user))
      .join("");

    // Re-initialize Lucide icons
    if (window.lucide) {
      lucide.createIcons();
    }
  }

  createUserRow(user) {
    const fullName = `${user.first_name} ${user.last_name}`;
    const roleColors = {
      Doctor: "bg-green-100 text-green-800",
      "Hospital Admin": "bg-blue-100 text-blue-800",
      Patient: "bg-purple-100 text-purple-800",
      Staff: "bg-yellow-100 text-yellow-800",
      "Ambulance Team": "bg-red-100 text-red-800",
      "Super Admin": "bg-gray-100 text-gray-800",
    };

    const primaryRole = user.roles[0] || "Unknown";
    const roleColor = roleColors[primaryRole] || "bg-gray-100 text-gray-800";

    const details = user.specialty || user.ambulance_team_name || "-";

    return `
      <tr class="border-b border-solid border-card-soft hover:bg-gray-50">
        <td class="p-4 font-medium">${fullName}</td>
        <td class="p-4 text-sm text-gray-600">${user.email}</td>
        <td class="p-4">
          <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ${roleColor}">
            ${primaryRole}
          </div>
        </td>
        <td class="p-4 hidden sm:table-cell text-sm">${user.name || "-"}</td>
        <td class="p-4 hidden lg:table-cell text-sm">${details}</td>
        <td class="p-4">
          <div class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-primary hover:bg-medical-400 text-white">
            active
          </div>
        </td>
        <td class="p-4 text-right">
          <div class="flex gap-1 justify-end">
            <button onclick="userManagement.openUserModal(${JSON.stringify(
              user
            ).replace(/"/g, "&quot;")})" 
                    class="rounded-md h-8 w-8 p-0 hover:bg-accent pointer bg-transparent border-none hover:text-medical-500">
              <i data-lucide="square-pen" class="h-4 w-4"></i>
            </button>
            <button onclick="userManagement.deleteUser(${user.user_id})" 
                    class="rounded-md h-8 w-8 p-0 text-red-600 hover:text-red-800 hover:bg-red-50 pointer bg-transparent border-none">
              <i data-lucide="trash2" class="h-4 w-4"></i>
            </button>
          </div>
        </td>
      </tr>
    `;
  }

  updateUserCount() {
    const countElement = document.getElementById("users-count");
    if (countElement) {
      countElement.textContent = `All Users (${this.filteredUsers.length})`;
    }
  }
}

// Initialize and export
const userManagement = new UserManagement();
window.userManagement = userManagement;

export default userManagement;
