export function setupPasswordMatchCheck() {
  const password = document.querySelector(".password");
  const confirmPassword = document.getElementById("confirm-password");
  const errorToast = document.getElementById("password-error-toast");
  const submitButton = document.getElementById("signup-btn");

  submitButton.addEventListener("click", (e) => {
    if (password.value !== confirmPassword.value) {
      e.preventDefault();

      // Show the toast
      errorToast.classList.remove("hidden");

      // Hide after 5 seconds
      setTimeout(() => {
        errorToast.classList.add("hidden");
      }, 5000);

      return false;
    } else {
      errorToast.classList.add("hidden");
      return true;
    }
  });
}
