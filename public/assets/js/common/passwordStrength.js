/**
 * Centralized Password Strength Utility
 * Provides reusable password strength validation and UI feedback across the platform
 *
 * Usage:
 * import { PasswordStrengthValidator } from '../utils/passwordStrength.js';
 * const validator = new PasswordStrengthValidator('password-input-id', 'strength-bar-id', 'strength-text-id');
 */

export class PasswordStrengthValidator {
  /**
   * Initialize password strength validator
   * @param {string} passwordInputId - ID of password input field
   * @param {string} strengthBarId - ID of strength bar element (optional)
   * @param {string} strengthTextId - ID of strength text element (optional)
   * @param {string} confirmPasswordId - ID of confirm password field (optional)
   * @param {string} matchIndicatorId - ID of password match indicator (optional)
   * @param {Object} requirementIds - Object with requirement element IDs (optional)
   */
  constructor(
    passwordInputId = "password",
    strengthBarId = "password-strength-bar",
    strengthTextId = "password-strength-text",
    confirmPasswordId = "confirm-password",
    matchIndicatorId = "password-match-indicator",
    requirementIds = null
  ) {
    this.passwordInput = document.getElementById(passwordInputId);
    this.confirmPasswordInput = document.getElementById(confirmPasswordId);
    this.strengthBar = document.getElementById(strengthBarId);
    this.strengthText = document.getElementById(strengthTextId);
    this.matchIndicator = document.getElementById(matchIndicatorId);

    // Default requirement IDs if not provided
    this.requirements = requirementIds || {
      length: document.getElementById("req-length"),
      uppercase: document.getElementById("req-uppercase"),
      lowercase: document.getElementById("req-lowercase"),
      number: document.getElementById("req-number"),
      special: document.getElementById("req-special"),
    };

    this.init();
  }

  init() {
    if (this.passwordInput) {
      this.passwordInput.addEventListener("input", (e) => {
        this.validatePassword(e.target.value);
        if (this.confirmPasswordInput) {
          this.checkPasswordMatch();
        }
      });

      // Initial state
      this.validatePassword("");
    }

    if (this.confirmPasswordInput) {
      this.confirmPasswordInput.addEventListener("input", (e) => {
        this.checkPasswordMatch();
      });
    }
  }

