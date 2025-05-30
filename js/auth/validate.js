export function setupPasswordMatchCheck() {
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirm-password");
  const errorText = document.getElementById("password-error");
  const submitButton = document.getElementById("signup-btn");

  submitButton.addEventListener("click", (e) => {
    if (password.value !== confirmPassword.value) {
      e.preventDefault();
      errorText.classList.remove("hidden");
      return false;
    } else {
      errorText.classList.add("hidden");
      return true;
    }
  });
}
