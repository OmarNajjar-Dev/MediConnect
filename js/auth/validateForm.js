export function validateForm() {
  const password = document.querySelector(".password");
  const confirmPassword = document.getElementById("confirm-password");
  const roleInput = document.getElementById("role-input");
  const passwordErrorToast = document.getElementById("password-error-toast");
  const roleErrorToast = document.getElementById("role-error-toast");
  const submitButton = document.getElementById("signup-btn");

  submitButton.addEventListener("click", (e) => {
    let hasError = false;

    if (!roleInput.value) {
      roleErrorToast.classList.remove("hidden");
      hasError = true;

      setTimeout(() => {
        roleErrorToast.classList.add("hidden");
      }, 5000);
    }

    if (password.value !== confirmPassword.value) {
      passwordErrorToast.classList.remove("hidden");
      hasError = true;

      setTimeout(() => {
        passwordErrorToast.classList.add("hidden");
      }, 5000);
    } else {
      passwordErrorToast.classList.add("hidden");
    }

    if (hasError) {
      e.preventDefault();
      return false;
    }

    return true;
  });
}