  /**
   * Perform password strength checks
   * @param {string} password - Password to validate
   * @returns {Object} Object with boolean values for each requirement
   */
  performChecks(password) {
    return {
      length: password.length >= 8,
      uppercase: /[A-Z]/.test(password),
      lowercase: /[a-z]/.test(password),
      number: /\d/.test(password),
      special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password),
    };
  }

  /**
   * Calculate password strength based on checks
   * @param {Object} checks - Object with boolean values for each requirement
   * @returns {Object} Strength object with level, percentage, and label
   */
  calculateStrength(checks) {
    const totalChecks = Object.values(checks).filter(Boolean).length;

    if (totalChecks === 0)
      return { level: "none", percentage: 0, label: "Enter password" };
    if (totalChecks === 1)
      return { level: "weak", percentage: 20, label: "Weak" };
    if (totalChecks === 2)
      return { level: "weak", percentage: 40, label: "Weak" };
    if (totalChecks === 3)
      return { level: "fair", percentage: 60, label: "Fair" };
    if (totalChecks === 4)
      return { level: "good", percentage: 80, label: "Good" };
    if (totalChecks === 5)
      return { level: "strong", percentage: 100, label: "Strong" };
  }

  /**
   * Update UI elements with password strength feedback
   * @param {Object} checks - Object with boolean values for each requirement
   * @param {Object} strength - Strength object with level, percentage, and label
   */
  updateUI(checks, strength) {
    // Update strength bar
    if (this.strengthBar) {
      this.strengthBar.style.width = `${strength.percentage}%`;
      this.strengthBar.className = `h-2 rounded-full transition-all duration-300 ${this.getStrengthColor(
        strength.level
      )}`;
    }

    // Update strength text
    if (this.strengthText) {
      this.strengthText.textContent = strength.label;
      this.strengthText.className = `text-xs font-medium ${this.getStrengthTextColor(
        strength.level
      )}`;
    }

    // Update requirement indicators
    Object.entries(checks).forEach(([requirement, isMet]) => {
      const element = this.requirements[requirement];
      if (element) {
        if (isMet) {
          element.textContent = "✓";
          element.className = "text-green-500";
        } else {
          element.textContent = "•";
          element.className = "text-gray-400";
        }
      }
    });
  }

  /**
   * Get CSS class for strength bar color
   * @param {string} level - Strength level
   * @returns {string} CSS class name
   */
  getStrengthColor(level) {
    switch (level) {
      case "none":
        return "bg-gray-300";
      case "weak":
        return "bg-red-500";
      case "fair":
        return "bg-yellow-500";
      case "good":
        return "bg-blue-500";
      case "strong":
        return "bg-green-500";
      default:
        return "bg-gray-300";
    }
  }

  /**
   * Get CSS class for strength text color
   * @param {string} level - Strength level
   * @returns {string} CSS class name
   */
  getStrengthTextColor(level) {
    switch (level) {
      case "none":
        return "text-gray-500";
      case "weak":
        return "text-red-600";
      case "fair":
        return "text-yellow-600";
      case "good":
        return "text-blue-600";
      case "strong":
        return "text-green-600";
      default:
        return "text-gray-500";
    }
  }

  /**
   * Validate password and update UI
   * @param {string} password - Password to validate
   */
  validatePassword(password) {
    const checks = this.performChecks(password);
    const strength = this.calculateStrength(checks);
    this.updateUI(checks, strength);
  }

  /**
   * Check if passwords match and update UI
   */
  checkPasswordMatch() {
    if (!this.passwordInput || !this.confirmPasswordInput) return;

    const password = this.passwordInput.value;
    const confirmPassword = this.confirmPasswordInput.value;

    // Add visual feedback to confirm password field
    if (confirmPassword === "") {
      this.confirmPasswordInput.classList.remove(
        "border-green-500",
        "border-red-500"
      );
      this.confirmPasswordInput.classList.add("border-input");

      // Clear match indicator
      if (this.matchIndicator) {
        this.matchIndicator.textContent = "";
        this.matchIndicator.className = "mt-1 text-xs text-gray-500";
      }
    } else if (password === confirmPassword) {
      this.confirmPasswordInput.classList.remove(
        "border-red-500",
        "border-input"
      );
      this.confirmPasswordInput.classList.add("border-green-500");

      // Show match indicator
      if (this.matchIndicator) {
        this.matchIndicator.textContent = "✓ Passwords match";
        this.matchIndicator.className = "mt-1 text-xs text-green-600";
      }
    } else {
      this.confirmPasswordInput.classList.remove(
        "border-green-500",
        "border-input"
      );
      this.confirmPasswordInput.classList.add("border-red-500");

      // Show mismatch indicator
      if (this.matchIndicator) {
        this.matchIndicator.textContent = "✗ Passwords do not match";
        this.matchIndicator.className = "mt-1 text-xs text-red-600";
      }
    }
  }

  /**
   * Check if password meets minimum requirements
   * @param {string} password - Password to check
   * @returns {boolean} True if password meets all requirements
   */
  isPasswordValid(password) {
    const checks = this.performChecks(password);
    // Only check the requirements mentioned in the error message:
    // - At least 8 characters long
    // - At least one number
    // - At least one special character
    return checks.length && checks.number && checks.special;
  }

  /**
   * Get current password strength
   * @param {string} password - Password to analyze
   * @returns {Object} Strength object with level, percentage, and label
   */
  getPasswordStrength(password) {
    const checks = this.performChecks(password);
    return this.calculateStrength(checks);
  }

  /**
   * Check if passwords match
   * @returns {boolean} True if passwords match
   */
  doPasswordsMatch() {
    if (!this.passwordInput || !this.confirmPasswordInput) return false;
    return this.passwordInput.value === this.confirmPasswordInput.value;
  }

  /**
   * Generate a secure password
   * @param {number} length - Length of password (default: 12)
   * @returns {string} Generated password
   */
  generateSecurePassword(length = 12) {
    const uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const lowercase = "abcdefghijklmnopqrstuvwxyz";
    const numbers = "0123456789";
    const symbols = "!@#$%^&*";

    let password = "";

    // Ensure at least one character from each set
    password += uppercase[Math.floor(Math.random() * uppercase.length)];
    password += lowercase[Math.floor(Math.random() * lowercase.length)];
    password += numbers[Math.floor(Math.random() * numbers.length)];
    password += symbols[Math.floor(Math.random() * symbols.length)];

    // Fill the rest with random characters
    const allChars = uppercase + lowercase + numbers + symbols;
    for (let i = 4; i < length; i++) {
      password += allChars[Math.floor(Math.random() * allChars.length)];
    }

    // Shuffle the password
    password = password
      .split("")
      .sort(() => Math.random() - 0.5)
      .join("");

    return password;
  }

  /**
   * Reset password fields and validation state
   */
  reset() {
    if (this.passwordInput) {
      this.passwordInput.value = "";
    }
    if (this.confirmPasswordInput) {
      this.confirmPasswordInput.value = "";
      this.confirmPasswordInput.classList.remove(
        "border-green-500",
        "border-red-500"
      );
      this.confirmPasswordInput.classList.add("border-input");
    }

    // Reset validation messages
    if (this.strengthText) {
      this.strengthText.textContent = "Enter password";
      this.strengthText.className = "text-xs font-medium text-gray-500";
    }
    if (this.strengthBar) {
      this.strengthBar.style.width = "0%";
      this.strengthBar.className =
        "h-2 rounded-full transition-all duration-300 bg-gray-300";
    }
    if (this.matchIndicator) {
      this.matchIndicator.textContent = "";
      this.matchIndicator.className = "mt-1 text-xs text-gray-500";
    }

    // Reset requirement indicators
    Object.values(this.requirements).forEach((element) => {
      if (element) {
        element.textContent = "•";
        element.className = "text-gray-400";
      }
    });

    // Trigger initial validation
    this.validatePassword("");
  }
}

/**
 * Static utility functions for password validation
 */
export const PasswordUtils = {
  /**
   * Check if password meets minimum requirements
   * @param {string} password - Password to validate
   * @returns {boolean} True if password meets all requirements
   */
  isValid(password) {
    const checks = {
      length: password.length >= 8,
      uppercase: /[A-Z]/.test(password),
      lowercase: /[a-z]/.test(password),
      number: /\d/.test(password),
      special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password),
    };
    return Object.values(checks).every(Boolean);
  },

  /**
   * Get password strength level
   * @param {string} password - Password to analyze
   * @returns {string} Strength level (none, weak, fair, good, strong)
   */
  getStrengthLevel(password) {
    const checks = {
      length: password.length >= 8,
      uppercase: /[A-Z]/.test(password),
      lowercase: /[a-z]/.test(password),
      number: /\d/.test(password),
      special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password),
    };

    const totalChecks = Object.values(checks).filter(Boolean).length;

    if (totalChecks === 0) return "none";
    if (totalChecks <= 2) return "weak";
    if (totalChecks === 3) return "fair";
    if (totalChecks === 4) return "good";
    if (totalChecks === 5) return "strong";
  },

  /**
   * Generate a secure password
   * @param {number} length - Length of password (default: 12)
   * @returns {string} Generated password
   */
  generate(length = 12) {
    const uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const lowercase = "abcdefghijklmnopqrstuvwxyz";
    const numbers = "0123456789";
    const symbols = "!@#$%^&*";

    let password = "";

    // Ensure at least one character from each set
    password += uppercase[Math.floor(Math.random() * uppercase.length)];
    password += lowercase[Math.floor(Math.random() * lowercase.length)];
    password += numbers[Math.floor(Math.random() * numbers.length)];
    password += symbols[Math.floor(Math.random() * symbols.length)];

    // Fill the rest with random characters
    const allChars = uppercase + lowercase + numbers + symbols;
    for (let i = 4; i < length; i++) {
      password += allChars[Math.floor(Math.random() * allChars.length)];
    }

    // Shuffle the password
    password = password
      .split("")
      .sort(() => Math.random() - 0.5)
      .join("");

    return password;
  },
};
